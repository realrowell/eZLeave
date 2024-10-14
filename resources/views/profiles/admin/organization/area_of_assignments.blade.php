@extends('includes.admin_layout')
@section('title','Area of Assignments')
@section('sidebar_organization_active','active')
@section('content')

<div class="container-fluid " id="profile_body">
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin_departments_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Departments</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin_subdepartments_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Sub-departments</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin_positions_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Positions</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
            <a href="{{ route('admin_areaofassignemnts_grid') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Area of Assignments</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid" id="profile_body">
    <div class="row bg-light shadow p-3">
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <h4>Organization / Area of assignments</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end">
                    <a href="{{ route('admin_areaofassignemnts_grid') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('grid_active')">
                        <i class='fs-6 bx bxs-grid-alt' ></i>
                        Grid View
                    </a>
                    <a href="{{ route('admin_areaofassignemnts_list') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('list_active')">
                        <i class='fs-6 bx bx-list-ul' ></i>
                        List View
                    </a>
                    <a href="#AddDept" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#create_aoa">
                        <i class='bx bxs-user-plus' ></i>
                        Create Area of assignemnt
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @yield('sub-content')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Area of assignment Modal -->
    <x-admin.admin-aoa-add-modal>
    </x-admin.admin-aoa-add-modal>
<!-- End Add Area of assignment Modal -->
@endsection
