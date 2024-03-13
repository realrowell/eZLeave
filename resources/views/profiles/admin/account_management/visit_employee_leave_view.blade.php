@extends('includes.admin_layout')
@section('title','Employee Management')
@section('sidebar_employee_management_active','active')
@section('content')


<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3><a href="{{ route('admin_accounts_grid') }}" class="text-dark">Employee Management</a> /
                <a href="#" class="text-dark">Profile</a>
            </h3>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">

        </div>
    </div>
    <div class="row justify-content-center align-items-start d-flex gap-2 mb-5">
        <div class="col-lg-3 col-md-3 col-sm-10 bg-light align-self-stretch shadow bg-gradient-primary m-2" style="min-height: 10rem">
            <div class="row">
                <div class="col text-center p-5">
                    <div class="row justify-content-center align-items-start">
                        <div class="profile-photo-box align-items-start pt-3 pb-4">
                            <img class="profile-photo" src="/img/dummy_profile.jpg" alt="profile photo">
                        </div>
                    </div>
                    <h4 class="text-light text-shadow-1">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h4>
                    <div class="text-light">
                        {{-- <p>{{ optional($user->employees->employee_positions->positions->subdepartments)->sub_department_title }}</p>
                        <p>{{ optional($user->employees->employee_positions->positions->subdepartments->departments)->department_title }}</p> --}}
                        @if ($user->status_id == 'sta-2001')
                            <p class="card-desc badge bg-success">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2002')
                            <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2003')
                            <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2004')
                            <p class="card-desc badge bg-danger">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2002')
                            <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-10">
            <div class="row bg-light mt-2 z-1 p-1 ps-4 m-1 shadow justify-content-lg-center justify-content-md-start justify-content-sm-center justify-content-center">
                <div class="row justify-content-start align-items-start text-start">
                    <div class="col">
                        <a href="{{ route('admin_visit_employee_view',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 custom-primary-button">
                            Profile
                        </a>
                        <a href="{{ route('visit_employee_leave_ms_view',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 custom-primary-button bg-selected-warning">
                            Leave MS
                        </a>
                    </div>
                </div>
                {{-- LIST PROFILE --}}
                    <div class="row">
                        <div class="row mt-4 d-grid gap-1 mx-auto justify-content-center text-center">
                            <div class="col">
                                <h3>Leave Monitoring</h3>
                            </div>
                            <div class="col">
                                <h3>{{ \Carbon\Carbon::now()->format('M d, Y') }}</h3>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="table-responsive">
                                <div class="table-wrapper">
                                    <table class="table table-striped table-hover bg-light">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Position</th>
                                                <th>Sub-department</th>
                                                <th>Department</th>
                                                <th>Date Hired</th>
                                                <th>Length of Service</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }} {{ optional($user->suffixes)->suffix_title }}</td>
                                                <td>{{ optional($user->employees->employee_positions->positions)->position_description }}</td>
                                                <td>{{ optional($user->employees->employee_positions->positions->subdepartments)->sub_department_title }}</td>
                                                <td>{{ optional(optional($user->employees->employee_positions->positions->subdepartments)->departments)->department_title }}</td>
                                                <td>{{ \Carbon\Carbon::parse(optional($user->employees)->date_hired)->format('M d, Y') }}</td>
                                                @if ($length_of_service > 1.9)
                                                    <td>{{ $length_of_service }} years</td>
                                                @else
                                                    <td>{{ $length_of_service }} year</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                {{-- END LIST --}}
            </div>
        </div>
    </div>
</div>
@endsection
