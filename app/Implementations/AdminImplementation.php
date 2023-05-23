<?php
namespace App\Implementations;

use App\Interfaces\AdminInterface;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\ElectionDay;
use App\Models\ElectionDetail;

class AdminImplementation implements AdminInterface
{
    public function addCandidate(Request  $request) : void
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'name'  => 'required',
            'place' => 'required',
        ]);

        // Create a new candidate instance
        $candidate = new Candidate();
        $candidate->name = $validatedData['name'];
        $candidate->place = $validatedData['place'];

        // Save the candidate to the database
        $candidate->save();

        return;
    }

    public function addElectionDetails(Request $request) : void
    {
        $validatedData = $request->validate([
            'candidate_id'    => 'required',
            'election_day_id' => 'required',
        ]);

        // Create a new election detail instance
        $election_detail = new ElectionDetail();
        $election_detail->candidate_id = $validatedData['candidate_id'];
        $election_detail->election_day_id = $validatedData['election_day_id'];

        // Save the election detail to the database
        $election_detail->save();
    }

    public function addElectionDay(Request $request) :void
    {
        $validatedData = $request->validate([
            'election_start_time' => 'required',
            'election_end_time'   => 'required',
            'election_date'       => 'required',
        ]);

        // Create a new election day instance
        $election_day = new ElectionDay();

        $election_day->election_start_time = $validatedData['election_start_time'];
        $election_day->election_end_time = $validatedData['election_end_time'];
        $election_day->election_date = $validatedData['election_date'];
        // Save the election day to the database
        $election_day->save();
    }


    public function allCandidates() : \Illuminate\Database\Eloquent\Collection
    {
        return(Candidate::all());
    }

    public function allElectionDays() : \Illuminate\Database\Eloquent\Collection
    {
        return(ElectionDay::all());
    }
}
