@extends('profiles.hr_staff.hr_leave_management.hrstaff_leave_management')
@section('sub_menu_pending_approval','text-dark')
@section('sub_menu_approved','text-dark')
@section('sub_menu_cancelled','text-dark')
@section('sub_menu_reject','text-dark')
@section('sub_menu_pending_availment','text-dark')
@section('sub_menu_all','text-dark')
@section('sub-sub-content')

<div class="row mt-3 mb-3">
    <div class="col-lg-1 col-md-12 col-sm-12"></div>
    <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <label for="employee">
                        <h4 class="">
                            Leave Details
                        </h4>
                    </label>
                </div>
                <div class="col">
                    <h5>
                        Export
                        <div class="btn-group ps-3">
                            <a href="#" class="btn btn-sm btn-outline-secondary ps-3 pe-3">CSV</a>
                            <a href="#" class="btn btn-sm btn-secondary ps-3 pe-3">Print</a>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <div class="row mt-3" id="form_to_submit">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <h6 class="profile-title">Employee</h6>
                        <h6 class="profile-title-value">{{ $employee_name }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <h6 class="profile-title">Designation</h6>
                        <h6 class="profile-title-value">{{ $employee_designation }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <h6 class="profile-title">Department</h6>
                        <h6 class="profile-title-value">{{ $employee_subdepartment }} - {{ $employee_department }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <h6 class="profile-title">Area of Assignment</h6>
                        <h6 class="profile-title-value">{{ $employee_area }}</h6>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="employee">
                            <h6 class="">Reference Number</h6>
                        </label>
                        <h5>{{ $leave_application->reference_number }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <form action="{{ route('update_employee_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="onFormSubmit()" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label class="" for="leavetype">
                                        <h6 class="">Leave Type</h6>
                                    </label>
                                    <input type="text" class="form-control text-start" value="{{ optional($leave_application->leavetypes)->leave_type_title }}" disabled>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="startdate">
                                        <h6>Start date</h6>
                                    </label>
                                    <input type="text" class="form-control" id="datetime_startdate_update" name="startdate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->start_date)->format('m/d/Y') }} - {{ $leave_application->start_of_date_parts->day_part_description }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="enddate">
                                        <h6>End date</h6>
                                    </label>
                                    <input type="text" class="form-control" id="datetime_enddate_update" name="enddate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->end_date)->format('m/d/Y') }} - {{ $leave_application->end_of_date_parts->day_part_description }}" disabled>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Duration (days)</label>
                                    <input type="text" name="duration" placeholder="" id="duration_input_up" class="form-control" value="{{ $leave_application->duration }}" disabled/>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="enddate">
                                        <h6>Date filed</h6>
                                    </label>
                                    <h5>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:i:s A') }}</h5>
                                </div>
                            </div>
                            <div class="row mt-3">
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
                            <div class="row mt-3">
                                <div class="col">
                                    @if ($leave_application->status_id != 'sta-1001')
                                        <a class="btn btn-sm btn-primary rounded-0 disabled" href="#">No Attachment</a>
                                    @else
                                        @if (!empty($leave_application->attachment))
                                            <a class="btn btn-sm btn-primary rounded-0" target="_blank" href="{{ asset('storage/images/leave_attachment/'.$leave_application->attachment) }}">View Attachment</a>
                                        @else
                                            <label class="" for="attachment">
                                                <h6 class="">Attachment</h6>
                                            </label>
                                            <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label class="" for="status">
                                                <h6 class="">Status</h6>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            @foreach ($leave_approvals as $leave_approval)
                                                @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                    @if ($leave_approval->status_id == 'sta-1001')
                                                        @if ($leave_approval->reason_note != null)
                                                            <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                        @endif
                                                        <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                    @elseif ($leave_approval->status_id == 'sta-1002')
                                                        @if ($leave_approval->reason_note != null)
                                                            <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                        @endif
                                                        <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} ● {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                    @elseif($leave_approval->status_id == 'sta-1004')
                                                        @if ($leave_approval->reason_note != null)
                                                            <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                        @endif
                                                        <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} ● {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                    @elseif($leave_approval->status_id == 'sta-1005')
                                                        @if ($leave_approval->reason_note != null)
                                                            <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                        @endif
                                                        <p class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} ● {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-end">
                                <div class="col">
                                    @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                        @if (!empty($leave_application->attachment))
                                            <button class="btn btn-sm btn-primary ms-3 rounded-0" disabled>Update Details</button>
                                        @else
                                            <button type="submit" id="submit_button1" class="btn btn-sm btn-primary ms-3 rounded-0" onclick="onClickApprove()">Update Details</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <form action="{{ route('create_note_employee_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="onClickApprove()" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label class="mb-3" for="reason">
                                        <h5 class="">Reason / Note</h5>
                                    </label>
                                    @foreach ($leave_application_notes as $leave_application_note)
                                        @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                            @if ($leave_application_note->author_id != null)
                                                @if ($leave_application_note->author_id == $leave_application->employees->users->id)
                                                    {{-- <div class="row">
                                                        <div class="col">
                                                            <span class="bg-msg-custom text-light rounded-pill pe-4 ps-4 pt-2 pb-2">
                                                                {{ $leave_application_note->reason_note }}
                                                            </span>
                                                            <p class="mt-2">{{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} - {{ timestamp_leadtime($leave_application_note->created_at) }}</p>
                                                        </div>
                                                    </div> --}}
                                                    <div class="speech-wrapper mt-3 mb-2">
                                                        <div class="bubble ">
                                                            <div class="txt">
                                                                <p class="name">{{ $leave_application_note->users?->first_name }} {{ $leave_application_note->users?->last_name }}</p>
                                                                <p class="message">{{ $leave_application_note->reason_note }}</p>
                                                                <span class="timestamp ">{{ timestamp_leadtime( $leave_application_note->created_at ) }}</span>
                                                            </div>
                                                            <div class="bubble-arrow"></div>
                                                        </div>
                                                    </div>
                                                @elseif ($leave_application_note->author_id != $leave_application->employees->users->id)
                                                    <div class="speech-wrapper mt-3 mb-2">
                                                        <div class="bubble alt">
                                                            <div class="txt">
                                                                <p class="name alt">{{ $leave_application_note->users?->first_name }} {{ $leave_application_note->users?->last_name }}</p>
                                                                <p class="message">{{ $leave_application_note->reason_note }}</p>
                                                                <span class="timestamp fw-b">{{ timestamp_leadtime( $leave_application_note->created_at ) }}</span>
                                                            </div>
                                                            <div class="bubble-arrow alt"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                <div class="row mt-1">
                                    <div class="col">
                                        @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                            <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                        @else
                                            <textarea class="form-control" id="reason" name="reason" placeholder="add note" disabled></textarea>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-end">
                                        @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                            <button type="submit" id="submit_button1" class="btn btn-sm btn-primary ms-3 rounded-0" onclick="onClickApprove()">Add Note</button>
                                        @else
                                            <button id="submit_button1" class="btn btn-sm btn-success ms-3 rounded-0" disabled>Add Note</button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                    {{-- <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col">
                                <label class="mb-3" for="reason">
                                    <h5 class="">Reason / Note</h5>
                                </label>
                                @foreach ($leave_application_notes as $leave_application_note)
                                    @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                        @if ($leave_application_note->author_id != null)
                                            @if ($leave_application_note->author_id == $leave_application->employees->users->id)
                                                <div class="speech-wrapper mt-3 mb-2">
                                                    <div class="bubble ">
                                                        <div class="txt">
                                                            <p class="name">{{ $leave_application_note->users?->first_name }} {{ $leave_application_note->users?->last_name }}</p>
                                                            <p class="message">{{ $leave_application_note->reason_note }}</p>
                                                            <span class="timestamp fw-b">{{ timestamp_leadtime( $leave_application_note->created_at ) }}</span>
                                                        </div>
                                                        <div class="bubble-arrow"></div>
                                                    </div>
                                                </div>
                                            @elseif ($leave_application_note->author_id != $leave_application->employees->users->id)
                                                <div class="speech-wrapper mt-3 mb-2">
                                                    <div class="bubble alt">
                                                        <div class="txt">
                                                            <p class="name alt">{{ $leave_application_note->users?->first_name }} {{ $leave_application_note->users?->last_name }}</p>
                                                            <p class="message">{{ $leave_application_note->reason_note }}</p>
                                                            <span class="timestamp fw-b">{{ timestamp_leadtime( $leave_application_note->created_at ) }}</span>
                                                        </div>
                                                        <div class="bubble-arrow alt"></div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                                @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                    <div class="row mt-1">
                                        <div class="col">
                                            @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                                <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                            @else
                                                <textarea class="form-control" id="reason" name="reason" placeholder="add note" disabled></textarea>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col text-end">
                                            @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                                <button type="submit" id="submit_button1" class="btn btn-sm btn-primary ms-3 rounded-0" onclick="onClickApprove()">Add Note</button>
                                            @else
                                                <button id="submit_button1" class="btn btn-sm btn-success ms-3 rounded-0" disabled>Add Note</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <hr class="hr" />
                    </div>
                </div>
                <div class="row text-end mt-3">
                    <div class="col text-start">
                        <a class="btn btn-primary rounded-0" href="{{ route('hrstaff_leave_management') }}"><i class='bx bx-arrow-back' ></i>Back to Leave Management</a>
                    </div>
                    <div class="col text-end">
                        @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                            <a class="btn btn-danger rounded-0 ps-3 pe-3" href="#" data-bs-toggle="modal" data-bs-target="#rejectLeaveModal{{ $leave_application->reference_number }}">
                                <i class='bx bx-x me-2 pt-1'></i>Reject
                            </a>
                            <a class="btn btn-success rounded-0 ms-3 ps-3 pe-3" href="#" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">
                                <i class='bx bx-check me-2 pt-1' ></i>Approve
                            </a>
                        @elseif ($leave_application->status_id == 'sta-1002')
                            <button type="button" class="btn btn-danger rounded-0 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#cancelLeaveModal{{ $leave_application->reference_number }}">
                                <i class='bx bxs-x-circle me-2 pt-1' ></i>Cancel
                            </button>
                        @endif
                    </div>
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
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-1 col-md-12 col-sm-12"></div>
</div>

@endsection
