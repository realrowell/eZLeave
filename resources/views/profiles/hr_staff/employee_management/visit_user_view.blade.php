@extends('profiles.hr_staff.employee_management.employees')
@section('tab_options_display','d-none')
@section('submenu_all','text-dark')
@section('submenu_regular','text-dark')
@section('submenu_proba','text-dark')
@section('sub-content')

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 border border-start-0 border-top-0 border-bottom-0">
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
                <h4 class="text-dark">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h4>
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
    <div class="col-lg-9 col-md-9 col-sm-12 ps-5 pe-5 pb-5">
        <div class="row justify-content-start align-items-start text-start">
            <div class="col">
                <a href="{{ route('user_profile',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 ps-3 pe-3 custom-primary-button bg-selected-warning">
                    Profile
                </a>
                <a href="{{ route('user_profile_leave',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 ps-3 pe-3 custom-primary-button">
                    Leave MS
                </a>
            </div>
            <div class="col text-end">
                <a href="{{ route('visit_user_update',['username'=>$user->user_name]) }}" class="btn btn-sm btn-primary ps-5 pe-5 rounded-0">
                    Update Profile
                </a>
            </div>
        </div>
        {{-- LIST PROFILE --}}
        <div class="row mt-4">
            <div class="col">
                <h3>Employee details</h3>
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
                        <a href="#" class="profile-title-value btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#reset_password_modal">reset password</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- END LIST --}}
        <!-- confirm reset password Modal -->
            <x-hrstaff.hr-employee-reset-password-modal
                :username="$user->user_name"
            >
            </x-hrstaff.hr-employee-reset-password-modal>
        {{-- end confirm reset password Modal --}}
    </div>
</div>
@endsection
