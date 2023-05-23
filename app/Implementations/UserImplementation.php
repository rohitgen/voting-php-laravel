<?php

namespace App\Implementations;

use Carbon\Carbon;
use App\Interfaces\UserInterface;
use App\Models\ElectionDay;
use App\Models\ElectionDetail;

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
}
