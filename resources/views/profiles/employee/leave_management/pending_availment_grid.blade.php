@extends('profiles.employee.leave_management.pending_availment')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @if ($leave_applications->isNotEmpty())
        @foreach ($leave_applications as $leave_application)
            <div class="col-lg-3 col-md-6 col-sm-10">
                {{-- leave card --}}
                    <x-employee.leave-app-card
                        :leaveReferenceNumber="$leave_application->reference_number"
                        :leaveTypeTitle="$leave_application->leavetypes?->leave_type_title"
                        :leaveDuration="$leave_application->duration"
                        :leaveStart="$leave_application->start_date"
                        :leaveEnd="$leave_application->end_date"
                        :leaveCreated="$leave_application->created_at"
                        :approverName="$leave_application->approvers?->users?->first_name.' '.$leave_application->approvers?->users?->last_name"
                        :secondApproverId="$leave_application->second_approver_id"
                        :secondApproverName="$leave_application->second_approvers?->users?->first_name.' '.$leave_application->second_approvers?->users?->last_name"
                        :leaveAppEmployee="$leave_application->employee_id"
                        :status="$leave_application->status_id"
                        :statusTitle="$leave_application->statuses->status_title"
                        >
                    </x-employee.leave-app-card>
                {{-- end leave card --}}
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
                    :leaveAppEmployee="$leave_application->employee_id"
                    :attachment="$leave_application->attachment"
                    :status="$leave_application->status_id"
                    >
                </x-employee.leave-app-details-modal>
            {{-- leave details Modal --}}
        @endforeach
    @else
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col text-center">
                <x-errors.no-leave-app-found>
                </x-errors.no-leave-app-found>
            </div>
        </div>
    @endif
</div>

@endsection
