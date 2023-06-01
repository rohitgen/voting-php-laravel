<?php

namespace App\Implementations;

use Carbon\Carbon;
use App\Interfaces\UserInterface;
use App\Models\ElectionDay;
use App\Models\ElectionDetail;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use mysql_xdevapi\Exception;

class UserImplementation implements UserInterface
{
    public function getElectionDay(): ElectionDay
    {
        return ElectionDay::where('election_date', Carbon::now()->toDateString())->first();
    }

    public function candidateElectionDetails(ElectionDay $electionDay): \Illuminate\Database\Eloquent\Collection
    {
        return ElectionDetail::whereIn('candidate_id', function ($query) use ($electionDay) {
            $query->select('candidate_id')
                ->from('election_details')
                ->where('election_day_id', $electionDay->election_day_id);
        })->get();
    }

    public function getUser(Request $request): User
    {
        return auth()->user();
    }

    public function voteForCandidate(Request $request): array
    {
        $validatedData = $request->validate([
            'candidate_id' => 'required',
        ]);

        try {
            $user = $this->getUser($request);
            $candidateId = $validatedData['candidate_id'];

            $voteStatus = Redis::get("vote_status:user:{$user->voter_id}");
            if ($voteStatus == null) {
                $voteStatus = $user->vote_status;
            }
            if ($voteStatus) {
                return [
                    'voteStatus' => $user->vote_status,
                    'message'    => 'Vote already cast.',
                    'status'     => 200
                ];
            } else {
                Voting::create([
                    'voter_id'     => $user->voter_id,
                    'candidate_id' => $candidateId,
                ]);
                Redis::set("vote_status:user:{$user->voter_id}", true);

//                 Update the vote_status for the user
                $user->vote_status = true;
                $user->save();

                return [
                    'voteStatus' => $user->vote_status,
                    'message'    => 'Vote cast successfully.',
                    'status'     => 200
                ];
            }
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage(),
                'status'  => 400
            ];
        }
    }
}
