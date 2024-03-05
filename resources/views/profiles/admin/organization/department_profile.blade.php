@extends('includes.admin_layout')
@section('title','Deparments')
@section('sidebar_organization_active','active')
@section('content')


<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3><a href="/admin/organization/menu" class="text-dark">Organization</a> / 
                <a href="/admin/organization/departments/grid" class="text-dark">Departments</a>
                 / Profile</h3>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">
            
        </div>
    </div>
    <div class="row justify-content-center align-items-start d-flex gap-2">
        <div class="col-lg-3 col-md-3 col-sm-10 bg-light align-self-stretch shadow bg-gradient-primary m-2" style="min-height: 10rem">
            <div class="row">
                <div class="col text-center mt-3 p-5">
                    <h4 class="text-light text-shadow-1">SALES and MARKETING</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-10">
            <div class="row justify-content-lg-center justify-content-md-start justify-content-sm-center justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-11 mt-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <p class="card-desc fs-1">65</p>
                            <div class="custom-h-50 custom-bg-primary custom-bg-primary-hover transition-1 text-shadow-2 text-light pt-2 fs-5">
                                Employees
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-11 mt-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <p class="card-desc fs-1">55</p>
                            <div class="custom-h-50 custom-bg-warning custom-bg-warning-hover transition-1 text-shadow-2 text-light pt-2 fs-5">
                                Regular
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-11 mt-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <p class="card-desc fs-1">10</p>
                            <div class="custom-h-50 custom-bg-warning custom-bg-warning-hover transition-1 text-shadow-2 text-light pt-2 fs-5">
                                Probationary
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-light mt-4 z-1 p-1 m-1 shadow">
                <div class="row justify-content-start align-items-start text-start">
                    <div class="col">
                        <a href="/admin/organization/departments/grid" class="ms-1 me-1 p-2 custom-primary-button bg-selected-warning">
                            Employees
                        </a>
                        <a href="/admin/organization/departments/grid" class="ms-1 me-1 p-2 custom-primary-button @yield('grid_active') ">
                            Regular
                        </a>
                        <a href="/admin/organization/departments/grid" class="ms-1 me-1 p-2 custom-primary-button @yield('list_active') ">
                            Probationary
                        </a>
                    </div>
                </div>
                {{-- LIST PROFILE --}}
                <div class="row">
                    <div>
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                {{-- <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2>Manage <b>Employees</b></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
                                        </div>
                                    </div>
                                </div> --}}
                                <table class="table table-striped table-hover bg-light">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Position</th>
                                            <th>Sub-department</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>EM-00192</td>
                                            <td>Thomas Hardy</td>
                                            <td>Territory Lead</td>
                                            <td>Luzon</td>
                                            <td class="d-flex gap-2">
                                                <a href="/profile/user_profile" class="btn-sm btn-primary">Profile</a>
                                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EM-00197</td>
                                            <td>Kenneth Ian</td>
                                            <td>Territory Lead</td>
                                            <td>Mindanao</td>
                                            <td class="d-flex gap-2">
                                                <a href="#" class="btn-sm btn-primary">Profile</a>
                                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EM-00201</td>
                                            <td>Arnold Gerillo</td>
                                            <td>Area Sales Lead</td>
                                            <td>Luzon</td>
                                            <td class="d-flex gap-2">
                                                <a href="#" class="btn-sm btn-primary">Profile</a>
                                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EM-00233</td>
                                            <td>Bobong Dela Cruz</td>
                                            <td>Zonal Sales Manager</td>
                                            <td>Luzon</td>
                                            <td class="d-flex gap-2">
                                                <a href="#" class="btn-sm btn-primary">Profile</a>
                                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                                            </td>
                                        </tr>					
                                        <tr>
                                            <td>EM-00241</td>
                                            <td>Jacob Arbarado</td>
                                            <td>Territory Lead</td>
                                            <td>Luzon</td>
                                            <td class="d-flex gap-2">
                                                <a href="#" class="btn-sm btn-primary">Profile</a>
                                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a href="#">Previous</a></li>
                                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- END LIST --}}
            </div>
        </div>
    </div>
    
</div>

@endsection