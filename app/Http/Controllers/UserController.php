<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectionDay;
use App\Models\ElectionDetail;
use App\Models\candidate;
use App\Models\voting;
use App\Models\User;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    public function candidateElectionDetails()
    {
        $this->userInterface->getElectionDay();

        $electionDay = $this->userInterface->getElectionDay();


        if ($electionDay != null) {

//            // Pass the candidates to the view
            $candidate_id_info = $this->userInterface->candidateElectionDetails($electionDay);

            $header = "Candidate Election Details"; // Replace with your desired header

            return view('User.candidate-election-details', [

                'candidate_election_details' => $candidate_id_info,
                'election_day_details'       => $electionDay,
                'header'                     => $header,
            ]);
        }
        // If no election day is found for the current date, handle the case accordingly
        else {
            return redirect()->route('dashboard')->with('error', 'There is no election today.');
        }
    }


    public function voteForCandidate(Request $request)
    {
        $validatedData = $request->validate([
            'candidate_id' => 'required',
        ]);

        $user = auth()->user();
        $candidateId = $validatedData['candidate_id'];
        $candidate = Candidate::find($candidateId);
        // Check if the user has already voted

//        $user = User::find($userId);
        if ($user->vote_status==true) {
            return redirect()->back()->with('error', 'You have already cast your vote.');
        }

        // Create a new voting record
        Voting::create([
            'voter_id'     => $user->voter_id,
            'candidate_id' => $candidate->candidate_id,
        ]);

        // Update the vote_status for the user
        $user->vote_status = true;
        $user->save();

        $client = new \GuzzleHttp\Client();

        $response = $client->get('https://logvote.free.beeceptor.com/');

        // TO DO
        /* make a post request and store the request and response in a log table for tracking the users vote activity */

        return redirect()->back()->with('success', 'Your vote has been recorded successfully.');
    }
}
