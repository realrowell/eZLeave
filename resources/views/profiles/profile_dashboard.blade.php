@extends('includes.employee_profile_layout')
@section('title','Dashboard')
@section('sidebar_dashboard_active','active')
@section('content')

{{-- <div class="banner-gradient p-5 text-center text-light ">
  <h2 class="banner-title text-shadow">
    Bioseed Leave Management System
  </h2>
</div> --}}
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
      <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
          <a href="{{ route('employee_dashboard') }}" class="text-light">
              <div class="col text-light-hover">
                  <div class="card-body">
                      <h6>Dashboard</h6>
                  </div>
              </div>
          </a>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
          <a href="{{ route('employee_profile') }}" class="text-dark">
              <div class="col text-light-hover">
                  <div class="card-body">
                      <h6>Profile</h6>
                  </div>
              </div>
          </a>
      </div>
      
      <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
        <a href="{{ route('profile_leave_management_menu') }}" class="text-dark">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Leave Management</h6>
                </div>
            </div>
        </a>
    </div>
  </div>

  <div class="row">
    <div class="col mt-2">
      <h3>Dashboard</h3>
    </div>
  </div>
  <div class="row">
    <div class="row justify-content-center align-items-start g-2">
      <div class="col-md bg-light border pt-2 ps-2 pb-5 me-2 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
        <div class="row ">
          <div class="col"><h5>Leave Management</h5></div>
          <div class="col d-flex justify-content-end pe-4">
            <a href="/" class="btn-sm btn-primary">see all</a>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row justify-content-center align-items-center text-center g-2 mt-3">
            <a href="/profile/leave_management/for_approval" class="col-md text-dark">
              <span id="approval_numbers" class="col">{{ $pending_leaves_count }}</span>
                <div class="row">
                  <span class="col">Pending Approval</span>
                </div>
            </a>
            <a href="#" class="col-md text-dark">
              <span id="approval_numbers" class="col">{{ $approved_leaves_count }}</span>
                <div class="row">
                  <span class="col">Approved</span>
                </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md bg-light border pt-2 ps-2 pb-5 ms-2 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
        <div class="row ">
          <div class="col"><h5>News and Updates</h5></div>
          <div class="col d-flex justify-content-end pe-4">
            <a href="/" class="btn-sm btn-primary">see all</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
@endsection