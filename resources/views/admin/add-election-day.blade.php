<!-- resources/views/admin/add-election-day.blade.php -->

@extends('admin.layouts.app')

@section('content')

{{--        <header>--}}
{{--            <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--                {{ __('Add Election Day') }}--}}
{{--            </h2>--}}
{{--        </header>--}}

        <div style="padding: 12px;">
            <div style="background-color: #fff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="padding: 20px;">
                    <div style="max-width: 400px;">
                        <header>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Add Election Day') }}
                            </h2>
                        </header>
                        <form method="POST" action="{{ route('adminAddElectionDay') }}">
                            @csrf

                            <div class="mt-4">
                                <label for="election_start_time" class="block font-medium text-gray-700">Start
                                    Time:</label>
                                <input type="datetime-local" name="election_start_time" id="election_start_time" required
                                       class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-indigo-200">
                            </div>

                            <div class="mt-4">
                                <label for="election_end_time" class="block font-medium text-gray-700">End Time:</label>
                                <input type="datetime-local" name="election_end_time" id="election_end_time" required
                                       class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-indigo-200">
                            </div>


                            <div class="mt-4">
                                <label for="election_date" class="block font-medium text-gray-700">Date:</label>
                                <input type="date" name="election_date" id="election_date" required
                                       class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-indigo-200">
                            </div>


                        <div class="mt-4">
                            <button type="submit"
                                    style="background-color: #3490dc; color: #fff; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                                Add Election Day
                            </button>
                        </div>
                        </form>
                        @if ($electionDays)
                            <div class="candidates-container mt-4">
                                <table class="table mt-4">
                                    <thead>
                                    <tr>
                                        <th scope="col">Election Date</th>
{{--                                        <th scope="col">Candidate Place</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <h4>Candidates Details</h4>
                                    @foreach($electionDays as $electionDay)

                                        <td><p>{{ $electionDay->election_date }}</p></td>
{{--                                        <td><p>{{$candidate->place}}</p></td>--}}
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

@endsection
