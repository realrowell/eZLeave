@extends('includes.admin_layout')
@section('sidebar_settings_active','active')
@section('content')

<div class="container-fluid " id="profile_body">
    <div class="row mb-2 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start d-print-none">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_email')" style="min-height: 1rem" >
            <a href="{{ route('email.settings.info') }}" class="@yield('menu_email')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Email Settings</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_holidays')" style="min-height: 1rem" >
            <a href="{{ route('admin_accounts_grid') }}" class="@yield('menu_holidays')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Holidays</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_system_info')" style="min-height: 1rem" >
            <a href="{{ route('app.info') }}" class="@yield('menu_system_info')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>System Info</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @yield('sub-content')
        </div>
    </div>
</div>

@endsection
