@extends('profiles.employee.leave_management.pending_approval')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start" >
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
                <x-errors.no-leave-app-found>
                </x-errors.no-leave-app-found>
            </div>
        </div>
    @endif

    <div class="col-lg-3 col-md-6 col-sm-10">
        <a href="#ApplyLeaveModal" class="text-dark" data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
            <div class="card w-100 h-100 p-2 card-menu align-self-center shadow shadow-sm border border-end-0 border-start-0 border-bottom-0 border-warning border-5 rounded-0" style="">
                <div class="card-body" style="padding-top: 25%; padding-bottom: 25%" >
                    <h5 class="card-title text-center">Click Here {{ svg('tabler-hand-click') }}</h5>
                    <div class="text-center justify-content-center align-items-center" style="font-size: 4rem">
                        <i class='bx bx-calendar-plus '></i>
                    </div>
                    <h5 class="card-title text-center mt-3">To apply new <br /> leave application</h5>
                </div>
            </div>
        </a>
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
@endsection
