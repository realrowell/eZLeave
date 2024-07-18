@extends('profiles.hr_staff.hr_leave_management.hrstaff_leave_management')
@section('sub_menu_pending_availment','bg-selected-primary text-light')
@section('sub_menu_approved','text-dark')
@section('sub_menu_pending_approval','text-dark')
@section('sub_menu_reject','text-dark')
@section('sub_menu_cancelled','text-dark')
@section('sub_menu_all','text-dark')
@section('sub-sub-content')

<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-12 text-start">
        <h5>Leave Management</h5>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-12">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <form action="{{ route('hrstaff_leave_management_search') }}" >
            {{-- @csrf --}}
            <div class="container-fluid" style="width: clamp(40vw, 75%, 50vw)">
                <div class="d-flex gap-3">
                    <select class="w-75 js-basic-single rounded-0" name="search_input" id="select-state" onchange="searchBtnEnable()" placeholder="Search here">
                        <option value="" selected disabled>Input here</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->employees->id }}">{{ $user->last_name }}, {{ $user->first_name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" id="search_btn" class="btn btn-sm btn-primary rounded-0" onclick="onClickLinkSubmit()">
                        <i class='bx bx-search me-1'></i>
                        Search
                    </button>
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
    <div class="col-lg-2 col-md-2 col-sm-12 col-12 text-end">
        <a href="#Add" class="btn btn-sm btn-primary rounded-0 p-1 pb-2 ps-2 pe-2" data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
            <i class='bx bx-calendar-plus' ></i>
            Apply Leave
        </a>
    </div>
</div>

{{-- Leave application Table --}}
<div class="row mt-2" id="form_submit">
    <div class="table-wrapper">
        <table class="table table-sm table-bordered table-hover bg-light">
            <thead class="bg-success text-light border-light">
                <tr>
                    <th class="fw-normal">Reference Number</th>
                    <th class="fw-normal">Employee</th>
                    <th class="fw-normal">Leave Type</th>
                    <th class="fw-normal">Start date</th>
                    <th class="fw-normal">End date</th>
                    <th class="fw-normal">Duration (days)</th>
                    <th class="fw-normal">Filed at</th>
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
                        <td class="d-flex gap-2 pb-3 text-center justify-content-center align-items-center">
                            @if ( $leave_application->status_id == 'sta-1001' )
                                <button class="btn btn-outline-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded ' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a class="dropdown-item bg-primary text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-danger text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-x me-2 pt-1'></i>Reject
                                        </a>
                                    </li>
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-success text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-check me-2 pt-1' ></i>Approve
                                        </a>
                                    </li>
                                </ul>
                            @elseif ( $leave_application->status_id == 'sta-1002' )
                                <button class="btn btn-outline-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded ' ></i>
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
                                <button class="btn btn-outline-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded ' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a href="#" class="dropdown-item bg-primary text-light pb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-danger text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-x me-2 pt-1'></i>Reject
                                        </a>
                                    </li>
                                    <li class="mt-1">
                                        <a class="dropdown-item bg-success text-light pb-2" href="#" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-check me-2 pt-1' ></i>Approve
                                        </a>
                                    </li>
                                </ul>
                            @elseif ( $leave_application->status_id == 'sta-1004')
                                <button class="btn btn-outline-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded ' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                    <li>
                                        <a href="#" class="dropdown-item bg-primary text-light pb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                            <i class='bx bx-detail me-2 pt-1'></i>View Details
                                        </a>
                                    </li>
                                </ul>
                            @elseif ( $leave_application->status_id == 'sta-1005')
                                <button class="btn btn-outline-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded ' ></i>
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
                        <x-hrstaff.hr-leave-app-details-modal
                            :leaveReferenceNumber="$leave_application->reference_number"
                            :employeeFullName="$leave_application->employees->users->first_name.' '.$leave_application->employees->users->last_name"
                            :leaveTypeTitle="$leave_application->leavetypes?->leave_type_title"
                            :leaveDuration="$leave_application->duration"
                            :leaveStart="$leave_application->start_date"
                            :leaveStartPart="$leave_application->start_of_date_parts->day_part_title"
                            :leaveEnd="$leave_application->end_date"
                            :leaveEndPart="$leave_application->end_of_date_parts->day_part_title"
                            :leaveCreated="$leave_application->created_at"
                            :approverName="$leave_application->approvers?->users?->first_name.' '.$leave_application->approvers?->users?->last_name"
                            :secondApproverId="$leave_application->second_approver_id"
                            :secondApproverName="$leave_application->second_approvers?->users?->first_name.' '.$leave_application->second_approvers?->users?->last_name"
                            :leaveAppEmployee="$leave_application->employee_id"
                            :attachment="$leave_application->attachment"
                            :status="$leave_application->status_id"
                            :employeeUsername="$leave_application->employees->users->user_name"
                            >
                        </x-hrstaff.hr-leave-app-details-modal>
                    {{-- leave details Modal --}}
                    <!-- update details Modal -->
                        <x-hrstaff.hr-leave-app-update-modal
                            :leaveReferenceNumber="$leave_application->reference_number"
                            :employeeFullName="$leave_application->employees->users->first_name.' '.$leave_application->employees->users->last_name"
                            :leaveTypeTitle="$leave_application->leavetypes?->leave_type_title"
                            :leaveDuration="$leave_application->duration"
                            :leaveStart="$leave_application->start_date"
                            :leaveStartPart="$leave_application->start_of_date_parts->day_part_title"
                            :leaveEnd="$leave_application->end_date"
                            :leaveEndPart="$leave_application->end_of_date_parts->day_part_title"
                            :leaveCreated="$leave_application->created_at"
                            :approverName="$leave_application->approvers?->users?->first_name.' '.$leave_application->approvers?->users?->last_name"
                            :secondApproverId="$leave_application->second_approver_id"
                            :secondApproverName="$leave_application->second_approvers?->users?->first_name.' '.$leave_application->second_approvers?->users?->last_name"
                            :leaveAppEmployee="$leave_application->employee_id"
                            :attachment="$leave_application->attachment"
                            :status="$leave_application->status_id"
                            :employeeUsername="$leave_application->employees->users->user_name"
                            >
                        </x-hrstaff.hr-leave-app-update-modal>
                    {{-- update leave details Modal --}}
                    <!-- reject leave Modal -->
                        <x-hrstaff.hr-leave-app-reject-modal
                            :leaveReferenceNumber="$leave_application->reference_number"
                            >
                        </x-hrstaff.hr-leave-app-reject-modal>
                    {{-- reject leave Modal --}}
                    <!-- cancel leave Modal -->
                        <x-hrstaff.hr-leave-app-cancel-modal
                            :leaveReferenceNumber="$leave_application->reference_number"
                            >
                        </x-hrstaff.hr-leave-app-cancel-modal>
                    {{-- end cancel leave Modal --}}
                    <!-- approve leave Modal -->
                        <x-hrstaff.hr-leave-app-approve-modal
                            :leaveReferenceNumber="$leave_application->reference_number"
                            >
                        </x-hrstaff.hr-leave-app-approve-modal>
                    {{-- end approve leave Modal --}}
                @empty
                    <tr>
                        <td>
                            <x-errors.no-leave-app-found>
                            </x-errors.no-leave-app-found>
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
{{-- End Leave application Table --}}
@endsection
