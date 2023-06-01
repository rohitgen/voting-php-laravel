<!-- resources/views/admin/add-election-details.blade.php -->

@extends('admin.layouts.app')

@section('content')


        <div style="padding: 12px;">
            <div style="background-color: #fff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="padding: 20px;">
                    <div style="padding: 20px;">
                        <!-- Add your add election details form HTML content here -->
                        <div style="max-width: 400px;">
                            <header>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Add Election Details') }}
                                </h2>
                            </header>
{{--                            @foreach ($electionDay as $electionDayId)--}}
{{--                                @if ($electionDayId)--}}
{{--                                    <h2>Election Day Details</h2>--}}
{{--                                    <p>Election Date: {{ $electionDayId->election_date }}</p>--}}
{{--                                    <p>Election Day ID: {{ $electionDayId->election_day_id }}</p>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
                            <form method="POST" action="{{ route('adminAddElectionDetails') }}">
                                @csrf


                                <div class="mt-4">
                                    <label for="candidate_id" class="block font-medium text-gray-700">Candidate
                                        ID:</label>
                                    <select name="candidate_id" id="candidate_id" required
                                            class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-indigo-200"
                                    >
                                        <option value="">Select a Candidate</option>
                                        @foreach ($candidateIds as $candidateId)
                                            <option value="{{ $candidateId ->candidate_id}}">{{ $candidateId ->name }}</option>
                                        @endforeach
                                    </select>
                                </div>




                                <div class="mt-4">
                                    <label for="election_day_id" class="block font-medium text-gray-700">Election Day
                                        ID:</label>
                                    <select name="election_day_id" id="election_day_id" required
                                            class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-indigo-200"
                                    >
                                        <option value="">Select an Election Day</option>
                                        @foreach ($electionDay as $electionDayId)
                                            <option value="{{ $electionDayId->election_day_id }}">{{ $electionDayId->election_date }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit"
                                            style="background-color: #3490dc; color: #fff; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                                        Add Election Details
                                    </button>
                                </div>
                            </form>
{{--                            @if ($electionDetails)--}}
{{--                                <div class="candidates-container mt-4">--}}
{{--                                    <table class="table mt-4">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th scope="col">Election Day Id</th>--}}
{{--                                            <th scope="col">Candidate Id</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        <h4>Candidates Details</h4>--}}
{{--                                        @foreach($electionDetails as $electionDetail)--}}

{{--                                            <td><p>{{ $electionDetail->candidate_id }}</p></td>--}}
{{--                                            <td><p>{{$electionDetail->election_day_id}}</p></td>--}}
{{--                                        </tbody>--}}
{{--                                        @endforeach--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
