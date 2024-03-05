@extends('includes.hrstaff_layout')
@section('title','HR Dashboard')
@section('sidebar_dashboard_active','active')
@section('sidebar_dashboard_active_custom','active_custom')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row mb-4 p-4 card shadow-sm align-self-stretch">
        <div class="col ">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 p-2">
                    <img class="profile-photo-sm" src="/img/dummy_profile.jpg" alt="">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                    <div class="row">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ optional(Auth::user()->suffixes)->suffix_title }}
                    </div>
                    <div class="row">
                        {{ Auth::user()->employees->employee_positions->positions->position_title }}
                    </div>
                    <div class="row">
                        {{ Auth::user()->employees->employee_positions->subdepartments->departments->department_title }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                    <div class="row">
                        {{ Auth::user()->email }}
                    </div>
                    <div class="row">
                        {{ Auth::user()->employees->contact_number }}
                    </div>
                    <div class="row">
                        {{ optional(Auth::user()->employees->employee_positions->area_of_assignments)->location_address }}
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 p-2">
                    <div class="row">
                      <a href="{{ route('employee_user_profile') }}" class="nav_link">
                        <i class="nav_icon" >@svg('css-profile')</i>
                        <span class="nav_name">Profile</span>
                      </a>
                    </div>
                    <div class="row">
                        <a id="logout_submit" class="nav_link" href="#{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out nav_icon"></i>
                            <span class="nav_name">SignOut</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_hr_dashboard')" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_dashboard') }}" class="@yield('menu_hr_dashboard')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>HR Staff Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_leave_credits')" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_leave_credits') }}" class="@yield('menu_leave_credits')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Credits</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_leave_management')" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_leave_management') }}" class="@yield('menu_leave_management')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_leave_types')" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_leave_types') }}" class="@yield('menu_leave_types')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Types</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    @yield('sub-content')
    
</div>
@endsection