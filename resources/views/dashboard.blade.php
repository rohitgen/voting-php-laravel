<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="card" style="padding: 10px;">
        @if(Session::has('message'))
            <p class="alert-danger">{{ Session::get('message') }}</p>
        @endif
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            </div>
        </div>
    </div>
    <div style="width: 33.33%; padding: 8px; ">
        <a href="{{ route('candidateElectionDetails') }}"
           style="background-color: #3490dc; color: #fff; padding: 10px 20px; border-radius: 4px; cursor: pointer; margin:2px;">
            Vote for Candidate
        </a>


    @if (auth()->user()->vote_status && $currentTime->greaterThan($electionDay->election_end_time))

            <a href="{{ route('results') }}"
               style="background-color: #3490dc; color: #fff; padding: 10px 20px; border-radius: 4px; cursor: pointer; margin:2px;">
                Results
            </a>
        </div>
    @endif
</x-app-layout>
