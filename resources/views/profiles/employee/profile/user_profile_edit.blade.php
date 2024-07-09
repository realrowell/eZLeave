@extends('includes.employee_profile_layout')
@section('title','User Profile')
@section('sidebar_user_active','active')
@section('content')

<div class="container-fluid d-print-none" id="profile_body" >
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch " >
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
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid mb-5" id="profile_body">
    <div class="row bg-light shadow ">
        <div class="col-lg-3 col-md-3 col-sm-10 border border-start-0 border-top-0 border-bottom-0">
            <div class="row">
                <div class="col text-center p-5">
                    <div class="row justify-content-center align-items-start">
                        <div class="profile-photo-box align-items-start pt-3 pb-4">
                            <img class="profile-photo" src="/img/dummy_profile.jpg" alt="profile photo">
                        </div>
                    </div>
                    <h4 class="text-dark">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h4>
                    <div class="text-dark">
                        <p class="mb-0 mt-3">{{ optional($user->employees->employee_positions->positions->subdepartments)->sub_department_title }}</p>
                        <p>{{ optional($user->employees->employee_positions->positions->subdepartments->departments)->department_title }}</p>
                    </div>
                    <div class="text-light">
                        @if ($user->status_id == 'sta-2001')
                            <p class="card-desc rounded-pill badge bg-success">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2002')
                            <p class="card-desc rounded-pill badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2003')
                            <p class="card-desc rounded-pill badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2004')
                            <p class="card-desc rounded-pill badge bg-danger">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2002')
                            <p class="card-desc rounded-pill badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-10 ps-5 pe-5 pb-5">
            <div class="row ">
                {{-- PROFILE Fields --}}
                <form action="{{ route('employee_update_profile') }}" method="POST" onsubmit="onFormSubmit()" id="form_to_submit">
                    @csrf
                    @method('PATCH')
                    <div class="row mt-5">
                        <div class="col">
                            <h3>Employee Update</h3>
                        </div>
                        <div class="col text-end">
                            <div class="text-end d-flex gap-3 justify-content-end">
                                <a href="{{ URL::previous() }}" class="btn btn-danger rounded-0">Discard Changes</a>
                                <button id="submit_button1" type="submit" class="btn btn-success rounded-0">Save Changes</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="row mt-2 mb-1" >
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">First name</h6>
                                    <input type="text" class="form-control" id="first_name" name="firstname" value="{{ $user->first_name }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Middle name</h6>
                                    <input type="text" class="form-control" id="middle_name" name="middlename" value="{{ $user->middle_name }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Last name</h6>
                                    <input type="text" class="form-control" id="last_name" name="lastname" value="{{ $user->last_name }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Suffix</h6>
                                    <input type="text" class="form-control" id="suffix" name="suffix" value="{{ optional($user->employees->suffixes)->suffix_title }}" disabled>
                                </div>
                            </div>
                            <div class="row mt-3 mb-1">
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Sex</h6>
                                    <input type="text" class="form-control" id="gender" name="gender" value="{{ optional($user->employees->genders)->gender_title  }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Marital Status</h6>
                                    <input type="text" class="form-control" id="marital_status" name="marital_status" value="{{ optional($user->employees->marital_statuses)->marital_status_title }}" disabled>
                               </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Birth Date</h6>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ optional($user->employees)->birthdate }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Contact Number</h6>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ optional($user->employees)->contact_number }}">
                                </div>
                            </div>
                            <div class="row mt-5 mb-5">
                                <div class="mb-2 col-lg-12 col-md-12 col-sm-12">
                                    <h6 class="profile-title">Address line 1</h6>
                                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" value="{{ optional($user->employees->employee_addresses)->address_line_1 }}" onchange="onKeyUpAddress();" >
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">City</h6>
                                    <input type="text" class="form-control" id="address_city" name="address_city" value="{{ optional($user->employees->employee_addresses)->city }}" onchange="onKeyUpAddress();" >
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Province</h6>
                                    <input type="text" class="form-control" id="address_province" name="address_province" value="{{ optional($user->employees->employee_addresses)->province }}" onchange="onKeyUpAddress();" >
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Region</h6>
                                    <input type="text" class="form-control" id="address_region" name="address_region" value="{{ optional($user->employees->employee_addresses)->region }}" onchange="onKeyUpAddress();" >
                                </div>
                            </div>
                            <div class="row mt-5 mb-3">
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Employment status</h6>
                                    <input type="text" class="form-control" id="employment_status" name="employment_status" value="{{ optional($user->employees->employment_statuses)->employment_status_title }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Date hired</h6>
                                    <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ optional($user->employees)->date_hired }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">ID Number</h6>
                                    <input type="text" class="form-control" id="sap_id_number" name="sap_id_number" value="{{ optional($user->employees)->sap_id_number }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">

                                </div>
                            </div>
                            <div class="row mt-3 mb-1">
                                <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Reports to</h6>
                                    <input type="text" class="form-control" id="reports_to" name="reports_to" value="{{ $reports_to }}" disabled>
                                </div>
                            </div>
                            <div class="row mt-1 mb-1">
                                <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Second superior</h6>
                                    <input type="text" class="form-control" id="second_reports_to" name="second_reports_to" value="{{ $second_reports_to }}" disabled>
                                </div>
                            </div>
                            <div class="row mt-3 mb-1">
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Department</h6>
                                    <input type="text" class="form-control" id="department" name="department" value="{{ optional($user->employees->employee_positions->positions->subdepartments->departments)->department_title }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Sub-department</h6>
                                    <input type="text" class="form-control" id="subdepartment" name="subdepartment" value="{{ optional($user->employees->employee_positions->positions->subdepartments)->sub_department_title }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Position</h6>
                                    <input type="text" class="form-control" id="position" name="position" value="{{ optional($user->employees->employee_positions->positions)->position_description }}" disabled>
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Area of assignment</h6>
                                    <input type="text" class="form-control" id="area_of_assignment" name="area_of_assignment" value="{{ optional($user->employees->employee_positions->area_of_assignments)->location_address }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <h3>Account details</h3>
                    </div>
                    <div class="row mt-1">
                        <div class="row mt-2 mb-1">
                            <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                <h6 class="profile-title">Email</h6>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-2 mb-1">
                            <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                <h6 class="profile-title">User name</h6>
                                <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $user->user_name }}">
                            </div>
                        </div>
                        <div class="row mt-2 mb-1">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h6 class="profile-title">Password</h6>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" placeholder="" name="password" value="{{ old('password') }}">
                                        <button type="button" class="btn rounded-end btn-outline-primary" id="show_password" onclick="showPass()">
                                            show
                                        </button>
                                        <button type="button" class="btn rounded-end btn-warning" id="hide_password" onclick="hidePass()" hidden>
                                            hide
                                        </button>
                                    </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h6 class="profile-title">Retype Password</h6>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                    <button type="button" class="btn rounded-end btn-outline-primary" id="show_repassword" onclick="showRePass()">
                                        show
                                    </button>
                                    <button type="button" class="btn rounded-end btn-warning" id="hide_repassword" onclick="hideRePass()" hidden>
                                        hide
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row mt-3 mb-1">
                            <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                <a href="#" class="profile-title-value btn btn-sm btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#reset_password_modal">reset password</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row mt-5 mb-5">
                        <div class="mb-2 col-lg-6 col-md-6 col-sm-12 text-end d-grid gap-2 mx-auto">
                            <button id="submit_button2" type="submit" class="btn btn-success rounded-0">Save Changes</button>
                            <a href="{{ URL::previous() }}" class="btn btn-danger rounded-0">Discard Changes</a>
                        </div>
                    </div>
                </form>
                {{-- END PROFILE Fields --}}
            </div>
        </div>
    </div>
</div>

@endsection
