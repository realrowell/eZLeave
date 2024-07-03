@extends('profiles.employee.leave_management.pending_availment')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @if ($leave_applications->isNotEmpty())
        @foreach ($leave_applications as $leave_application)
            <div class="col-lg-3 col-md-6 col-sm-10">
                <div class="card w-100 p-2 shadow">
                    <div class="card-body">
                        <h4 class="card-title text-center">{{ $leave_application->leavetypes->leave_type_title }}</h4>
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
                                <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
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
        @endforeach
    @else
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col text-center">
                <h2>No leave application found!</h2>
            </div>
        </div>
    @endif
</div>

@endsection
