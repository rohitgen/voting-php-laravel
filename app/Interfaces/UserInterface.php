<?php

namespace App\Interfaces;

use App\Models\ElectionDay;
use App\Models\ElectionDetail;

interface UserInterface {

    public function candidateElectionDetails(ElectionDay $electionDay) : \Illuminate\Database\Eloquent\Collection;

    public function getElectionDay() : ElectionDay ;

}
