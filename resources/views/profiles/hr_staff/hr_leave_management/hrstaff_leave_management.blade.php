@extends('profiles.hr_staff.hrstaff_dashboard_layout')
@section('title','HR Leave Management')
@section('sidebar_leave_management_active','active')
@section('sidebar_leave_management_active_custom','active_custom')
@section('custom_active_leave_icon','var(--accent-color)')
@section('menu_hr_dashboard','text-dark')
@section('menu_leave_credits','text-dark')
@section('menu_leave_management','bg-selected-warning text-light')
@section('menu_leave_types','text-dark')
@section('sub-content')

{{-- <div class="row d-print-none">
    <div class="col ">
      <h5>Leave Menu</h5>
    </div>
</div> --}}
<div class="row gap-1 justify-content-center justify-content-sm-center justify-content-lg-start d-print-none">
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_all')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_management') }}" class="@yield('sub_menu_all')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>All</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_pending_approval')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_pending_approval') }}" class="@yield('sub_menu_pending_approval')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Pending Approval</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_pending_availment')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_pending_availment') }}" class="@yield('sub_menu_pending_availment')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Pending Availment</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_approved')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_approved') }}" class="@yield('sub_menu_approved')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Approved</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_cancelled')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_cancelled') }}" class="@yield('sub_menu_cancelled')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Cancelled</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_reject')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_rejected') }}" class="@yield('sub_menu_reject')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Rejected</h6>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row bg-light p-3 mt-3 shadow">
    <div class="col">
        @yield('sub-sub-content')
    </div>
</div>
<!-- Apply leave Modal -->
    <x-hrstaff.hr-leave-app-modal>
    </x-hrstaff.hr-leave-app-modal>
<!-- End Apply leave Modal -->

<div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none; z-index: 1060">
    <span class="visually-hidden" >Loading...</span>
</div>
<div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none; z-index: 1060">
    <span class="visually-hidden" >Loading...</span>
</div>
@endsection
