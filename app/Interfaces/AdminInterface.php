<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\Candidate;

interface AdminInterface
{
    public function addCandidate(Request  $request) :void;
    public function addElectionDetails(Request $request) :void;
    public function addElectionDay(Request $request):void;
    public function allCandidates() : \Illuminate\Database\Eloquent\Collection;
    public function allElectionDays(): \Illuminate\Database\Eloquent\Collection;
}