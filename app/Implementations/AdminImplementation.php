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

         Candidate::create([
            'name' => $validatedData['name'],
            'place' => $validatedData['place']
        ]);




    }

    public function addElectionDetails(Request $request) : void
    {
        $validatedData = $request->validate([
            'candidate_id'    => 'required',
            'election_day_id' => 'required',
        ]);


        ElectionDetail::create([
            'candidate_id' => $validatedData['candidate_id'],
            'election_day_id' => $validatedData['election_day_id']
        ]);

    }

    public function addElectionDay(Request $request) :void
    {
        $validatedData = $request->validate([
            'election_start_time' => 'required',
            'election_end_time'   => 'required',
            'election_date'       => 'required',
        ]);

        ElectionDay::create([
            'election_start_time' => $validatedData['election_start_time'],
            'election_end_time'   => $validatedData['election_end_time'],
            'election_date'       => $validatedData['election_date']
        ]);


    }


    public function allCandidates() : \Illuminate\Database\Eloquent\Collection
    {
        return(Candidate::all());
    }

    public function allElectionDays() : \Illuminate\Database\Eloquent\Collection
    {
        return(ElectionDay::all());
    }

    public function allElectionDetails() : \Illuminate\Database\Eloquent\Collection
    {
        return(ElectionDetail::all());
    }
}
