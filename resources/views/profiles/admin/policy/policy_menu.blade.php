@extends('includes.admin_layout')
@section('title','Policy Menu')
@section('sidebar_policy_active','active')
@section('content')

<div class="banner-gradient p-5 text-center text-light ">
    <h2 class="banner-title">
        Bioseed Leave Management System
    </h2>
</div>
<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <div class="col mt-2">
          <h3>Policy Menu</h3>
        </div>
        <div class="col text-end mt-2">
            <a href="/admin/policy/create" class="col p-2 ms-2 custom-primary-button custom-rounded-top">
                <i class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Add New
            </a>
        </div>
    </div>
    <div class="row">
        <div class="row justify-content-start align-items-start g-4">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <a href="/admin/policy/view" class="text-dark">
                    <div class="col-lg-4 col-md-6 col-sm-10 card-menu border-0 shadow w-100">
                        <div class="card-body row">
                            <div class="">
                                <div class="row">
                                    <h5><strong>Leave Policy</strong></h5>
                                </div>
                                <div class="row">
                                    <p class="card-desc">Author: Human Resource</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <a href="#" class="text-dark">
                    <div class="col-lg-4 col-md-6 col-sm-10 card-menu border-0 shadow w-100">
                        <div class="card-body row">
                            <div class="">
                                <div class="row">
                                    <h5><strong>System Policy</strong></h5>
                                </div>
                                <div class="row">
                                    <p class="card-desc">Author: IT</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <a href="#" class="text-dark">
                    <div class="col-lg-4 col-md-6 col-sm-10 card-menu border-0 shadow w-100">
                        <div class="card-body row">
                            <div class="">
                                <div class="row">
                                    <h5><strong>System Policy</strong></h5>
                                </div>
                                <div class="row">
                                    <p class="card-desc">Author: IT</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <a href="#" class="text-dark">
                    <div class="col-lg-4 col-md-6 col-sm-10 card-menu border-0 shadow w-100">
                        <div class="card-body row">
                            <div class="">
                                <div class="row">
                                    <h5><strong>System Policy</strong></h5>
                                </div>
                                <div class="row">
                                    <p class="card-desc">Author: IT</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
    
</div>
@endsection