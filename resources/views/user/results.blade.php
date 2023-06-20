@extends('user.layouts.app')

@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Results') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                </div>
            </div>
        </div>
        <div style="padding: 12px;">
            <div style="background-color: #fff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="padding: 20px;">
                    @if ($candidateWithHighestVotes)
                        <div class="result-container">
                            <h2>Candidate with Highest Votes</h2>
                            <p>Candidate Name: {{ $candidateWithHighestVotes->name }}</p>
                            <p>Total Votes: {{ $highestVotes }}</p>
                        </div>
                    @else
                        <p>No results available.</p>
                    @endif
{{--        @if ($candidateWithHighestVotes)--}}
{{--            <div class="result-container">--}}
{{--                <h2>Candidate with Highest Votes</h2>--}}
{{--                <p>Candidate Name: {{ $candidateWithHighestVotes->candidate->name }}</p>--}}
{{--                <p>Total Votes: {{ $highestVotes }}</p>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <p>No results available.</p>--}}
{{--        @endif--}}
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>

@endsection
