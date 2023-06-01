<!-- resources/views/admin/dashboard.blade.php -->

@extends('admin.layouts.app')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="card" style="padding: 10px;">
        @if(Session::has('message'))
            <p class="alert-danger">{{ Session::get('message') }}</p>
        @endif
    </div>
    <div style="padding: 12px;">
        <div style="background-color: #fff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="padding: 20px;">
                <div style="display: flex; justify-content: space-between;">
                    <div style="width: 33.33%; padding: 8px;">
                        <a href="{{ route('adminAddCandidateForm') }}"
                           style="display: block; background-color: #3490dc; color: #fff; text-align: center; text-decoration: none; padding: 10px; border-radius: 4px;">
                            Add Candidate
                        </a>
                    </div>
                    <div style="width: 33.33%; padding: 8px;">
                        <a href="{{ route('adminAddElectionDetailsForm') }}"
                           style="display: block; background-color: #3490dc; color: #fff; text-align: center; text-decoration: none; padding: 10px; border-radius: 4px;">
                            Add Election Details
                        </a>
                    </div>
                    <div style="width: 33.33%; padding: 8px;">
                        <a href="{{ route('adminAddElectionDayForm') }}"
                           style="display: block; background-color: #3490dc; color: #fff; text-align: center; text-decoration: none; padding: 10px; border-radius: 4px;">
                            Add Election Day
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
