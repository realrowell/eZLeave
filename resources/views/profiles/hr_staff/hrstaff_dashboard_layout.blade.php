@extends('includes.hrstaff_layout')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-2 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_hr_dashboard')" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_dashboard') }}" class="@yield('menu_hr_dashboard')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>HR Staff Dashboard</h6>
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
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('menu_leave_credits')" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_leave_credits') }}" class="@yield('menu_leave_credits')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Credits</h6>
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

    @yield('sub-content')

</div>
@endsection
