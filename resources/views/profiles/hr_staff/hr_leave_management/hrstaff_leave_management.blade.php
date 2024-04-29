@extends('profiles.hr_staff.hrstaff_dashboard_layout')
@section('title','HR Leave Management')
@section('sidebar_leave_management_active','active')
@section('sidebar_leave_management_active_custom','active_custom')
@section('custom_active_leave_icon','var(--accent-color)')
@section('menu_hr_dashboard','text-dark')
@section('menu_leave_credits','text-dark')
@section('menu_leave_management','bg-selected-warning text-light')
@section('menu_leave_types','text-dark')
@section('sub-content')

<div class="row">
    <div class="col mt-2">
      <h5>Leave Menu</h5>
    </div>
</div>
<div class="row gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_all')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_management') }}" class="@yield('sub_menu_all')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>All</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_pending_approval')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_pending_approval') }}" class="@yield('sub_menu_pending_approval')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Pending Approval</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_pending_availment')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_pending_availment') }}" class="@yield('sub_menu_pending_availment')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Pending Availment</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_approved')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_approved') }}" class="@yield('sub_menu_approved')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Approved</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_cancelled')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_cancelled') }}" class="@yield('sub_menu_cancelled')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Cancelled</h6>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-1 col-md-2 col-sm-4 col-8 card-menu-primary shadow-sm align-self-stretch @yield('sub_menu_reject')" style="min-height: 1rem" >
        <a href="{{ route('hrstaff_leave_rejected') }}" class="@yield('sub_menu_reject')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Rejected</h6>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row gap-3 mt-3">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h3>HR Staff / Leave Management</h3>
                </div>
                <div class="col">
                    {{-- <div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Fiscal Year:
                            @if (Request()->fiscal_year == null)
                                {{ $current_fiscal_year->fiscal_year_title }}
                            @else
                                @foreach ($fiscal_years as $fiscal_year)
                                    @if ( $fiscal_year->id == Request()->fiscal_year)
                                        {{ $fiscal_year->fiscal_year_title }}
                                    @endif
                                @endforeach
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                          @foreach ($fiscal_years as $fiscal_year)
                              <li><a class="dropdown-item" href="{{ route('hrstaff_fy_leave_credits',['fiscal_year'=>$fiscal_year->id]) }}">{{ $fiscal_year->fiscal_year_title }}</a></li>
                          @endforeach
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col text-end align-items-end">
            <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Apply Leave
            </a>
        </div>
    </div>

    <!-- Apply leave Modal -->
        <div class="modal fade" id="ApplyLeaveModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none;">
                        <span class="visually-hidden" >Loading...</span>
                    </div>
                    <form action="{{ route('create_leaveapplication') }}" method="POST" onsubmit="return submitButtonDisabled()" enctype="multipart/form-data" id="form_submit">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">File a Leave Application</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="form_submit">
                            <div class="container-fluid text-start">
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                        <h2></h2>
                                    </div>
                                    <div class="col-lg-9 col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col">
                                                <label for="employee">
                                                    <h6 class="">For Employee</h6>
                                                </label>
                                                <select class="form-select" id="employee" name="employee" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ optional($employee->users)->last_name }}, {{ optional($employee->users)->first_name }} {{ optional($employee->users)->middle_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Leave Type</h6>
                                                </label>
                                                <select class="form-select" id="leavetype" name="leavetype" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($leavetypes as $leavetype)
                                                        <option value="{{ $leavetype->id }}">{{ $leavetype->leave_type_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <label for="startdate">
                                                    <h6>Start date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_startdate" name="startdate" placeholder="" required onchange="showLeaveDurationHR()">
                                            </div>
                                            <div class="col-6">
                                                <label for="enddate">
                                                    <h6>End date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_enddate" name="enddate" placeholder="" onchange="showLeaveDurationHR()">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col" id="datelabel_start_am" style="display: none;">
                                                <div class="form-check">
                                                    <label for="start_am_check" class="form-check-label" >Morning</label>
                                                    <input type="checkbox" class="form-check-input" id="start_am_check" name="start_am_check" value="1" onchange="showLeaveDurationHR()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_start_pm" style="display: none;">
                                                <div class="form-check">
                                                    <label for="start_pm_check" class="form-check-label" >Afternoon</label>
                                                    <input type="checkbox" class="form-check-input" id="start_pm_check" name="start_pm_check" value="1" onchange="showLeaveDurationHR()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_end_am" style="display: none;">
                                                <div class="form-check">
                                                    <label for="end_am_check" class="form-check-label" >Morning</label>
                                                    <input type="checkbox" class="form-check-input" id="end_am_check" name="end_am_check" value="1" onchange="showLeaveDurationHR()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_end_pm" style="display: none;">
                                                <div class="form-check">
                                                    <label for="end_pm_check" class="form-check-label" >Afternoon</label>
                                                    <input type="checkbox" class="form-check-input" id="end_pm_check" name="end_pm_check" value="1" onchange="showLeaveDurationHR()">
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
    <!-- Apply leave Modal -->
        <div class="modal fade" id="ApplyLeaveModals" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="z-index: 1060; display: none;">
                        <span class="visually-hidden" >Loading...</span>
                    </div>
                    <form action="{{ route('create_leaveapplication') }}" id="form_submit" method="POST" onsubmit="submitButtonDisabled()"  enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Apply Leave</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="form_submit">
                            <div class="container-fluid text-start">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                        <h2></h2>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col">
                                                <label for="employee">
                                                    <h6 class="">For Employee</h6>
                                                </label>
                                                <select class="form-select" id="employee" name="employee" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ optional($employee->users)->last_name }}, {{ optional($employee->users)->first_name }} {{ optional($employee->users)->middle_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Leave Type</h6>
                                                </label>
                                                <select class="form-select" id="leavetype" name="leavetype" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($leavetypes as $leavetype)
                                                        <option value="{{ $leavetype->id }}">{{ $leavetype->leave_type_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <label for="startdate">
                                                    <h6>Start date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_startdate" name="startdate" placeholder="" required onchange="showPartDay()">
                                            </div>
                                            <div class="col-6">
                                                <label for="enddate">
                                                    <h6>End date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_enddate" name="enddate" placeholder="" required onchange="showPartDay()">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col " id="datelabel" style="display: none;">
                                                <div class="form-check">
                                                    <label for="partOfDay_check" class="form-check-label" >Half Day?</label>
                                                    <input type="checkbox" class="form-check-input" id="partOfDay_check" name="partOfDay_check" value="0.5" onchange="showPartDay()">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Discard</button>
                            <button id="submit_button1" type="submit" class="btn btn-success" onclick="onClickSubmit()">Create Leave</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    {{-- End Apply leave Modal --}}

    <div class="sub-content mb-5" id="form_submit" >
        @yield('sub-sub-content')
    </div>

    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none; z-index: 1060">
        <span class="visually-hidden" >Loading...</span>
    </div>
    <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none; z-index: 1060">
        <span class="visually-hidden" >Loading...</span>
    </div>


</div>
@endsection
