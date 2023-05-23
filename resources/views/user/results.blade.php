@extends('user.layouts.app')

@section('content')
    <div class="container">
        <h1>Results</h1>

        @if ($candidateWithHighestVotes)
            <div class="result-container">
                <h2>Candidate with Highest Votes</h2>
                <p>Candidate Name: {{ $candidateWithHighestVotes->candidate->name }}</p>
                <p>Total Votes: {{ $highestVotes }}</p>
            </div>
        @else
            <p>No results available.</p>
        @endif
    </div>
@endsection
