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
                <div class="d-grid gap-2 col-12 mx-auto mb-3">
                    {{-- <button class="btn btn-sm btn-primary" type="button">Upload Profile Photo</button> --}}
                    <div class="form-control form">
                        <form action="{{ route('admin_update_profile_photo',['username'=>$user->user_name]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="profile_photo" class="form-label mt-3">Upload Profile Photo</label>
                            <input class="form-control" type="file" id="profile_photo" name="profile_photo">
                            <button class="form-control btn btn-sm btn-primary mt-4 mb-3" type="submit">Upload</button>
                        </form>
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
            {{-- PROFILE Fields --}}
            <form action="{{ route('update_admin_account',['username'=>$user->user_name]) }}" method="POST" onsubmit="submitButtonDisabled()">
            @csrf
                <div class="row">
                    <div class="row mt-5">
                        <div class="col-lg-4 col-md-3 col-sm-12">
                            <h3>Account details</h3>
                        </div>
                        <div class="col-lg-8 col-md-9 col-sm-12">
                            <div class="text-end d-flex gap-3 justify-content-end">
                                <a href="{{ URL::previous() }}" class="btn btn-sm btn-danger rounded-0 ps-3 pe-3">Discard Changes</a>
                                <button id="submit_button1" type="submit" class="btn btn-sm btn-success rounded-0 ps-3 pe-3">Save Changes</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="row mt-2 mb-1" >
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">First name</h6>
                                    <input type="text" class="form-control" id="first_name" name="firstname" value="{{ $user->first_name }}">
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Middle name</h6>
                                    <input type="text" class="form-control" id="middle_name" name="middlename" value="{{ $user->middle_name }}">
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Last name</h6>
                                    <input type="text" class="form-control" id="last_name" name="lastname" value="{{ $user->last_name }}">
                                </div>
                                <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Suffix</h6>
                                    <select class="form-control" id="suffix" name="suffix">
                                        @if ($user->suffix_id == null)
                                            <option selected value="">N/A</option>
                                            @foreach ($suffixes as $suffix)
                                                <option value="{{ $suffix->id }}">{{ $suffix->suffix_title }}</option>
                                            @endforeach
                                        @else
                                            <option selected value="{{ null }}">remove</option>
                                            <option selected value="{{ $user->suffix_id }}">{{ optional($user->suffixes)->suffix_title }}</option>
                                            @foreach ($suffixes as $suffix)
                                                @if ($suffix->id != $user->suffix_id)
                                                    <option value="{{ $suffix->id }}">{{ $suffix->suffix_title }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="row mt-2 mb-1">
                            <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                <h6 class="profile-title">Email</h6>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
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
                        <div class="row mt-3 mb-1">
                            <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                <a href="#" class="profile-title-value btn btn-sm btn-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#reset_password_modal">reset password</a>
                            </div>
                        </div>
                        <div class="row mb-2">
                            @if ($user->status_id == 'sta-2001')
                                <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                    <a href="#" class="profile-title-value btn btn-sm btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#deactivate_account_modal">Deactivate Account</a>
                                </div>
                            @elseif ($user->status_id == 'sta-2002')
                                <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                    <a href="#" class="profile-title-value btn btn-sm btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#activate_account_modal">Activate Account</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3 mb-5">
                        {{-- <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        </div> --}}
                        <div class="mb-2 col-lg-6 col-md-6 col-sm-12 text-end d-grid gap-2 mx-auto">
                            <button id="submit_button2" type="submit" class="btn btn-sm btn-success rounded-0">Save Changes</button>
                            <a href="{{ URL::previous() }}" class="btn btn-sm btn-danger rounded-0">Discard Changes</a>
                        </div>
                    </div>
                </div>
            </form>
            {{-- END PROFILE Fields --}}
            <!-- confirm reset password Modal -->
                <x-hrstaff.hr-employee-reset-password-modal
                    :username="$user->user_name"
                >
                </x-hrstaff.hr-employee-reset-password-modal>
            {{-- end confirm reset password Modal --}}
            <!-- deactivate account Modal -->
                <x-admin.admin-account-deactivate-modal
                    :username="$user->user_name"
                >
                </x-admin.admin-account-deactivate-modal>
            {{-- end deactivate account Modal --}}
            <!-- activate account Modal -->
                <x-admin.admin-account-activate-modal
                    :username="$user->user_name"
                    >
                </x-admin.admin-account-activate-modal>
            {{-- end activate account Modal --}}
        </div>
    </div>
</div>
@endsection
