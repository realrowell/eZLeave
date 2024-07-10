@extends('includes.employee_profile_layout')
@section('title','Leave Details')
@section('content')

<div class="container-fluid d-print-none" id="profile_body" >
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch " >
            <a href="{{ route('employee_dashboard') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" >
            <a href="{{ route('employee_profile') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Profile</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning"  >
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid d-print-none " id="profile_body" >
    <div class="row">
        <h5>Leave Menu</h5>
    </div>
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch " >
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Pending Approval</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" >
            <a href="{{ route('profile_leave_management_pending_availment_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Pending Availment</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" >
            <a href="{{ route('profile_leave_management_history_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>History</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch ms-5" >
            <a href="{{ route('profile_leave_management_for_approval_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>For Approval</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch">
            <a href="{{ route('profile.leave_management.approval_history.list') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Approval History</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid" id="profile_body" >
    <div class="row">
        <div class="col bg-light shadow mb-5">
            <div class="row p-3">
                <div class="col">
                    @yield('sub-content')
                </div>
            </div>
        </div>
    </div>
</div>
<x-employee.leave-app-modal>
</x-employee.leave-app-modal>

@endsection
