@extends('profiles.admin.settings.system_settings')
@section('menu_email',' text-dark')
@section('menu_system_info','bg-selected-warning text-light')
@section('menu_queue_info',' text-dark')
@section('sub-content')

<div class="row gap-1">
    <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_app_info')" style="min-height: 1rem" >
        <a href="{{ route('app.info') }}" class="@yield('submenu_app_info')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Application Information</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_system_info')" style="min-height: 1rem" >
        <a href="{{ route('system.info') }}" class="@yield('submenu_system_info')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>System Information</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_database_info')" style="min-height: 1rem" >
        <a href="{{ route('db.info') }}" class="@yield('submenu_database_info')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Database Information</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_other_info')" style="min-height: 1rem" >
        <a href="{{ route('other.info') }}" class="@yield('submenu_other_info')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Other Information</h6>
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

