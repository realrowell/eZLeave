@extends('includes.hrstaff_layout')
@section('title','Employee Management')
@section('sidebar_employee_management_active','active')
@section('content')

<div class="position-relative z-1000">
    <div class="position-fixed bottom-0 end-0 me-5">
        @if (session('success'))
            <div class="alert alert-success fade show" role="alert">
                <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                    {{ svg('heroicon-o-check-circle') }}
                </svg>
                {{ session('success') }}
            </div>
        @elseif (session('info'))
            <div class="alert alert-info fade show" role="alert">
                <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                    {{ svg('carbon-information') }}
                </svg>
                {{ session('info') }}
            </div>
        @elseif (session('warning'))
            <div class="alert alert-warning fade show" role="alert">
                <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                    {{ svg('carbon-warning-alt') }}
                </svg>
                {{ session('warning') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger fade show" role="alert">
                <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                    {{ svg('carbon-warning-alt') }}
                </svg>
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger fade show" role="alert">
                    <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                        {{ svg('carbon-warning-alt') }}
                    </svg>
                    {{ $error }}
                </div>
            @endforeach
            
        @endif
    </div>
</div>

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3><a href="/hr/employee_management/employees/grid" class="text-dark">Employee Management</a> / 
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
                    <div class="text-light text-shadow-1">
                        <p>{{ optional($user->employees->employee_positions->subdepartments)->sub_department_title }}</p>
                        <p>{{ optional($user->employees->employee_positions->subdepartments->departments)->department_title }}</p>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-10">
            <div class="row bg-light mt-4 z-1 p-1 ps-4 m-1 shadow justify-content-lg-center justify-content-md-start justify-content-sm-center justify-content-center">
                <div class="row justify-content-start align-items-start text-start">
                    <div class="col">
                        <a href="#employees" class="ms-1 me-1 p-2 custom-primary-button bg-selected-warning">
                            Profile
                        </a>
                        <a href="#regular" class="ms-1 me-1 p-2 custom-primary-button @yield('grid_active') ">
                            Leave MS
                        </a>
                    </div>
                </div>
                {{-- LIST PROFILE --}}
                <div class="row">
                    <div class="row mt-5">
                        <div class="col">
                            <h3>Employee details</h3>
                        </div>
                        <div class="col">
                            <div class="text-end">
                                <a href="/hr/user/update/{{ $user->user_name }}" class="text-dark">
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
                                    <h6 class="profile-title-value">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h6>
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
                                <h6 class="profile-title-value">{{ \Carbon\Carbon::parse(optional($user->employees)->birthdate)->isoFormat('MMMM Do YYYY') }}</h6>
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