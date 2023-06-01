@extends('user.layouts.app')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidates') }}
        </h2>
    </x-slot>
    <div style="padding: 12px;">
        <div style="background-color: #fff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="padding: 20px;">
                <div style="padding: 20px;">
                    <!-- Add your add candidate form HTML content here -->

                    <div style="margin-left: 80%;">
                        @if($voteStatus)
                            <p>Status : Vote has already been cast</p>

                        @else
                            <p>Status : Vote pending</p>

                        @endif
                    </div>

                    @if ($election_day_details)
                        <h2>Election Day Details</h2>
                        <p>Election Date: {{ $election_day_details->election_date }}</p>
                        <p>Election Day ID: {{ $election_day_details->election_day_id }}</p>
                        <p>Election Start time:{{$election_day_details->election_start_time}}</p>
                        <p>Election End time:{{$election_day_details->election_end_time}}</p>

                    @endif



                    @if ($candidate_election_details->isNotEmpty())
                        <h2>Candidate Details</h2>
                        <div class="candidates-container">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Candidate Name</th>
                                    <th scope="col">Candidate Place</th>
                                    <th scope="col">Vote</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($candidate_election_details as $item)


                                    <td><p>{{ $item->candidate->name }}</p></td>
                                    <td><p>{{$item->candidate->place}}</p></td>
                                    <!-- Add more candidate details here -->

                                    <td>
                                        @if ($voteStatus)
                                            <button type="button" disabled class="disabled-button">
                                                Already Voted
                                            </button>
                                        @else
                                            <button type="submit" onclick="voteCandidate({{$item->candidate_id}},'{{$item->candidate->name}}')"
                                                    style="background-color: #3490dc; color: #fff; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                                                Vote
                                            </button>
                                        @endif
                                    </td>
                                </tbody>


                                @endforeach
                            </table>

                        </div>




                    @endif

                    @if (!$election_day_details && $candidate_election_details->isEmpty() && $candidate_details->isEmpty())
                        <p>No candidate election details found.</p>
                    @endif



                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function voteCandidate(candidateID,candidateName) {
        Swal.fire({
            title             : 'Are you sure to vote for '+ candidateName+' ?',
            text              : "Cannot change your vote once it is cast!",
            icon              : 'warning',
            showCancelButton  : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Yes!',
        }).then((result) => {
            if (result.isConfirmed) {
                // TO DO ajax call to update the db with the vote status
                $.ajax({
                    type   : "POST",
                    url    : "http://localhost:8000/vote",
                    data       : {
                        "candidate_id": candidateID,
                    },
                    success: function (data) {
                        if(data.status == 200) {
                            Swal.fire({
                                title            : data.message,
                                confirmButtonText: 'OK',
                                icon : 'success',
                            }).then((result) => {
                                location.reload();
                            })

                        } else {
                            Swal.fire({
                                title            : data.message,
                                confirmButtonText: 'OK',
                                icon             : 'error',
                            }).then((result) => {
                                location.reload();
                            })

                        }
                    }
                });
            }
        })
    }


</script>
