@extends('profiles.admin.admin_dashboard_layout')
@section('title','Account Management')
@section('sidebar_employee_management_active','active')
@section('grid_active','bg-selected-warning')
@section('menu_admin_dashboard','text-dark')
@section('menu_user_management','bg-selected-warning text-light')
@section('menu_login_logs','text-dark')
@section('sub-content')


<div class="row p-3 mt-3 bg-light shadow">
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
            {{-- LIST PROFILE --}}
            <div class="row mt-5">
                <div class="col-6">
                    <h3>Account details</h3>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('admin_visit_account_update_view',['username'=>$user->user_name]) }}" class="btn btn-sm btn-primary ps-5 pe-5 rounded-0">
                        Update Profile
                    </a>
                </div>
            </div>
            <div class="row mt-1 mb-5">
                <div class="row mt-2 mb-2" >
                    <h6 class="profile-title">Full Name</h6>
                    <h6 class="profile-title-value">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h6>
                </div>
                <div class="row mt-2 mb-1">
                    <h6 class="profile-title">Email</h6>
                    <h6 class="profile-title-value">{{ $user->email }}</h6>
                </div>
                <div class="row mt-2 mb-1">
                    <h6 class="profile-title">User name</h6>
                    <h6 class="profile-title-value">{{ $user->user_name }}</h6>
                </div>
                <div class="row mt-2 mb-1">
                    <h6 class="profile-title">Role</h6>
                    <h6 class="profile-title-value">{{ $user->roles->role_title }}</h6>
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
</div>
@endsection
