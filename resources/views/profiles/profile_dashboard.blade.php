@extends('includes.employee_profile_layout')
@section('title','Dashboard')
@section('sidebar_dashboard_active','active')
@section('content')

<div class="container-fluid" id="profile_body">
    <div class="row mb-4 p-4 card shadow-sm align-self-stretch">
        <div class="col ">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 p-2">
                    @if (auth()->user()->profile_photos == null)
                        <img class="profile-photo-sm" src="/img/dummy_profile.jpg" alt="profile photo">
                    @else
                        <img class="profile-photo-sm" src="{{ asset('storage/images/profile_photos/'.auth()->user()->profile_photos->profile_photo) }}" alt="profile photo">
                    @endif
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                    <div class="row">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ optional(Auth::user()->suffixes)->suffix_title }}
                    </div>
                    <div class="row">
                        {{ optional(optional(Auth::user()->employees->employee_positions)->positions)->position_description }}
                    </div>
                    <div class="row">
                        {{ optional(optional(optional(optional(Auth::user()->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                    <div class="row">
                        {{ Auth::user()->email }}
                    </div>
                    <div class="row">
                        {{ Auth::user()->employees->contact_number }}
                    </div>
                    <div class="row">
                        {{ optional(optional(optional(Auth::user()->employees->employee_positions)->positions)->area_of_assignments)->location_address }}
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 p-2">
                    <div class="row">
                    <a href="{{ route('employee_user_profile') }}" class="nav_link">
                        <i class="nav_icon" >@svg('css-profile')</i>
                        <span class="nav_name">Profile</span>
                    </a>
                    </div>
                    <div class="row">
                        <a id="logout_submit" class="nav_link" href="#{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out nav_icon"></i>
                            <span class="nav_name">SignOut</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" id="profile_body">
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
            <a href="{{ route('employee_dashboard') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('employee_profile') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Profile</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <div class="col mt-2">
        <h3>Dashboard</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row justify-content-center align-items-start g-2">
                <div class="col-md bg-light border pt-2 ps-2 pb-5 me-2 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col">
                                <h5>Leave Management</h5>
                            </div>
                            <div class="col d-flex justify-content-end pe-4">
                                <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="btn-sm btn btn-outline-primary">see all</a>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center text-center g-2 mt-3">
                            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="col-md text-dark">
                            <span id="approval_numbers" class="col">{{ $pending_leaves_count }}</span>
                                <div class="row">
                                <span class="col">Pending Approval</span>
                                </div>
                            </a>
                            <a href="#" class="col-md text-dark">
                            <span id="approval_numbers" class="col">{{ $approved_leaves_count }}</span>
                                <div class="row">
                                <span class="col">Approved</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md bg-light border pt-2 ps-2 pb-5 me-2 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-8">
                                <h5>Leave Credits (Remaining)</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-end pe-4">
                                <a href="/" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                                    <i class='bx bx-message-square-add' ></i>
                                    File a Leave
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center text-center g-2 mt-3">
                            @foreach ($leave_credits as $leave_credit)
                                <div class="col">
                                    <span id="approval_numbers" class="col">{{ $leave_credit->leave_days_credit }}</span>
                                    <div class="row">
                                        <span class="col">{{ $leave_credit->leavetypes->leave_type_title }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Apply leave Modal -->
        <div class="modal fade" id="ApplyLeaveModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none;">
                        <span class="visually-hidden" >Loading...</span>
                    </div>
                    <form action="{{ route('create_employee_leaveapplication') }}" method="POST" onsubmit="return submitButtonDisabled()" enctype="multipart/form-data" id="form_submit">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">File a Leave Application</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col text-center">
                                    <svg width="80px" height="80px" viewBox="-2.4 -2.4 28.80 28.80">
                                        {{ svg('tabler-calendar-time') }}
                                    </svg>
                                </div>
                            </div>
                            <div class="container-fluid text-start">
                                <div class="row">
                                    <div class="col">
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Leave Type</h6>
                                                </label>
                                                <select class="form-select" id="leavetype" name="leavetype" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($leave_credits as $leave_credit)
                                                        <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <label for="startdate">
                                                    <h6>Start date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_startdate" name="startdate" placeholder="" required onchange="showLeaveDuration()">
                                            </div>
                                            <div class="col-6">
                                                <label for="enddate">
                                                    <h6>End date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_enddate" name="enddate" placeholder="" required onchange="showLeaveDuration()">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            {{-- <div class="col " id="datelabel" style="display: none;">
                                                <div class="form-check">
                                                    <label for="partOfDay_check" class="form-check-label" >Half Day?</label>
                                                    <input type="checkbox" class="form-check-input" id="partOfDay_check" name="partOfDay_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div> --}}
                                            <div class="col" id="datelabel_start_am" style="display: none;">
                                                <div class="form-check">
                                                    <label for="start_am_check" class="form-check-label" >Morning</label>
                                                    <input type="checkbox" class="form-check-input" id="start_am_check" name="start_am_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_start_pm" style="display: none;">
                                                <div class="form-check">
                                                    <label for="start_pm_check" class="form-check-label" >Afternoon</label>
                                                    <input type="checkbox" class="form-check-input" id="start_pm_check" name="start_pm_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_end_am" style="display: none;">
                                                <div class="form-check">
                                                    <label for="end_am_check" class="form-check-label" >Morning</label>
                                                    <input type="checkbox" class="form-check-input" id="end_am_check" name="end_am_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_end_pm" style="display: none;">
                                                <div class="form-check">
                                                    <label for="end_pm_check" class="form-check-label" >Afternoon</label>
                                                    <input type="checkbox" class="form-check-input" id="end_pm_check" name="end_pm_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label for="">Duration (days)</label>
                                                <input type="text" name="duration" placeholder="" id="duration_input" class="form-control" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label class="" for="attachment">
                                                    <h6 class="">Attachment</h6>
                                                </label>
                                                <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label class="" for="reason">
                                                    <h6 class="">Reason / Note</h6>
                                                </label>
                                                <textarea class="form-control" id="reason" name="reason" rows="5" cols="50"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" id="form_submit" style="opacity: 1">
                            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal" >Discard</button>
                            <div class="spinner-border text-primary" id="loading_spinner1" role="status" style="display: none;">
                                <span class="visually-hidden" >Loading...</span>
                            </div>
                            <button id="submit_button1" type="submit" class="btn btn-success" onclick="onClickLeaveApplySpinnerShow()">Apply Leave</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- End Apply leave Modal --}}
</div>
@endsection
