@extends('profiles.hr_staff.hr_leave_management.hrstaff_leave_management')
@section('sub_menu_pending_approval','text-dark')
@section('sub_menu_approved','text-dark')
@section('sub_menu_cancelled','text-dark')
@section('sub_menu_reject','text-dark')
@section('sub_menu_pending_availment','text-dark')
@section('sub_menu_all','bg-selected-primary text-light')
@section('sub-sub-content')
{{-- Leave application Table --}}
<div class="row bg-light p-3 shadow">
    <div class="d-lg-flex d-md-flex d-sm-block ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Leave Management / All</h5>
                </div>
                <div class="col">
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                <li><a class="dropdown-item" href="{{ route('hrstaff_fy_leave_management',['fiscal_year'=>$fiscal_year->id]) }}">{{ $fiscal_year->fiscal_year_title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="{{ route('hrstaff_leave_management_search') }}" >
                {{-- @csrf --}}
                <div class="container-fluid" style="width: clamp(40vw, 75%, 50vw)">
                    <div class="d-flex gap-3">
                        <select class="w-75 js-basic-single" name="search_input" id="select-state" onchange="searchBtnEnable()" placeholder="Search here">
                            <option value="" selected disabled>Input here</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->employees->id }}">{{ $user->last_name }}, {{ $user->first_name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" id="search_btn" class="btn btn-sm btn-primary" onclick="onClickLinkSubmit()"><i class='bx bx-search me-1'></i>Search</button>
                    </div>
                </div>
                {{-- <input class="form-control d-none" type="text" name="search_input" id="text-input-search" onkeyup="searchBtnEnable()" onsubmit="submitButtonDisabled()" placeholder="Search here"> --}}
                {{-- <span>
                    <select class="form-select form-select-sm" name="search_filter" id="search_filter" aria-label="Default select example" required>
                        <option value="2">Employee Name</option>
                        <option value="1">Reference #</option>
                    </select>
                </span> --}}
            </form>
        </div>
        <div class="container text-end">
            <a href="#Add" class="btn btn-sm btn-primary pt-1 pb-2" data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                <i class='bx bx-calendar-plus' ></i>
                Apply Leave
            </a>
        </div>
    </div>
    <div class="row mt-2" id="form_submit">
        <div class="table-wrapper">
            <table class="table table-sm table-bordered table-hover bg-light">
                {{-- <h5>Pending Approval</h5> --}}
                <thead class="bg-success text-light border-light">
                    <tr>
                        <th class="fw-normal">Reference Number</th>
                        <th class="fw-normal">Employee</th>
                        <th class="fw-normal">Leave Type</th>
                        <th class="fw-normal">Start date</th>
                        <th class="fw-normal">End date</th>
                        <th class="fw-normal">Duration (days)</th>
                        <th class="fw-normal">Filed at</th>
                        {{-- <th>Approver</th>
                        <th>Second Approver</th> --}}
                        <th class="fw-normal">Status</th>
                        <th class="fw-normal">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leave_applications as $leave_application)
                    <tr>
                        <td>{{ $leave_application->reference_number }}</td>
                        <td>
                            {{ optional($leave_application->employees->users)->first_name }}
                            {{ optional($leave_application->employees->users)->middle_name }}
                            {{ optional($leave_application->employees->users)->last_name }}
                            {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                        </td>
                        <td>{{ optional($leave_application->leavetypes)->leave_type_title }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('m/d/Y') }} - {{ $leave_application->start_of_date_parts->day_part_title }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('m/d/Y') }} - {{ $leave_application->end_of_date_parts->day_part_title }}</td>
                        <td>{{ $leave_application->duration }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('m/d/Y \\a\\t h:ia') }}</td>
                        {{-- <td id="table_reports_to" class="text-wrap">
                            @if (!empty($leave_application->approver_id))
                                {{ optional($leave_application->approvers->users)->first_name }}
                                {{ optional($leave_application->approvers->users)->middle_name }}
                                {{ optional($leave_application->approvers->users)->last_name }}
                                {{ optional($leave_application->approvers->users->suffixes)->suffix_title }}
                            @else
                                Not Available
                            @endif
                        </td>
                        <td id="table_second_reports_to" class="text-wrap">
                            @if (!empty($leave_application->second_approver_id))
                                {{ optional($leave_application->second_approvers->users)->first_name }}
                                {{ optional($leave_application->second_approvers->users)->middle_name }}
                                {{ optional($leave_application->second_approvers->users)->last_name }}
                                {{ optional($leave_application->second_approvers->users->suffixes)->suffix_title }}
                            @else
                                Not Available
                            @endif
                        </td> --}}
                        <td>
                            @if ($leave_application->status_id == 'sta-1001')
                                <span class="fw-normal badge bg-secondary rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                            @elseif ($leave_application->status_id == 'sta-1002')
                                <span class="fw-normal badge bg-success rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                            @elseif ($leave_application->status_id == 'sta-1003')
                                <span class="fw-normal badge bg-secondary rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                            @elseif ($leave_application->status_id == 'sta-1004')
                                <span class="fw-normal badge bg-danger rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                            @elseif ($leave_application->status_id == 'sta-1005')
                                <span class="fw-normal badge text-dark bg-warning rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2 pb-3">
                            @if ( $leave_application->status_id == 'sta-1001' )
                                <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a class="dropdown-item bg-primary text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                    {{-- <li class="mt-1">
                                        <button type="button" class="dropdown-item bg-danger text-light pb-2" data-bs-toggle="modal" data-bs-target="#cancelLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bxs-x-circle me-2 pt-1' ></i>Cancel
                                        </button>
                                    </li> --}}
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-danger text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-x me-2 pt-1'></i>Reject
                                        </a>
                                    </li>
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-success text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-check me-2 pt-1' ></i>Approve
                                        </a>
                                        {{-- <a class="dropdown-item bg-success text-light pb-2" href="{{ route('leave_application_approval', $leave_application->reference_number) }}" onclick="onClickUpdateSubmit()">
                                            <i class='bx bxs-check-circle me-2 pt-1' ></i>Approve
                                        </a> --}}
                                    </li>
                                </ul>
                            @elseif ( $leave_application->status_id == 'sta-1002' )
                                <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a href="#" class="dropdown-item bg-primary text-light pb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                    <li class="mt-1">
                                        {{-- @if (Carbon\Carbon::now() <= $leave_application->start_date) --}}
                                            <button type="button" class="dropdown-item bg-danger text-light pb-2" data-bs-toggle="modal" data-bs-target="#cancelLeaveModal{{ $leave_application->reference_number }}">
                                                <i class='bx bxs-x-circle me-2 pt-1' ></i>Cancel
                                            </button>
                                        {{-- @endif --}}
                                    </li>
                                </ul>
                            @elseif ( $leave_application->status_id == 'sta-1003')
                                <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a href="#" class="dropdown-item bg-primary text-light pb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                    {{-- <li class="mt-1">
                                        <button type="button" class="dropdown-item bg-danger text-light pb-2" data-bs-toggle="modal" data-bs-target="#cancelLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bxs-x-circle me-2 pt-1' ></i>Cancel
                                        </button>
                                    </li> --}}
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-danger text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-x me-2 pt-1'></i>Reject
                                        </a>
                                    </li>
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-success text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-check me-2 pt-1' ></i>Approve
                                        </a>
                                        {{-- <a class="dropdown-item bg-success text-light pb-2" href="{{ route('leave_application_approval', $leave_application->reference_number) }}" onclick="onClickUpdateSubmit()">
                                            <i class='bx bxs-check-circle me-2 pt-1' ></i>Approve
                                        </a> --}}
                                    </li>
                                </ul>
                            @elseif ( $leave_application->status_id == 'sta-1004')
                                <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a href="#" class="dropdown-item bg-primary text-light pb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                </ul>
                            @elseif ( $leave_application->status_id == 'sta-1005')
                                <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a href="#" class="dropdown-item bg-primary text-light pb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </td>
                    </tr>
                    <!-- leave details Modal -->
                        <div class="modal fade" id="detailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
                                    <div class="modal-body">
                                        <div class="container-fluid text-start">
                                            <div class="row">
                                                <div class="col ">
                                                    <div class="row pt-3">
                                                        <div class="col-9">
                                                            <label for="employee">
                                                                <h2 class="">Leave Details</h2>
                                                            </label>
                                                        </div>
                                                        <div class="col-3 text-end">
                                                            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_application->reference_number }}"></button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="employee">
                                                                <h6 class="h6-label">Reference Number</h6>
                                                            </label>
                                                            <h4 class="h4-value">{{ $leave_application->reference_number }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="employee">
                                                                <h6>Employee</h6>
                                                            </label>
                                                            <h4>
                                                                {{ $leave_application->employees->users->first_name }}
                                                                {{ $leave_application->employees->users->last_name }}
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
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="" for="leavetype">
                                                                <h6 class="">Leave Type</h6>
                                                            </label>
                                                            <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                                                        </div>
                                                        <div class="col">
                                                            <label for="duration">
                                                                <h6>Duration</h6>
                                                            </label>
                                                            <h4>{{ $leave_application->duration }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="startdate">
                                                                <h6>Start date</h6>
                                                            </label>
                                                            <h4>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} ({{ $leave_application->start_of_date_parts->day_part_title }})</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="enddate">
                                                                <h6>End date</h6>
                                                            </label>
                                                            <h4>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} ({{ $leave_application->end_of_date_parts->day_part_title }})</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="enddate">
                                                                <h6>Date filed</h6>
                                                            </label>
                                                            <h4>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:i:s A') }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col">
                                                            <label for="employee">
                                                                <h6 class="">Approver</h6>
                                                            </label>
                                                            <h4>
                                                                {{ optional($leave_application->approvers->users)->first_name }}
                                                                {{ optional($leave_application->approvers->users)->last_name }}
                                                                {{ optional($leave_application->approvers->users->suffixes)->suffix_title }}
                                                            </h4>
                                                        </div>
                                                        <div class="col">
                                                            <label for="employee">
                                                                <h6 class="">Second Approver</h6>
                                                            </label>
                                                            <h4>
                                                                @if ($leave_application->second_approver_id == null)
                                                                    N/A
                                                                @else
                                                                    {{ optional(($leave_application->second_approvers)->users)->first_name }}
                                                                    {{ optional($leave_application->second_approvers->users)->last_name }}
                                                                    {{ optional($leave_application->second_approvers->users->suffixes)->suffix_title }}
                                                                @endif
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col">
                                                            @if (!empty($leave_application->attachment))
                                                                <a target="_blank" href="{{ asset('storage/images/leave_attachment/'.$leave_application->attachment) }}">View Attachment</a>
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
                                                                    @if ($leave_application_note->author_id != null)
                                                                        <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} • {{ timestamp_leadtime($leave_application_note->created_at) }} </p>
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
                                                            @if($leave_application->status_id == 'sta-1001')
                                                                @foreach ($leave_approvals as $leave_approval)
                                                                    @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                        @if ($leave_approval->status_id == 'sta-1001')
                                                                            <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @elseif ($leave_application->status_id == 'sta-1002')
                                                                @foreach ($leave_approvals as $leave_approval)
                                                                    @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                        @if ($leave_approval->status_id == 'sta-1001')
                                                                            <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                        @elseif ($leave_approval->status_id == 'sta-1002')
                                                                            <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @elseif($leave_application->status_id == 'sta-1003')
                                                                @foreach ($leave_approvals as $leave_approval)
                                                                    @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                        @if ($leave_approval->status_id == 'sta-1001')
                                                                            <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                        @elseif ($leave_approval->status_id == 'sta-1002')
                                                                            <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @elseif($leave_application->status_id == 'sta-1004')
                                                                @foreach ($leave_approvals as $leave_approval)
                                                                    @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                        @if ($leave_approval->status_id == 'sta-1001')
                                                                            <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                        @elseif ($leave_approval->status_id == 'sta-1002')
                                                                            <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                                        @elseif ($leave_approval->status_id == 'sta-1004')
                                                                            <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @elseif($leave_application->status_id == 'sta-1005')
                                                                @foreach ($leave_approvals as $leave_approval)
                                                                    @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                        @if ($leave_approval->status_id == 'sta-1001')
                                                                            <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                        @elseif ($leave_approval->status_id == 'sta-1002')
                                                                            <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                                        @elseif ($leave_approval->status_id == 'sta-1004')
                                                                            <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                                        @elseif ($leave_approval->status_id == 'sta-1005')
                                                                            <p class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
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
                                        {{-- <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-primary text-center">View more details</a>
                                        <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button> --}}

                                        <div class="container-fluid">
                                            <div class="row">
                                                @if ($leave_application->status_id == 'sta-1001')
                                                    <div class="col text-start">
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="col text-end">
                                                        <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-outline-primary ">View details</a>
                                                        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                                            Reject
                                                        </a>
                                                        <a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">
                                                            Approve
                                                        </a>
                                                    </div>
                                                @elseif($leave_application->status_id == 'sta-1002')
                                                    <div class="col text-start">
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="col text-end">
                                                        <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-outline-primary ">View details</a>
                                                        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#cancelLeaveModal{{ $leave_application->reference_number }}">
                                                            Cancel
                                                        </a>
                                                    </div>
                                                @elseif($leave_application->status_id == 'sta-1003')
                                                    <div class="col text-start">
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="col text-end">
                                                        <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-outline-primary ">View details</a>
                                                        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                                            Reject
                                                        </a>
                                                        <a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">
                                                            Approve
                                                        </a>
                                                    </div>
                                                @elseif($leave_application->status_id == 'sta-1004')
                                                    <div class="col text-start">
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="col text-end">
                                                        <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-outline-primary ">View details</a>
                                                    </div>
                                                @elseif($leave_application->status_id == 'sta-1005')
                                                    <div class="col text-start">
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="col text-end">
                                                        <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-outline-primary ">View details</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- leave details Modal --}}
                    <!-- update details Modal -->
                        <div class="modal fade" id="updatedetailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
                                    {{-- <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> --}}
                                    <form action="{{ route('update_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="onClickUpdateLeaveId({{ $leave_application->reference_number }})" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="container-fluid text-start" id="form_container_onUpdate{{ $leave_application->reference_number }}">
                                                <div class="row">
                                                    <div class="col ">
                                                        <div class="row pt-3">
                                                            <div class="col-9">
                                                                <label for="employee">
                                                                    <h2 class="">Update Leave Details</h2>
                                                                </label>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onUpdate{{ $leave_application->reference_number }}"></button>
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
                                                                <input type="date" class="form-control" id="datetime_startdate_update" name="startdate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->start_date)->format('Y-m-d') }}" disabled>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="enddate">
                                                                    <h6>End date</h6>
                                                                </label>
                                                                <input type="date" class="form-control" id="datetime_enddate_update" name="enddate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->end_date)->format('Y-m-d') }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="startdate">
                                                                    <h6>{{ $leave_application->start_of_date_parts->day_part_description }}</h6>
                                                                </label>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="enddate">
                                                                    <h6>{{ $leave_application->end_of_date_parts->day_part_description }}</h6>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="row mt-2 text-end">
                                                            <div class="col">
                                                                <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" target="_blank" class="btn btn-sm btn-primary">Update Date</a>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">Duration (days)</label>
                                                                <input type="text" name="duration" placeholder="" id="duration_input_up" class="form-control" value="{{ $leave_application->duration }}" disabled/>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Approver</h6>
                                                                </label>
                                                                <h5>
                                                                    {{ optional($leave_application->approvers->users)->first_name }}
                                                                    {{ optional($leave_application->approvers->users)->last_name }}
                                                                    {{ optional($leave_application->approvers->users->suffixes)->suffix_title }}
                                                                </h5>
                                                            </div>
                                                            <div class="col">
                                                                <label for="employee">
                                                                    <h6 class="">Second Approver</h6>
                                                                </label>
                                                                <h5>
                                                                    @if ($leave_application->second_approver_id == null)
                                                                        N/A
                                                                    @else
                                                                        {{ optional(($leave_application->second_approvers)->users)->first_name }}
                                                                        {{ optional($leave_application->second_approvers->users)->last_name }}
                                                                        {{ optional($leave_application->second_approvers->users->suffixes)->suffix_title }}
                                                                    @endif
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                @if (!empty($leave_application->attachment))
                                                                    <a target="_blank" href="{{ asset('storage/images/leave_attachment/'.$leave_application->attachment) }}">View Attachment</a>
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
                                                                        @if ($leave_application_note->author_id != null)
                                                                            <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} at {{ $leave_application_note->created_at }}</p>
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
                                                                    @foreach ($leave_approvals as $leave_approval)
                                                                        @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                            <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                        @endif
                                                                    @endforeach
                                                                @elseif ($leave_application->status_id == 'sta-1003')
                                                                    @foreach ($leave_approvals as $leave_approval)
                                                                        @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                            @if ($leave_approval->status_id == 'sta-1001')
                                                                                <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                            @elseif ($leave_approval->status_id == 'sta-1002')
                                                                                <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-transparent" id="btn_close_onUpdate{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="btn_update{{ $leave_application->reference_number }}">
                                                <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_update{{ $leave_application->reference_number }}">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    {{-- update leave details Modal --}}
                    <!-- reject leave Modal -->
                        <div class="modal fade" id="rejectLeaveModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="{{ route('leave_application_rejection', $leave_application->reference_number) }}" method="POST" onsubmit="onClickRejectId('{{ $leave_application->reference_number }}')">
                                    @csrf
                                    <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0" >
                                        <div class="modal-body">
                                            <div class="container-fluid text-start" id="form_container_onReject{{ $leave_application->reference_number }}" >
                                                <div class="row pt-3">
                                                    <div class="col-9">
                                                        <label for="employee">
                                                            <h4 class="">CONFIRM LEAVE REJECTION</h4>
                                                        </label>
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_application->reference_number }}"></button>
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
                                                        <h6>Reason / Note:</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <textarea class="form-control" name="reason" id="reason" cols="10" rows="5" required oninput="submitBtnEnable_onReject('{{ $leave_application->reference_number }}')"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-transparent " id="btn_close_onReject{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger disabled" id="btn_reject{{ $leave_application->reference_number }}" >
                                                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_reject{{ $leave_application->reference_number }}">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        Confirm Rejection
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    {{-- reject leave Modal --}}
                    <!-- cancel leave Modal -->
                        <div class="modal fade" id="cancelLeaveModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="{{ route('leave_application_cancellation', $leave_application->reference_number) }}" method="POST" onsubmit="onClickCancelId('{{ $leave_application->reference_number }}')">
                                    @csrf
                                    <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0" >
                                        <div class="modal-body">
                                            <div class="container-fluid text-start" id="form_container_onCancel{{ $leave_application->reference_number }}" >
                                                <div class="row pt-3">
                                                    <div class="col-9">
                                                        <label for="employee">
                                                            <h4 class="">CONFIRM LEAVE CANCELLATION</h4>
                                                        </label>
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_application->reference_number }}"></button>
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
                                                        <h6>Reason / Note:</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <textarea class="form-control" name="reason" id="reason" cols="10" rows="5" required oninput="submitBtnEnable_onCancel('{{ $leave_application->reference_number }}')"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-transparent " id="btn_close_onCancel{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger disabled" id="btn_cancel{{ $leave_application->reference_number }}" >
                                                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_cancel{{ $leave_application->reference_number }}">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        Confirm Cancellation
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    {{-- end cancel leave Modal --}}
                    <!-- approve leave Modal -->
                        <div class="modal fade" id="approveLeaveModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered positions-relative" id="form_container" style="opacity: 1">
                                {{-- <div class="spinner-border text-primary position-absolute d-none" id="loading_spinner_approve{{ $leave_application->reference_number }}" role="status" >
                                    <span class="visually-hidden" >Loading...</span>
                                </div> --}}

                                <form action="{{ route('leave_application_approval', $leave_application->reference_number) }}" method="POST" id="form_submit_approve" onsubmit="onClickApproveId('{{ $leave_application->reference_number }}')">
                                    @csrf
                                    <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0" >
                                        {{-- <div class="modal-header">
                                            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_application->reference_number }}"></button>
                                        </div> --}}
                                        <div class="modal-body">
                                            <div class="container-fluid text-start" id="form_container{{ $leave_application->reference_number }}" >
                                                <div class="row pt-3">
                                                    <div class="col-9">
                                                        <label for="employee">
                                                            <h4 class="">CONFIRM LEAVE APPROVAL</h4>
                                                        </label>
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_application->reference_number }}"></button>
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
                                                        <h6>Reason / Note:</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <textarea class="form-control" name="reason" id="reason" cols="10" rows="5" required oninput="submitBtnEnable('{{ $leave_application->reference_number }}')"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-transparent " id="btn_close{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success disabled" id="btn_submit{{ $leave_application->reference_number }}" >
                                                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_approve{{ $leave_application->reference_number }}">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        Confirm Approval
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td>
                                <h3>No Data Found!</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-success text-light border-light">
                    <tr>
                        <th class="fw-normal">Reference Number</th>
                        <th class="fw-normal">Employee</th>
                        <th class="fw-normal">Leave Type</th>
                        <th class="fw-normal">Start date</th>
                        <th class="fw-normal">End date</th>
                        <th class="fw-normal">Duration (days)</th>
                        <th class="fw-normal">Filed at</th>
                        {{-- <th>Approver</th>
                        <th>Second Approver</th> --}}
                        <th class="fw-normal">Status</th>
                        <th class="fw-normal">Actions</th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col">
                    <div class="mt-5">
                        <ul class="pagination justify-content-center align-items-center">
                            {!! $leave_applications?->links('pagination::bootstrap-5') !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Leave application Table --}}
@endsection
