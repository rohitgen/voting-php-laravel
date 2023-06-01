<?php

namespace App\Interfaces;

use App\Models\ElectionDay;
use App\Models\ElectionDetail;
use Illuminate\Http\Request;
use App\Models\User;

interface UserInterface {

    public function candidateElectionDetails(ElectionDay $electionDay) : \Illuminate\Database\Eloquent\Collection;

    public function getElectionDay() : ElectionDay ;

    public function voteForCandidate(Request $request): array;

    public function getUser(Request $request): User;

}
