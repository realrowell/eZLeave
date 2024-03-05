@extends('profiles.hr_staff.hrstaff_dashboard_layout')
@section('menu_hr_dashboard','bg-selected-warning text-light')
@section('menu_leave_credits','text-dark')
@section('menu_leave_management','text-dark')
@section('menu_leave_types','text-dark')
@section('sub-content')

<div class="row">
    <div class="col mt-2">
      <h3>HR Staff Dashboard</h3>
    </div> 
</div>
<div class="row gap-3">
    <div class="row">
        <div class="col text-end align-items-end">
            <div class="col text-end align-items-end">
                <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#AddLeaveCreditModal">
                    <i data-toggle="tooltip" title="list view" class="add-icon" >
                        <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                    </i>
                    Give Leave Credits
                </a>
                <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                    <i data-toggle="tooltip" title="list view" class="add-icon" >
                        <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                    </i>
                    Apply Leave
                </a>
            </div>
        </div>
    </div>

    <!-- Add Leave Credits Modal -->
    <div class="modal fade" id="AddLeaveCreditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('create_leavecredits') }}" method="POST" onsubmit="submitButtonDisabled()" id="form_submit">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Give Leave Credit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid text-start">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                    <h2></h2>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col">
                                            <label for="employee">
                                                <h6 class="">Employee</h6>
                                            </label>
                                            <select class="form-select" id="employee" name="employee" required>
                                                <option selected disabled value=""></option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ optional($employee->users)->first_name }} {{ optional($employee->users)->middle_name }} {{ optional($employee->users)->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                        <div class="col">
                                            <label for="credits">
                                                <h6>Credits (Days)</h6>
                                            </label>
                                            <input type="number" step="0.5" class="form-control" id="credits" name="credits" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                        <button id="submit_button1" type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Leave Credits Modal --}}
    <!-- Apply leave Modal -->
    <div class="modal fade" id="ApplyLeaveModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('create_leaveapplication') }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Apply Leave</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                                    <option value="{{ $employee->id }}">{{ optional($employee->users)->first_name }} {{ optional($employee->users)->middle_name }} {{ optional($employee->users)->last_name }}</option>
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
                                            <input type="datetime-local" class="form-control" id="startdate" name="startdate" placeholder="" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="enddate">
                                                <h6>End date</h6>
                                            </label>
                                            <input type="datetime-local" class="form-control" id="enddate" name="enddate" placeholder="" required onchange="showPartDay()">
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
                        <button id="submit_button2" type="submit" class="btn btn-success">Apply Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Apply leave Modal --}}


    <div class="row gap-3">
        <div class="col-md p-3 bg-light shadow">
            <div class="row">
                <div class="row ">
                    <div class="col"><h5>Overview</h5></div>
                    <div class="col d-flex justify-content-end pe-4">
                        <a href="{{ route('hrstaff_leave_management') }}" class="btn-sm btn-primary">see all</a>
                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="row justify-content-center align-items-center text-center g-2 mt-3">
                        <a href="{{ route('hrstaff_leave_pending_approval') }}" class="col-md text-dark">
                        <span id="approval_numbers" class="col">{{ $pending_leaves_count }}</span>
                            <div class="row">
                            <span class="col">Pending Approval</span>
                            </div>
                        </a>
                        <a href="{{ route('hrstaff_leave_approved') }}" class="col-md text-dark">
                        <span id="approval_numbers" class="col">{{ $approved_leaves_count }}</span>
                            <div class="row">
                            <span class="col">Approved</span>
                            </div>
                        </a>
                        <a href="{{ route('hrstaff_leave_cancelled') }}" class="col-md text-dark">
                            <span id="approval_numbers" class="col">{{ $cancelled_count }}</span>
                            <div class="row">
                                <span class="col">Cancelled</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md p-3 bg-light shadow">
            <div class="row">
                <h5>Recent Activities</h5>
            </div>
        </div>
    </div>
    {{-- Employee Management Table --}}
    <div class="row bg-light p-3 m-1 shadow">
        <div class="row">
            <div class="col">
                <h5>Employee Leave Credits</h5>
            </div>
            <div class="col text-end">
                <a href="#" class="btn-sm btn-primary">See All</a>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper">
                <table class="table table-striped table-hover bg-light">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Sub-department</th>
                            <th>Department</th>
                            <th>Leave Type</th>
                            <th>Leave Credits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee_leavecredits as $employee_leavecredit)
                        <tr>
                            <td>
                                {{ optional($employee_leavecredit->employees->users)->first_name }} 
                                {{ optional($employee_leavecredit->employees->users)->middle_name }} 
                                {{ optional($employee_leavecredit->employees->users)->last_name }} 
                                {{ optional($employee_leavecredit->employees->users->suffixes)->suffix_title }}
                            </td>
                            <td>{{ optional($employee_leavecredit->employees->employee_positions->positions)->position_title }}</td>
                            <td>{{ optional($employee_leavecredit->employees->employee_positions->subdepartments)->sub_department_title }}</td>
                            <td>{{ optional($employee_leavecredit->employees->employee_positions->subdepartments->departments)->department_title }}</td>
                            <td>{{ optional($employee_leavecredit->leavetypes)->leave_type_title }}</td>
                            <td>{{ $employee_leavecredit->leave_days_credit }}</td>
                            <td class="d-flex gap-2">
                                <a href="#" class="btn-sm btn-primary">Update</a>
                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END Employee Management Table --}}
    {{-- Leave application Table --}}
    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="z-index: 1060; display: none;">
        <span class="visually-hidden" >Loading...</span>
    </div>
    <div class="row bg-light p-3 m-1 shadow" id='form_submit'>
        <div class="row">
            <div class="col">
                <h5>Leave Management</h5>
            </div>
            <div class="col text-end">
                <a href="{{ route('hrstaff_leave_management') }}" class="btn-sm btn-primary">See All</a>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper">
                <table class="table table-striped table-hover bg-light">
                    <thead>
                        <tr>
                            <th>Reference Number</th>
                            <th>Full Name</th>
                            <th>Reports to</th>
                            <th>Leave Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Leave Credits</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leave_applications as $leave_application)
                        <tr>
                            <td>{{ $leave_application->reference_number }}</td>
                            <td>
                                {{ optional($leave_application->employees->users)->first_name }} 
                                {{ optional($leave_application->employees->users)->middle_name }} 
                                {{ optional($leave_application->employees->users)->last_name }} 
                                {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                            </td>
                            <td>
                                @if (!empty($leave_application->employees->employee_positions->reports_tos->users))
                                    {{ optional($leave_application->employees->employee_positions->reports_tos)->first_name }} 
                                    {{ optional($leave_application->employees->employee_positions->reports_tos->users)->middle_name }} 
                                    {{ optional($leave_application->employees->employee_positions->reports_tos->users)->last_name }} 
                                @else
                                    Not Available
                                @endif
                            </td>
                            <td>{{ optional($leave_application->leavetypes)->leave_type_title }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }}</td>
                            <td>{{ $leave_application->leave_days_credit }}</td>
                            <td>
                                @if ($leave_application->status_id == 'sta-1001')
                                    <p class="bg-secondary text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                @elseif ($leave_application->status_id == 'sta-1002')
                                    <p class="bg-success text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                @elseif ($leave_application->status_id == 'sta-1003')
                                    <p class="bg-success text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                @elseif ($leave_application->status_id == 'sta-1004')
                                    <p class="bg-danger text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                @elseif ($leave_application->status_id == 'sta-1005')
                                    <p class="bg-warning text-dark ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                @endif
                            </td>
                            <td class="d-flex gap-2 pb-3">
                                @if ( $leave_application->status_id == 'sta-1001' )
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                        View
                                    </button>
                                    <a href="{{ route('leave_application_approval', $leave_application->reference_number) }}" onclick="onClickSubmit()" class="btn btn-sm btn-success">
                                        Approve
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                        Reject
                                    </button>
                                @elseif ( $leave_application->status_id == 'sta-1002' )
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View</a>
                                    @if (Carbon\Carbon::now() <= $leave_application->start_date)
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#cancelLeaveModal{{ $leave_application->reference_number }}">
                                            Cancel
                                        </button>
                                    @endif
                                @elseif ( $leave_application->status_id == 'sta-1003')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                        View
                                    </button>
                                @elseif ( $leave_application->status_id == 'sta-1004')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                        View
                                    </button>
                                @elseif ( $leave_application->status_id == 'sta-1005')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                        View
                                    </button>
                                @endif
                            </td>
                        </tr>
                        <!-- leave details Modal -->
                            <div class="modal fade" id="detailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid text-start">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                        <h2></h2>
                                                    </div>
                                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h2 class="">Leave Details</h2>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Reference Number</h6>
                                                                </label>
                                                                <h4>{{ $leave_application->reference_number }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Employee</h6>
                                                                </label>
                                                                <h4>
                                                                    {{ optional($leave_application->employees->users)->first_name }} 
                                                                    {{ optional($leave_application->employees->users)->middle_name }} 
                                                                    {{ optional($leave_application->employees->users)->last_name }} 
                                                                    {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                                                                    <a target="_blank" href="{{ route('user_profile',$leave_application->employees->users->user_name) }}">
                                                                        <i data-toggle="tooltip" title="search" class="search-icon" >
                                                                            <svg class="text-primary" width="30px" height="30px" viewBox="0 0 30 30">
                                                                                {{ svg('css-search') }}
                                                                            </svg>
                                                                        </i>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="leavetype">
                                                                    <h6 class="">Leave Type</h6>
                                                                </label>
                                                                <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-6">
                                                                <label for="startdate">
                                                                    <h6>Start date</h6>
                                                                </label>
                                                                <h4>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }}</h4>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="enddate">
                                                                    <h6>End date</h6>
                                                                </label>
                                                                <h4>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label for="enddate">
                                                                    <h6>Date filed</h6>
                                                                </label>
                                                                <h4>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:i:s A') }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                @if (!empty($leave_application->attachment))
                                                                    <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                                                @else
                                                                    <label for="">No Attachment</label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="reason">
                                                                    <h6 class="">Reason / Note</h6>
                                                                </label>
                                                                @foreach ($leave_application_notes as $leave_application_note)
                                                                    @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                                                        <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                                        @if ($leave_application_note->employee_id != null)
                                                                            <p> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} ({{ optional($leave_application_note->employees->employee_positions->positions)->position_title }}) at {{ $leave_application_note->created_at }}</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="status">
                                                                    <h6 class="">Status</h6>
                                                                </label>
                                                                @if ($leave_application->status_id == 'sta-1001')
                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1002')
                                                                    @foreach ($leave_approvals as $leave_approval)
                                                                        @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                            @if ($leave_approval->status_id == 'sta-1002')
                                                                                <p id="approval_p" class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                                <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                            @elseif($leave_approval->status_id == 'sta-1005')
                                                                                <p id="approval_p" class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                                <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @elseif ($leave_application->status_id == 'sta-1003')
                                                                    <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1004')
                                                                    @foreach ($leave_approvals as $leave_approval)
                                                                        @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                            @if ($leave_approval->status_id == 'sta-1004')
                                                                                <p id="approval_p" class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                                <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @elseif ($leave_application->status_id == 'sta-1005')
                                                                    @foreach ($leave_approvals as $leave_approval)
                                                                        @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                            @if ($leave_approval->status_id == 'sta-1002')
                                                                                <p id="approval_p" class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                                <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                            @elseif($leave_approval->status_id == 'sta-1005')
                                                                                <p id="approval_p" class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                                <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="" for="update">
                                                                    @if ($leave_application->status_id == 'sta-1001')
                                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updatedetailsModal{{ $leave_application->reference_number }}">
                                                                            Update Application
                                                                        </button>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            @if ($leave_application->status_id == 'sta-1001')
                                                <a href="{{ route('leave_application_rejection', $leave_application->reference_number) }}" onclick="onClickUpdateSubmit()" class="btn btn-danger">
                                                    Reject
                                                </a>
                                                <a href="{{ route('leave_application_approval', $leave_application->reference_number) }}" onclick="onClickUpdateSubmit()" class="btn btn-success">
                                                    Approve
                                                </a>
                                            @elseif ($leave_application->status_id == 'sta-1002')
                                                <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                            @elseif ($leave_application->status_id == 'sta-1003')
                                                <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                            @elseif ($leave_application->status_id == 'sta-1004')
                                                <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                            @elseif ($leave_application->status_id == 'sta-1005')
                                                <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- leave details Modal --}}
                        <!-- update details Modal -->
                            <div class="modal fade" id="updatedetailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('update_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                            <h2></h2>
                                                        </div>
                                                        <div class="col-lg-8 col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="employee">
                                                                        <h2 class="">Update Leave Details</h2>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="employee">
                                                                        <h6 class="">Reference Number</h6>
                                                                    </label>
                                                                    <h4>{{ $leave_application->reference_number }}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="employee">
                                                                        <h6 class="">Employee</h6>
                                                                    </label>
                                                                    <input type="text" class="form-control text-start" value="{{ optional($leave_application->employees->users)->first_name }} {{ optional($leave_application->employees->users)->last_name }} {{ optional($leave_application->employees->users->suffixes)->suffix_title }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    <label class="" for="leavetype">
                                                                        <h6 class="">Leave Type</h6>
                                                                    </label>
                                                                    <input type="text" class="form-control text-start" value="{{ optional($leave_application->leavetypes)->leave_type_title }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-6">
                                                                    <label for="startdate">
                                                                        <h6>Start date</h6>
                                                                    </label>
                                                                    <input type="datetime-local" class="form-control" id="startdate" name="startdate" placeholder="" value="{{ $leave_application->start_date }}">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="enddate">
                                                                        <h6>End date</h6>
                                                                    </label>
                                                                    <input type="datetime-local" class="form-control" id="enddate" name="enddate" placeholder="" value="{{ $leave_application->end_date }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    @if (!empty($leave_application->attachment))
                                                                        <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                                                    @else
                                                                        <label class="" for="attachment">
                                                                            <h6 class="">Attachment</h6>
                                                                        </label>
                                                                        <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    <label class="" for="reason">
                                                                        <h6 class="">Reason / Note</h6>
                                                                    </label>
                                                                    @foreach ($leave_application_notes as $leave_application_note)
                                                                        @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                                                            <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                                            @if ($leave_application_note->employee_id != null)
                                                                                <p> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} ( {{ optional($leave_application_note->employees->employee_positions->positions)->position_title }} ) at {{ $leave_application_note->created_at }}</p>
                                                                            @endif
                                                                            
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="row mt-1">
                                                                <div class="col">
                                                                    <button class="btn btn-sm btn-primary" id="addNoteButton" type="button" data-bs-toggle="collapse" data-bs-target="#addNote" aria-expanded="false" aria-controls="addNote">
                                                                        Add Note
                                                                    </button>
                                                                </div>
                                                                <div class="collapse mt-1" id="addNote">
                                                                    <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    <label class="" for="status">
                                                                        <h6 class="">Status</h6>
                                                                    </label>
                                                                    @if ($leave_application->status_id == 'sta-1001')
                                                                        <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                    @elseif ($leave_application->status_id == 'sta-1002')
                                                                        <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                    @elseif ($leave_application->status_id == 'sta-1003')
                                                                        <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                    @elseif ($leave_application->status_id == 'sta-1004')
                                                                        <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                    @elseif ($leave_application->status_id == 'sta-1005')
                                                                        <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                                                <button onclick="onClickUpdateSubmit()" type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {{-- update leave details Modal --}}
                        <!-- reject leave Modal -->
                            <div class="modal fade" id="rejectLeaveModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid text-start">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                        <h2></h2>
                                                    </div>
                                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h2 class="">CONFIRM LEAVE REJECTION</h2>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Reference Number</h6>
                                                                </label>
                                                                <h4>{{ $leave_application->reference_number }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Employee</h6>
                                                                </label>
                                                                <h4>
                                                                    {{ optional($leave_application->employees->users)->first_name }} 
                                                                    {{ optional($leave_application->employees->users)->middle_name }} 
                                                                    {{ optional($leave_application->employees->users)->last_name }} 
                                                                    {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="leavetype">
                                                                    <h6 class="">Leave Type</h6>
                                                                </label>
                                                                <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-6">
                                                                <label for="startdate">
                                                                    <h6>Start date</h6>
                                                                </label>
                                                                <h4>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }}</h4>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="enddate">
                                                                    <h6>End date</h6>
                                                                </label>
                                                                <h4>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                @if (!empty($leave_application->attachment))
                                                                    <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                                                @else
                                                                    <label for="">No Attachment</label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="reason">
                                                                    <h6 class="">Reason / Note</h6>
                                                                </label>
                                                                @foreach ($leave_application_notes as $leave_application_note)
                                                                    @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                                                        <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                                        @if ($leave_application_note->employee_id != null)
                                                                            <p> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} ( {{ optional($leave_application_note->employees->employee_positions->positions)->position_title }} )</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="status">
                                                                    <h6 class="">Status</h6>
                                                                </label>
                                                                @if ($leave_application->status_id == 'sta-1001')
                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1002')
                                                                    <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1003')
                                                                    <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1004')
                                                                    <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1005')
                                                                    <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                            <a href="{{ route('leave_application_rejection', $leave_application->reference_number) }}" onclick="onClickUpdateSubmit()" class="btn btn-danger">
                                                Confirm Reject
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- reject leave Modal --}}
                        <!-- cancel leave Modal -->
                            <div class="modal fade" id="cancelLeaveModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid text-start">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                        <h2></h2>
                                                    </div>
                                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h2 class="">CONFIRM LEAVE CANCELLATION</h2>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Reference Number</h6>
                                                                </label>
                                                                <h4>{{ $leave_application->reference_number }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Employee</h6>
                                                                </label>
                                                                <h4>
                                                                    {{ optional($leave_application->employees->users)->first_name }} 
                                                                    {{ optional($leave_application->employees->users)->middle_name }} 
                                                                    {{ optional($leave_application->employees->users)->last_name }} 
                                                                    {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="leavetype">
                                                                    <h6 class="">Leave Type</h6>
                                                                </label>
                                                                <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-6">
                                                                <label for="startdate">
                                                                    <h6>Start date</h6>
                                                                </label>
                                                                <h4>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }}</h4>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="enddate">
                                                                    <h6>End date</h6>
                                                                </label>
                                                                <h4>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                @if (!empty($leave_application->attachment))
                                                                    <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                                                @else
                                                                    <label for="">No Attachment</label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="reason">
                                                                    <h6 class="">Reason / Note</h6>
                                                                </label>
                                                                @foreach ($leave_application_notes as $leave_application_note)
                                                                    @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                                                        <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                                        @if ($leave_application_note->employee_id != null)
                                                                            <p> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} ( {{ optional($leave_application_note->employees->employee_positions->positions)->position_title }} )</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="" for="status">
                                                                    <h6 class="">Status</h6>
                                                                </label>
                                                                @if ($leave_application->status_id == 'sta-1001')
                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1002')
                                                                    <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1003')
                                                                    <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1004')
                                                                    <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @elseif ($leave_application->status_id == 'sta-1005')
                                                                    <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                            <a href="{{ route('leave_application_cancellation', $leave_application->reference_number) }}" onclick="onClickUpdateSubmit()" class="btn btn-danger">
                                                Confirm
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- cancel leave Modal --}}
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- End Leave application Table --}}
</div>
@endsection