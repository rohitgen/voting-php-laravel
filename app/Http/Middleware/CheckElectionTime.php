<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ElectionDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckElectionTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentTime = Carbon::now();
        $currentDate = Carbon::now()->toDateString();
        $electionDay = ElectionDay::where('election_date', $currentDate)->first();
        $electionStartTime = $electionDay->election_start_time;

        if ($currentTime->greaterThanOrEqualTo($electionStartTime)) {
            return $next($request);
        }
        return response()->view('errors.election-time', [], 403);

//        return $next($request);
    }
}
