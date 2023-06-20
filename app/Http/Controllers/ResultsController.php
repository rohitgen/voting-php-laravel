<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Results;
use Illuminate\Support\Facades\DB;

class ResultsController extends Controller
{
    //
    public function index()
    {
        // Get the candidate with the highest votes
//        $candidateWithHighestVotes = Results::with('candidate')
//            ->orderBy('total_votes', 'desc')
//            ->first();
        $candidateWithHighestVotes = DB::connection('new_db_connection')
            ->table('results')
            ->join('elections.candidates', 'results.candidate_id', '=', 'elections.candidates.candidate_id')
            ->select('results.*', 'elections.candidates.*')
            ->orderBy('results.total_votes', 'desc')
            ->first();

        // Get the total votes for the candidate
//        $highestVotes = $candidateWithHighestVotes->total_votes;
        if ($candidateWithHighestVotes) {
            $highestVotes = $candidateWithHighestVotes->total_votes;
        } else {
            $highestVotes = 0;
        }
        $header = " Candidate With Highest Votes "; // Replace with your desired header

        return view('user.results', [
            'header' => $header,
            'candidateWithHighestVotes' => $candidateWithHighestVotes,
            'highestVotes' => $highestVotes,]);
    }
}
