@extends('profiles.admin.admin_dashboard_layout')
@section('title','Account Management')
@section('sidebar_employee_management_active','active')
@section('sub-content')

<div class="row">
    <div class="container-fluid">
        <div class="row mt-3 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
            <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_all')" style="min-height: 1rem" >
                <a href="{{ route('admin_accounts_grid') }}" class="@yield('submenu_all')">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>All Accounts</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_admin')" style="min-height: 1rem" >
                <a href="#" class="@yield('submenu_admin')">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Admin Accounts</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_employee')" style="min-height: 1rem" >
                <a href="#" class="@yield('submenu_employee')">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Employee Accounts</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-3 bg-light shadow">
        <div class="row p-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row">
                    <form action="{{ route('admin_accounts_search_grid') }}" onkeyup="searchBtnEnable()">
                    @csrf
                        <div class="input-group">
                            <input type="search" class="form-control form-control-sm rounded-0" name="search_input" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-sm btn-primary ps-3 pe-3 rounded-0 disabled" id="search_btn">search</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <p>*Search employee by first name or by last name here</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end mt-2">
                <a href="{{ route('admin_accounts_grid') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('grid_active')">
                    <i class='fs-6 bx bxs-grid-alt' ></i>
                    Grid View
                </a>
                <a href="{{ route('admin_accounts_list') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('list_active')">
                    <i class='fs-6 bx bx-list-ul' ></i>
                    List View
                </a>
                <a href="#AddAccount" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#AddAccountModal">
                    <i class='bx bxs-user-plus' ></i>
                    Add Admin Account
                </a>
                <a href="#AddEmployee" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#AddEmployeeModal">
                    <i class='bx bxs-user-plus' ></i>
                    Add Employee Account
                </a>
                <!-- Add Account Modal -->
                    <x-admin.admin-account-add-modal>
                    </x-admin.admin-account-add-modal>
                {{-- End Add Account Modal --}}
                <!-- Add Employee Modal -->
                    <x-hrstaff.hr-employee-add-modal>
                    </x-hrstaff.hr-employee-add-modal>
                {{-- End Add Employee Modal --}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                @yield('sub-sub-content')
            </div>
        </div>
    </div>
</div>
@endsection
