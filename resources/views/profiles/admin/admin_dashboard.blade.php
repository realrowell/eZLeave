@extends('profiles.admin.admin_dashboard_layout')
@section('title','Admin Dashboard')
@section('menu_admin_dashboard','bg-selected-warning text-light')
@section('menu_user_management','text-dark')
@section('menu_login_logs','text-dark')
@section('sidebar_dashboard_active','active')
@section('sub-content')

<div class="row gap-3 mt-3">
    <div class="col-md p-3 bg-light shadow border border-5 border-warning border-top-0 border-bottom-0 border-end-0">
        <div class="container-fluid">
            <div class="row ">
                <div class="col text-start"><h5>Account Management</h5></div>
                <div class="col d-flex justify-content-end ">
                    <a href="/" class="btn btn-sm btn-secondary">see all</a>
                </div>
            </div>
            <div class="container-fluid mb-4">
                <div class="row align-items-center text-center g-2 mt-3">
                    <a href="{{ route('hrstaff_leave_pending_approval') }}" class="col-md text-dark">
                    <span id="approval_numbers" class="col">{{ $users_count }}</span>
                        <div class="row">
                        <span class="col">Number of Accounts</span>
                        </div>
                    </a>
                    <a href="{{ route('hrstaff_leave_approved') }}" class="col-md text-dark">
                    <span id="approval_numbers" class="col">{{ $users_count_active }}</span>
                        <div class="row">
                        <span class="col">Active Accounts</span>
                        </div>
                    </a>
                    <a href="{{ route('hrstaff_leave_pending_availment') }}" class="col-md text-dark">
                        <span id="approval_numbers" class="col">{{ $user_count_admin }}</span>
                        <div class="row">
                            <span class="col">Admin Accounts</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md p-3 bg-light shadow border border-5 border-warning border-top-0 border-bottom-0 border-end-0">
        <div class="container-fluid">
            <div class="row ">
                <div class="col text-start"><h5>Recent Logins</h5></div>
                <div class="col d-flex justify-content-end ">
                    <a href="{{ route('admin_login_logs') }}" class="btn btn-sm btn-secondary">see all</a>
                </div>
            </div>
            <div class="container-fluid mt-3 mb-4">
                @forelse ($login_logs as $login_log)
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action mt-1">
                            <div class="row">
                                <div class="col">
                                    {{ $login_log->users->first_name." ".$login_log->users->middle_name." ".$login_log->users->last_name }}
                                </div>
                                <div class="col text-end">
                                    {{ timestamp_leadtime($login_log->created_at) }}
                                </div>
                            </div>
                        </li>
                    </ul>
                @empty
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action mt-1">
                            <div class="row">
                                <div class="col text-center">
                                    No Recent Logins
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
