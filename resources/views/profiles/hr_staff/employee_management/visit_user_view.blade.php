@extends('includes.hrstaff_layout')
@section('title','Employee Management')
@section('sidebar_employee_management_active','active')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3><a href="{{ route('hrstaff_employees_grid') }}" class="text-dark">Employee Management</a> /
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
                            @if ($profile_photo == null)
                                <img class="profile-photo" src="/img/dummy_profile.jpg" alt="profile photo">
                            @else
                                <img class="profile-photo" src="{{ asset('storage/images/profile_photos/'.$profile_photo->profile_photo) }}" alt="profile photo">
                            @endif
                        </div>
                    </div>
                    <h4 class="text-light text-shadow-1">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h4>
                    <div class="text-light">
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
                        <a href="{{ route('user_profile',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 custom-primary-button bg-selected-warning">
                            Profile
                        </a>
                        <a href="{{ route('user_profile_leave',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 custom-primary-button @yield('grid_active') ">
                            Leave MS
                        </a>
                    </div>
                </div>
                {{-- LIST PROFILE --}}
                <div class="row mt-5">
                    <div class="col-6">
                        <h3>Employee details</h3>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('visit_user_update',['username'=>$user->user_name]) }}" class="btn btn-sm btn-outline-primary ps-4 pe-4">
                            <svg class="m-1" width="18px" height="18px" viewBox="3 2 25 25">
                                {{ svg('carbon-edit') }}
                            </svg> Update
                        </a>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <div class="row mt-2 mb-2" >
                            <h6 class="profile-title">Full Name</h6>
                            <h6 class="profile-title-value">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h6>
                        </div>
                        <div class="row mt-3 mb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Sex</h6>
                                <h6 class="profile-title-value">{{ optional($user->employees->genders)->gender_title }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Marital Status</h6>
                                <h6 class="profile-title-value">{{ optional($user->employees->marital_statuses)->marital_status_title }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Birth Date</h6>
                                <h6 class="profile-title-value">{{ \Carbon\Carbon::parse(optional($user->employees)->birthdate)->isoFormat('MMMM Do YYYY') }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Contact Number</h6>
                                <h6 class="profile-title-value">{{ optional($user->employees)->contact_number }}</h6>
                            </div>
                        </div>
                        <div class="row mt-3 mb-2">
                            <h6 class="profile-title">Address</h6>
                            <h6 class="profile-title-value">{{ $employee_address }}</h6>
                        </div>
                        <div class="row mt-3 mb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Employment status</h6>
                                <h6 class="profile-title-value">{{ optional($user->employees->employment_statuses)->employment_status_title }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Date hired</h6>
                                <h6 class="profile-title-value">{{ \Carbon\Carbon::parse(optional($user->employees)->date_hired)->isoFormat('MMMM Do YYYY') }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Length of Service</h6>
                                <h6 class="profile-title-value">{{ $length_of_service }} year/s</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">ID Number</h6>
                                <h6 class="profile-title-value">{{ optional($user->employees)->sap_id_number }}</h6>
                            </div>
                        </div>
                        <div class="row mt-4 mb-1">
                            <h6 class="profile-title">Reports to</h6>
                            <h6 class="profile-title-value">{{ $reports_to }}</h6>
                        </div>
                        <div class="row mt-1 mb-4">
                            <h6 class="profile-title">Second superior</h6>
                            <h6 class="profile-title-value">{{ $second_reports_to }}</h6>
                        </div>
                        <div class="row mt-3 mb-2">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Position</h6>
                                <h6 class="profile-title-value">{{ optional(optional($user->employees->employee_positions)->positions)->position_description }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Department</h6>
                                <h6 class="profile-title-value">{{ optional(optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Sub-department</h6>
                                <h6 class="profile-title-value">{{ optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->sub_department_title }}</h6>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6 class="profile-title">Area of assignment</h6>
                                <h6 class="profile-title-value">{{ optional(optional($user->employees->employee_positions)->area_of_assignments)->location_address  }}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class="profile-title-value">{!! optional(optional($user->employees->employee_positions)->area_of_assignments)->embedded_google_map  !!}</h6>
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
                            <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                <a href="#" class="profile-title-value btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reset_password_modal">reset password</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END LIST --}}
                <!-- confirm reset password Modal -->
                    <div class="modal fade" id="reset_password_modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid text-start">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h2>Please confirm to reset the password</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('account_reset_password',['username'=>$user->user_name]) }}" method="PUT" onsubmit="onClickApprove()">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- end confirm reset password Modal --}}
            </div>
        </div>
    </div>
</div>
@endsection
