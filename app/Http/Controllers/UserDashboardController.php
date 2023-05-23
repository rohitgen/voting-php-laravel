<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ElectionDay;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //
    function checkElectionTime()
    {
        $currentTime = Carbon::now();
        $currentDate = Carbon::now()->toDateString();
        $electionDay = ElectionDay::where('election_date', $currentDate)->first();
        return view('dashboard',
            [
                'electionDay' => $electionDay,
                'currentTime' => $currentTime
            ]);
    }
}
