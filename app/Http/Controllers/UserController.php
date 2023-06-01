<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\ElectionDay;
use App\Models\ElectionDetail;
use App\Models\candidate;
use App\Models\voting;
use App\Models\User;
use App\Interfaces\UserInterface;
use App\Services\LogVoteService;
use App\Jobs\ComputeVotesJob;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    public function __construct(UserInterface $userInterface, LogVoteService $logVoteService)
    {
        $this->userInterface = $userInterface;
        $this->logVoteService = $logVoteService;
    }

    public function candidateElectionDetails()
    {
        try {
            $electionDay = $this->userInterface->getElectionDay();
            $user = auth()->user();
            $voteStatus = Redis::get("vote_status:user:{$user->voter_id}") ? Redis::get("vote_status:user:{$user->voter_id}") : auth()->user()->vote_status;
            if ($electionDay != null) {
                $candidate_id_info = $this->userInterface->candidateElectionDetails($electionDay);
                $header = "Candidate Election Details";

                return view('User.candidate-election-details', [
                    'voteStatus'                 => $voteStatus,
                    'candidate_election_details' => $candidate_id_info,
                    'election_day_details'       => $electionDay,
                    'header'                     => $header,
                ]);
            } else {
                return redirect()->route('dashboard')->with('error', 'There is no election today.');
            }
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());

            return redirect()->route('dashboard');
        }
    }

    public function voteForCandidate(Request $request)
    {
        $result = $this->userInterface->voteForCandidate($request);
        $response = $this->logVoteService->logVote();

        ComputeVotesJob::dispatch();

        return $result;
    }
}
