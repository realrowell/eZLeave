@extends('includes.admin_layout')
@section('title','User Profile')
@section('sidebar_user_active','active')
@section('content')

{{-- <div class="banner-gradient p-5 text-center text-light ">
    <img style="max-width: 100%; height: auto;" src="/img/dashboard_banner_01.jpg" alt="">
    {{ now()->format('l') }}
</div> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col mt-2">
          <h3>Profile</h3>
        </div> 
    </div>
    <div class="row">
        <div class="row justify-content-center align-items-start">
            <div class="col-10 bg-light border-danger border-2 shadow-lg">
                <div class="row justify-content-center align-items-start pt-5 bg-gradient-light shadow-shine">
                    <div class="profile-photo-box align-items-start pt-3 pb-4">
                        <img class="profile-photo" src="/img/dummy_profile.jpg" alt="profile photo">
                    </div>
                </div>
                <div class="row ps-5 mt-5 pe-5">
                    <div class="col">
                        <h5>Personal Details</h5>
                    </div>
                    <div class="col text-end">
                        <a href="/profile/user_profile/edit" class="btn-sm btn-primary">edit</a>
                    </div>
                </div>
                {{-- @foreach ($employees as $employee)
                    {{ $employee->positions->id }}
                @endforeach --}}
                <div class="row ps-5 p-3 pe-5 pb-5">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row mt-2 mb-1" >
                            <h6 class="profile-title">Full Name</h6>
                            <h6 class="profile-title-value">{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Sex</h6>
                            <h6 class="profile-title-value">{{ Auth::user()->employees->gender_id }}</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Marital Status</h6>
                            <h6 class="profile-title-value">{{ Auth::user()->employees->marital_status_id }}</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Birth Date</h6>
                            <h6 class="profile-title-value">{{ Auth::user()->employees->birthdate }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Email</h6>
                            <h6 class="profile-title-value">{{ Auth::user()->email }}</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Contact Number</h6>
                            <h6 class="profile-title-value">{{ Auth::user()->employees->contact_number }}</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Employee Status</h6>
                            <h6 class="profile-title-value">{{ Auth::user()->employees->employment_status_id }}</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Position</h6>
                            <h6 class="profile-title-value">{{ optional(Auth::user()->employees->positions)->position_title }}</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Department</h6>
                            <h6 class="profile-title-value">HR & IT</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Sub-department</h6>
                            <h6 class="profile-title-value">Human Resource</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection