<!-- resources/views/admin/add-candidate.blade.php -->

@extends('admin.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <div style="padding: 12px;">
        <div style="background-color: #fff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="padding: 20px;">
                <div style="padding: 20px;">
                    <!-- Add your add candidate form HTML content here -->
                    <div style="max-width: 400px;">
                        <header>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Add Candidate') }}
                            </h2>
                        </header>
                        <form method="POST" action="{{ route('adminAddCandidate') }}">
                            @csrf
                            <div class="mt-4">
                                <label for="name" class="block font-medium text-gray-700">Name:</label>
                                <input type="text" name="name" id="name" required
                                       class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-indigo-200"
                                >
                            </div>

                            <div class="mt-4">
                                <label for="place" class="block font-medium text-gray-700">Place:</label>
                                <input type="text" name="place" id="place" required
                                       class="border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-indigo-200"
                                >
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                        style="background-color: #3490dc; color: #fff; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                                    Add Candidate
                                </button>
                            </div>
                        </form>
                        @if ($candidates)
                            <div class="candidates-container mt-4">
                                <table class="table mt-4">
                                    <thead>
                                    <tr>
                                        <th scope="col">Candidate Name</th>
                                        <th scope="col">Candidate Place</th>
                                        <th scope="col">Delete Candidate</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <h4>Candidates Details</h4>
                                    @foreach($candidates as $candidate)
                                        <tr>
                                            <td><p>{{ $candidate->name }}</p></td>
                                            <td><p>{{$candidate->place}}</p></td>
                                            <td>
                                                <button onclick="openEditPopup({{ $candidate->candidate_id }})"
                                                        class="btn btn-primary">
                                                    Edit
                                                </button>
                                                <form method="POST" action="{{ route('deleteCandidate', $candidate) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this candidate?')"
                                                            class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openEditPopup(candidateId) {
            Swal.fire({
                title            : "Edit Candidate",
                text             : "Please enter the new details:",
                html             : `
                <input type="text" id="name" class="swal2-input" placeholder="Name" required>
                <input type="text" id="place" class="swal2-input" placeholder="Place" required>
            `,
                showCancelButton : true,
                confirmButtonText: "Update",
                cancelButtonText : "Cancel",
                preConfirm       : () => {
                    const name = document.getElementById('name').value;
                    const place = document.getElementById('place').value;

                    // Perform your update logic here

                    return { name, place };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const { name, place } = result.value;

                    // Handle the update logic with the retrieved values

                    Swal.fire("Success", "Candidate updated successfully", "success").then(() => {
                        location.reload();
                    });
                }
            });
        }
    </script>


@endsection
