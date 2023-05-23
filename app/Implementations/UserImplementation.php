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

class UserImplementation implements UserInterface {

    public function getElectionDay(): ElectionDay{
        return ElectionDay::where('election_date', Carbon::now()->toDateString())->first();
    }

    public function candidateElectionDetails(ElectionDay $electionDay) : \Illuminate\Database\Eloquent\Collection{
        $candidate_id_info = electionDetail::whereIn('candidate_id', function ($query) use ($electionDay) {
            $query->select('candidate_id')
                ->from('election_details')
                ->where('election_day_id', $electionDay['election_day_id']);
        })->get();
        return $candidate_id_info;
    }


    public function getUser(Request $request) : User{
        return auth()->user();
    }

    public function voteForCandidate(Request $request) : void {
        $validatedData = $request->validate([
            'candidate_id' => 'required',
        ]);

        $user = $this->getUser($request);
        $candidateId = $validatedData['candidate_id'];
        $candidate = Candidate::find($candidateId);
        // Check if the user has already voted

        // Create a new voting record
        Voting::create([
            'voter_id'     => $user->voter_id,
            'candidate_id' => $candidate->candidate_id,
        ]);

        // Update the vote_status for the user
        $user->vote_status = true;
        $user->save();
    }
}
