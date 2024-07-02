@extends('profiles.employee.leave_management.pending_approval')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="spinner-border text-primary" id="loading_spinner_approve" role="status" style="display: none;">
    <span class="visually-hidden" >Loading...</span>
</div>
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start" id="form_submit_1">
    @if ($leave_applications->isNotEmpty())
        @foreach ($leave_applications as $leave_application)
            <div class="col-lg-3 col-md-6 col-sm-10">
                <div class="card w-100 p-2 shadow shadow-sm border border-end-0 border-start-0 border-bottom-0 border-warning border-5 rounded-0">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col">
                                <h4 class="card-title text-center">{{ $leave_application->leavetypes->leave_type_title }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" id="approval_p">Reference #:</p>
                                <h5> {{ $leave_application->reference_number }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="card-text" id="approval_p">Start date:</p>
                                <h5> {{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y')}}</h5>
                            </div>
                            <div class="col-4">
                                <p class="card-text" id="approval_p">End date:</p>
                                <h5> {{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y')}}</h5>
                            </div>
                            <div class="col-4">
                                <p class="card-text" id="approval_p">Duration:</p>
                                <h5>{{ $leave_application->duration }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" id="approval_p">Date of application:</p>
                                <h5> {{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y - h:i:sa')}}</h5>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <p class="card-text" id="approval_p">Approver:</p>
                                <h6>
                                    {{ optional($leave_application->approvers->users)->first_name }}
                                    {{ optional($leave_application->approvers->users)->last_name }}
                                    {{ optional(optional($leave_application->approvers->users)->suffixes)->suffix_title }}
                                </h6>
                            </div>
                            <div class="col">
                                @if ($leave_application->second_approver_id != null)
                                    <p class="card-text" id="approval_p">Second Approver:</p>
                                    <h6 class="">
                                        {{ optional(optional($leave_application->second_approvers)->users)->first_name }}
                                        {{ optional(optional($leave_application->second_approvers)->users)->last_name }}
                                        {{ optional(optional(optional($leave_application->second_approvers)->users)->suffixes)->suffix_title }}
                                    </h6>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" id="approval_p">Status:</p>
                                <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-primary text-center rounded-0" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
                                    @if ($leave_application->status_id == 'sta-1001')
                                        <button class="btn btn-sm btn-danger text-center rounded-0" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_application->reference_number }}">Cancel</button>
                                    @else
                                        <button class="btn btn-sm btn-danger text-center rounded-0" disabled>Cancel</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- leave details Modal -->
                <x-employee.leave-app-details-modal
                    :leaveReferenceNumber="$leave_application->reference_number"
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
                    :attachment="$leave_application->attachment"
                    :status="$leave_application->status_id"
                    >
                </x-employee.leave-app-details-modal>
            {{-- leave details Modal --}}
            <!-- update details Modal -->
                <x-employee.leave-app-update-modal
                    :leaveReferenceNumber="$leave_application->reference_number"
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
                    :attachment="$leave_application->attachment"
                    :status="$leave_application->status_id"
                    >
                </x-employee.leave-app-update-modal>
            {{-- update leave details Modal --}}
            <!-- cancel details Modal -->
                <x-employee.leave-app-cancel-modal
                    :leaveReferenceNumber="$leave_application->reference_number"
                    >
                </x-employee.leave-app-cancel-modal>
            {{-- cancel details Modal --}}
        @endforeach
    @else
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col text-center">
                <h2>No leave application found!</h2>
            </div>
        </div>
    @endif

    {{-- <div class="col-lg-3 col-md-6 col-sm-10">
        <a href="#ApplyLeaveModal" class="text-dark" data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
            <div class="card w-100 h-100 p-2 card-menu align-self-center shadow" style="">
                <div class="card-body" style="padding-top: 25%; padding-bottom: 25%" >
                    <h5 class="card-title text-center">Click Here {{ svg('tabler-hand-click') }}</h5>
                    <div class="text-center justify-content-center align-items-center">
                        <i data-toggle="tooltip" title="Apply leave" class="add-icon" >
                            <svg class="mb-1" width="60px" height="60px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                        </i>
                    </div>
                    <h5 class="card-title text-center mt-3">Request a leave</h5>
                </div>
            </div>
        </a>
    </div> --}}
</div>

<div class="row">
    <div class="col">
        <div class="mt-5">
            <ul class="pagination justify-content-center align-items-center">
                {!! $leave_applications->links('pagination::bootstrap-5') !!}
            </ul>
        </div>
    </div>
</div>
@endsection
