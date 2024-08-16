@extends('profiles.admin.settings.system_settings')
@section('menu_email','bg-selected-warning text-light')
@section('menu_holidays',' text-dark')
@section('menu_system_info',' text-dark')
@section('sub-content')

<div class="row gap-1">
    <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_email_info')" style="min-height: 1rem" >
        <a href="{{ route('email.settings.info') }}" class="@yield('submenu_email_info')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Email Info</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_test_email')" style="min-height: 1rem" >
        <a href="{{ route('admin_accounts_grid') }}" class="@yield('submenu_test_email')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Test Email</h6>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row mt-3 p-3 bg-light shadow">
    <div class="col">
        @yield('sub-sub-content')
    </div>
</div>
@endsection

