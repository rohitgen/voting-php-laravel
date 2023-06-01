<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Voting;
use App\Models\Results;

class ComputeVotesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $totalVotes = Voting::select('candidate_id', \DB::raw('COUNT(*) as total_votes'))
            ->groupBy('candidate_id')
            ->get();

        // Update the results table with the total votes
        foreach ($totalVotes as $votes) {
            $candidateId = $votes->candidate_id;
            $totalVotesCount = $votes->total_votes;

            // Check if the candidate already exists in the results table
            $result = Results::where('candidate_id', $candidateId)->first();

            if ($result) {
                // Update the total votes for the candidate
                $result->total_votes = $totalVotesCount;
                $result->save();
            } else {
                // Create a new entry in the results table
                Results::create([
                    'candidate_id' => $candidateId,
                    'total_votes'  => $totalVotesCount,
                ]);
            }
        }

        // Retrieve the candidate with the highest total votes
        $highestVotesCandidate = Results::with('candidate')
            ->orderBy('total_votes', 'desc')
            ->first();

        if ($highestVotesCandidate) {
            $candidateName = $highestVotesCandidate->candidate->name;
            $totalVotes = $highestVotesCandidate->total_votes;

            // Display the candidate with the highest total votes
            \Log::info('Candidate with the highest total votes: ' . $candidateName);
            \Log::info('Total Votes: ' . $totalVotes);
        } else {
            \Log::info('No candidate found in the results table.');
        }
    }
}
