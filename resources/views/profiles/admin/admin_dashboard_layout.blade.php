@extends('includes.admin_layout')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    {{-- <div class="row">
        <h5>Menu</h5>
    </div> --}}
    <div class="row mb-2 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start d-print-none">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_admin_dashboard')" style="min-height: 1rem" >
            <a href="{{ route('admin_dashboard') }}" class="@yield('menu_admin_dashboard')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_user_management')" style="min-height: 1rem" >
            <a href="{{ route('admin_accounts_grid') }}" class="@yield('menu_user_management')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Account Management</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_login_logs')" style="min-height: 1rem" >
            <a href="{{ route('admin_login_logs') }}" class="@yield('menu_login_logs')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Login Logs</h6>
                    </div>
                </div>
            </a>
        </div>
        {{-- <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_leave_types')" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_leave_types') }}" class="@yield('menu_leave_types')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Types</h6>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>

    <div class="row">
        <div class="col">
            @yield('sub-content')
        </div>
    </div>

</div>
@endsection
