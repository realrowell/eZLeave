@extends('profiles.employee.leave_management.for_approval')
@section('list_view_active','bg-selected-warning')
@section('sub-content')

<div class="row">
    <div id="table_container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <table class="table table-sm table-bordered table-hover bg-light">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Reference Number</th>
                            {{-- <th>Approver</th> --}}
                            {{-- <th>Second Approver</th> --}}
                            <th>Leave Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Duration (days)</th>
                            <th>Filed at</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($leave_applications->isNotEmpty())
                            @foreach ($leave_applications as $leave_application)
                                <tr>
                                    <td>{{ $leave_application->reference_number }}</td>
                                    {{-- <td id="table_reports_to">
                                        @if (!empty($leave_application->approvers))
                                            {{ optional($leave_application->approvers->users)->first_name }}
                                            {{ optional($leave_application->approvers->users)->middle_name }}
                                            {{ optional($leave_application->approvers->users)->last_name }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                    <td id="table_2nd_reports_to">
                                        @if (!empty($leave_application->second_approvers))
                                            {{ optional($leave_application->second_approvers->users)->first_name }}
                                            {{ optional($leave_application->second_approvers->users)->middle_name }}
                                            {{ optional($leave_application->second_approvers->users)->last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td> --}}
                                    <td>{{ optional($leave_application->leavetypes)->leave_type_title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} - {{ $leave_application->start_of_date_parts->day_part_title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} - {{ $leave_application->end_of_date_parts->day_part_title }}</td>
                                    <td>{{ $leave_application->duration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y; h:i a') }}</td>
                                    <td>
                                        @if ($leave_application->status_id == 'sta-1001')
                                            <span class="badge bg-secondary">{{ $leave_application->statuses->status_title }}</span>
                                        @elseif ($leave_application->status_id == 'sta-1002')
                                            <p class="bg-success text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                        @elseif ($leave_application->status_id == 'sta-1003')
                                            <span class="badge bg-secondary">{{ $leave_application->statuses->status_title }}</span>
                                        @elseif ($leave_application->status_id == 'sta-1004')
                                            <p class="bg-danger text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                        @elseif ($leave_application->status_id == 'sta-1005')
                                            <p class="bg-warning text-dark ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-2 pb-3">
                                        <button class="btn btn-sm btn-primary rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
                                        <a href="#" class="btn btn-sm btn-success rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">Approve</a>
                                        <a href="#" class="btn btn-sm btn-danger rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_application->reference_number }}">Reject</a>
                                    </td>
                                </tr>
                                <!-- reject details Modal -->
                                    <x-employee.leave-app-reject-modal
                                        :leaveReferenceNumber="$leave_application->reference_number"
                                        >
                                    </x-employee.leave-app-reject-modal>
                                {{-- reject details Modal --}}
                                <!-- approve leave Modal -->
                                    <x-employee.leave-app-approve-modal
                                        :leaveReferenceNumber="$leave_application->reference_number"
                                        >
                                    </x-employee.leave-app-approve-modal>
                                {{-- end approve leave Modal --}}
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
                                        :leaveAppEmployee="$leave_application->employee_id"
                                        :attachment="$leave_application->attachment"
                                        :status="$leave_application->status_id"
                                        >
                                    </x-employee.leave-app-details-modal>
                                {{-- leave details Modal --}}
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <div class="row align-items-center justify-content-center mt-3">
                                        <div class="col text-center">
                                            <x-errors.no-leave-app-found>
                                            </x-errors.no-leave-app-found>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
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
</div>
@endsection
