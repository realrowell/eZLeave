@extends('includes.employee_profile_layout')
@section('title','User Profile')
@section('sidebar_user_active','active')
@section('content')

{{-- <div class="banner-gradient p-5 text-center text-light ">
    <img style="max-width: 100%; height: auto;" src="/img/dashboard_banner_01.jpg" alt="">
    {{ now()->format('l') }}
</div> --}}
<div class="container-fluid mb-4 pb-5 p-4">
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch " style="min-height: 1rem" >
            <a href="{{ route('employee_dashboard') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
            <a href="{{ route('employee_profile') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Profile</h6>
                    </div>
                </div>
            </a>
        </div>
          
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_menu') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="container-fluid mb-4 pb-5" id="profile_body">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-4 col-lg-6">
                <h3>Employee Profile</h3>
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
                        <div class="text-light text-shadow-1">
                            <p>{{ optional($user->employees->employee_positions->subdepartments)->sub_department_title }}</p>
                            <p>{{ optional($user->employees->employee_positions->subdepartments->departments)->department_title }}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-10">
                <div class="row bg-light mt-2 z-1 p-2 ps-4 shadow justify-content-lg-center justify-content-md-start justify-content-sm-center justify-content-center">
                    {{-- LIST PROFILE --}}
                    <div class="row">
                        <div class="row mt-5">
                            <div class="col">
                                <h3>Employee details</h3>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <a href="{{ route('employee_profile_update_view') }}" class="text-dark">
                                        <svg class="m-1" width="20px" height="20px" viewBox="0 0 25 25">
                                            {{ svg('feathericon-edit') }}
                                        </svg>Update
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <div class="row mt-2 mb-1" >
                                    <div class="row mt-2 mb-1" >
                                        <h6 class="profile-title">Full Name</h6>
                                        <h6 class="profile-title-value">{{ $user_full_name }}</h6>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Sex</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->genders)->gender_title }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Marital Status</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->marital_statuses)->marital_status_title }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Birth Date</h6>
                                    <h6 class="profile-title-value">{{ \Carbon\Carbon::parse(optional($user->employees)->birthdate)->isoFormat('MMMM D, YYYY') }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Address</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->employee_addresses)->address_line_1 }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Contact Number</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees)->contact_number }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Employment status</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->employment_statuses)->employment_status_title }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Date hired</h6>
                                    <h6 class="profile-title-value">{{ \Carbon\Carbon::parse(optional($user->employees)->date_hired)->isoFormat('MMMM Do YYYY') }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Length of Service</h6>
                                    <h6 class="profile-title-value">{{ $length_of_service }} year/s</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Reports to</h6>
                                    <h6 class="profile-title-value">{{ $reports_to }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Position</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->employee_positions->positions)->position_title }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Department</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->employee_positions->subdepartments->departments)->department_title }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Sub-department</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->employee_positions->subdepartments)->sub_department_title }}</h6>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <h6 class="profile-title">Area of assignment</h6>
                                    <h6 class="profile-title-value">{{ optional($user->employees->employee_positions->area_of_assignments)->location_address  }}</h6>
                                    <h6 class="profile-title-value">{!! optional($user->employees->employee_positions->area_of_assignments)->embedded_google_map  !!}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <h3>Account details</h3>
                        </div>
                        <div class="row mt-1 mb-5">
                            <div class="row mt-2 mb-1">
                                <h6 class="profile-title">Email</h6>
                                <h6 class="profile-title-value">{{ $user->email }}</h6>
                            </div>
                            <div class="row mt-2 mb-1">
                                <h6 class="profile-title">User name</h6>
                                <h6 class="profile-title-value">{{ $user->user_name }}</h6>
                            </div>
                            <div class="row mt-2 mb-1">
                                <div class="col">
                                    <h6 class="profile-title">Password</h6>
                                    <a href="#" class="profile-title-value btn btn-sm btn-outline-primary">send password reset link</a>
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