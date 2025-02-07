@extends('includes.employee_profile_layout')
@section('title','Leave Management')
@section('sidebar_leave_management_active','active')
@section('sidebar_leave_management_active_custom','active_custom')
@section('custom_active_leave_icon','var(--accent-color)')
@section('custom_active_for_approval','var(--accent-color)')
@section('profile_bar_display', 'none')
@section('content')

<div class="container-fluid d-print-none" id="profile_body" >
    {{-- <div class="row">
        <h5>Menu</h5>
    </div> --}}
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
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" style="min-height: 1rem" >
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
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_history_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>History</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch ms-5 bg-selected-primary" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_for_approval_grid') }}" class="text-light">
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
                <div class="col-12 col-lg-6 text-start mt-2">
                    <form action="{{ route('leave_details.search') }}" method="GET" onsubmit="onFormSubmit()" id="form_to_submit">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm rounded-0" placeholder="*Input Reference Number here" name="reference_number" id="reference_number" size="100" oninput="searchBtnEnable()">
                            <button type="submit" class="btn btn-sm btn-secondary rounded-0 disabled" id="search_btn">
                                <i class='bx bx-search'></i>
                                Search
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-6 text-end mt-2">
                    <a href="{{ route('profile_leave_management_for_approval_grid') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 @yield('grid_view_active')">
                        <i class='fs-6 bx bxs-grid-alt' ></i>
                        Grid View
                    </a>
                    <a href="{{ route('profile_leave_management_for_approval_list') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 @yield('list_view_active')">
                        <i class='fs-6 bx bx-list-ul' ></i>
                        List View
                    </a>
                </div>
            </div>
            <div class="row p-3">
                <div class="col">
                    @yield('sub-content')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
