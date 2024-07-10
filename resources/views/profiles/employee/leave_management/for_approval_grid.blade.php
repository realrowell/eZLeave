@extends('profiles.employee.leave_management.for_approval')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')


<div class="spinner-border text-primary" id="loading_spinner_approve" role="status" style="display: none;">
    <span class="visually-hidden" >Loading...</span>
</div>
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start" id="table_container">
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
        <div class="row align-items-center justify-content-center mt-5 mb-5">
            <div class="col text-center">
                <x-errors.no-leave-app-found>
                </x-errors.no-leave-app-found>
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col">
        <div class="mt-5 mb-5">
            <ul class="pagination justify-content-center align-items-center">
                {!! $leave_applications->links('pagination::bootstrap-5') !!}
            </ul>
        </div>
    </div>
</div>
@endsection
