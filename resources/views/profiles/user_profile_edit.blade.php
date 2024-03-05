@extends('includes.employee_profile_layout')
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
          <h3>Edit Profile</h3>
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
                        <h5>Edit Personal Details</h5>
                    </div>
                    {{-- <div class="col text-end">
                        <a href="#" class="btn-sm btn-success">save</a>
                    </div> --}}
                </div>
                <div class="row ps-5 p-3 pe-5">
                    <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                        <div class="row mt-2 mb-1" >
                            <h6 class="profile-title">Full Name</h6>
                            <h6 class="profile-title-value">Richard Anderson</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Sex</h6>
                            <h6 class="profile-title-value">Male</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <label for="marital_status"><h6 class="profile-title">Marital Status</h6></label>
                            <select class="form-control">
                                <option selected>Married</option>
                                <option value>Single</option>
                                <option value>Divorced</option>
                                <option value>Separated</option>
                                <option value>Widowed</option>
                            </select>
                            {{-- <input type="text" class="form-control" id="marital_status" placeholder="Married"> --}}
                        </div>
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Birth Date</h6>
                            <h6 class="profile-title-value">September 23, 1995</h6>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                        <div class="row mt-2 mb-1">
                            <h6 class="profile-title">Email</h6>
                            <h6 class="profile-title-value">richard.anderson@bioseed.com</h6>
                        </div>
                        <div class="row mt-2 mb-1">
                            <label for="contact_number"><h6 class="profile-title">Contact Number</h6></label>
                            <input type="text" class="form-control" id="contact_number" placeholder="0992 021 3345">
                        </div>
                        <div class="row mt-2 mb-1">
                            <label for="employee_status"><h6 class="profile-title">Employee Status</h6></label>
                            <select class="form-control" id="employee_status">
                                <option selected>Regular</option>
                                <option value>Probationary</option>
                            </select>
                        </div>
                        <div class="row mt-2 mb-1">
                            <label for="position"><h6 class="profile-title">Position</h6></label>
                            <input type="text" class="form-control" id="position" placeholder="HR Associate">
                        </div>
                        <div class="row mt-2 mb-1">
                            <label for="department"><h6 class="profile-title">Department</h6></label>
                            <input type="text" class="form-control" id="department" placeholder="HR & IT">
                        </div>
                        <div class="row mt-2 mb-1">
                            <label for="sub-department"><h6 class="profile-title">Sub-department</h6></label>
                            <input type="text" class="form-control" id="sub-department" placeholder="Human Resource">
                        </div>
                    </div>
                </div>
                <div class="row ps-5 p-3 pe-5 pb-5">
                    <div class="col text-end">
                        {{-- <button type="submit" class="btn m-2 btn-success">Apply Changes</button> --}}
                        <a href="#apply_changes" class="btn m-2 btn-success" data-bs-toggle="modal" data-bs-target="#apply_changes">
                            {{-- <i class="">
                                <svg width="30px" height="30px" fill=none viewBox="-2.4 -2.4 28.80 28.80" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Check_All_Big"> <path id="Vector" d="M7 12L11.9497 16.9497L22.5572 6.34326M2.0498 12.0503L6.99955 17M17.606 6.39355L12.3027 11.6969" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                            </i> --}}
                            Apply Changes
                        </a>
                        <a href="#discard_modal" class="btn m-2 btn-danger" data-bs-toggle="modal" data-bs-target="#discard_modal">
                            Discard Changes
                        </a>
                    </div>
                </div>
                {{-- Apply Changes Modal --}}
                <div class="modal fade" id="apply_changes" tabindex="-1" aria-labelledby="apply_changes" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to apply this changes?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="danger_icon" class="row justify-content-center align-items-center mb-3">
                                <svg fill="var(--success-color)" width="50px" height="50px" viewBox="-2 -2 24.00 24.00" xmlns="http://www.w3.org/2000/svg" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" d="M3 10a7 7 0 019.307-6.611 1 1 0 00.658-1.889 9 9 0 105.98 7.501 1 1 0 00-1.988.22A7 7 0 113 10zm14.75-5.338a1 1 0 00-1.5-1.324l-6.435 7.28-3.183-2.593a1 1 0 00-1.264 1.55l3.929 3.2a1 1 0 001.38-.113l7.072-8z"></path> </g></svg>
                            </div>  
                            <h5 class="card-title text-center">Confirm your password</h5>
                            <input type="password" class="form-control mt-4 mb-3" placeholder="Please input your password here to confirm your identity">
                        </div>
                        <div class="modal-body d-grid gap-2">
                            {{-- <a href="#" class="btn btn-success text-light">Apply Changes</a> --}}
                            <button type="submit" class="btn btn-success text-light">Apply Changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- End Apply Changes Modal --}}
                {{-- Discard Modal --}}
                <div class="modal fade" id="discard_modal" tabindex="-1" aria-labelledby="discard_modal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to discard this changes?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="danger_icon" class="row justify-content-center align-items-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" fill="white" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="modal-body d-grid gap-2">
                            <a href="/profile/user_profile" class="btn btn-danger text-center">Confirm</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- End Discard Modal --}}
            </div>
        </div>
    </div>
</div>

@endsection