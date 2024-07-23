@extends('includes.hrstaff_layout')
@section('title','Employee Management')
@section('sidebar_employee_management_active','active')
@section('content')

<div class="container-fluid " id="profile_body">
    {{-- <div class="row">
        <h5>Menu</h5>
    </div> --}}
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('submenu_all')" >
            <a href="{{ route('hrstaff_employees_grid') }}" class="@yield('submenu_all')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>All Employees</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('submenu_regular')" >
            <a href="{{ route('hrstaff_employees_regular_grid') }}" class="@yield('submenu_regular')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Regular</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch @yield('submenu_proba')" >
            <a href="{{ route('hrstaff_employees_probi_grid') }}" class="@yield('submenu_proba')">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Probationary</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid" id="profile_body">
    <div class="row" id="form_submit" >
        <div class="col bg-light shadow p-3 ps-4 pe-4">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
                    <div class="row">
                        <form action="{{ route('hrstaff_employees_grid_search') }}" onkeyup="searchBtnEnable()">
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
                <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">
                    <a href="{{ route('hrstaff_employees_regular_grid') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('grid_active')">
                        <i class='fs-6 bx bxs-grid-alt' ></i>
                        Grid View
                    </a>
                    <a href="{{ route('hrstaff_employees_regular_list') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('list_active')">
                        <i class='fs-6 bx bx-list-ul' ></i>
                        List View
                    </a>
                    <a href="#AddAccount" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#AddAccountModal">
                        <i class='bx bxs-user-plus' ></i>
                        Apply Employee
                    </a>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    @yield('sub-content')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Account Modal -->
<x-hrstaff.hr-employee-add-modal>
</x-hrstaff.hr-employee-add-modal>
{{-- End Add Account Modal --}}
@endsection
