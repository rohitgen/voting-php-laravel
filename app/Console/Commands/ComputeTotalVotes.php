<?php

namespace App\Console\Commands;
use App\Models\results;
use App\Models\voting;
use Illuminate\Console\Command;

class ComputeTotalVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'votes:compute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compute total votes for each candidate and update in the results table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve the total votes for each candidate
        $totalVotes = voting::select('candidate_id', \DB::raw('COUNT(*) as total_votes'))
            ->groupBy('candidate_id')
            ->get();

        // Update the results table with the total votes
        foreach ($totalVotes as $votes) {
            $candidateId = $votes->candidate_id;
            $totalVotesCount = $votes->total_votes;

            // Check if the candidate already exists in the results table
            $result = results::where('candidate_id', $candidateId)->first();

            if ($result) {
                // Update the total votes for the candidate
                $result->total_votes = $totalVotesCount;
                $result->save();
            } else {
                // Create a new entry in the results table
                results::create([
                    'candidate_id' => $candidateId,
                    'total_votes'  => $totalVotesCount,
                ]);
            }
        }

        // Retrieve the candidate with the highest total votes
        $highestVotesCandidate = results::with('candidate')
            ->orderBy('total_votes', 'desc')
            ->first();

        if ($highestVotesCandidate) {
            $candidateName = $highestVotesCandidate->candidate->name;
            $totalVotes = $highestVotesCandidate->total_votes;

            // Display the candidate with the highest total votes to the user
            $this->info('Candidate with the highest total votes: ' . $candidateName);
            $this->info('Total Votes: ' . $totalVotes);
        } else {
            $this->info('No candidate found in the results table.');
        }
       // return 0;
    }
}
