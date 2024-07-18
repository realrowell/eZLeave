@extends('profiles.employee.leave_management.leave_details_layout')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="container-fluid ">
    <div class="row mt-5 mb-5">
        <div class="col-lg-1 col-md-12 col-sm-12"></div>
        <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <label for="employee">
                                <h2 class="">Leave Details</h2>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h6 class="">Employee</h6>
                                    <h6>{{ $employee_name }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h6 class="">Designation</h6>
                                    <h6>{{ $employee_designation }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h6 class="">Department</h6>
                                    <h6>{{ $employee_subdepartment }} - {{ $employee_department }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h6 class="">Area of Assignment</h6>
                                    <h6>{{ $employee_area }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="employee">
                                <h6 class="">Reference Number</h6>
                            </label>
                            <h4>{{ $leave_application->reference_number }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <form action="{{ route('update_employee_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="onClickApprove()" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
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
                                <div class="row mt-2">
                                    <div class="col" id="datelabel_start_am_up" style="display: none;">
                                        <div class="form-check">
                                            <label for="start_am_check_up" class="form-check-label" >Morning</label>
                                            <input type="checkbox" class="form-check-input" id="start_am_check_up" name="start_am_check" value="1" onchange="showLeaveDuration_onUpdate()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_start_pm_up" style="display: none;">
                                        <div class="form-check">
                                            <label for="start_pm_check_up" class="form-check-label" >Afternoon</label>
                                            <input type="checkbox" class="form-check-input" id="start_pm_check_up" name="start_pm_check" value="1" onchange="showLeaveDuration_onUpdate()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_end_am_up" style="display: none;">
                                        <div class="form-check">
                                            <label for="end_am_check_up" class="form-check-label" >Morning</label>
                                            <input type="checkbox" class="form-check-input" id="end_am_check_up" name="end_am_check" value="1" onchange="showLeaveDuration_onUpdate()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_end_pm_up" style="display: none;">
                                        <div class="form-check">
                                            <label for="end_pm_check_up" class="form-check-label" >Afternoon</label>
                                            <input type="checkbox" class="form-check-input" id="end_pm_check_up" name="end_pm_check" value="1" onchange="showLeaveDuration_onUpdate()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Duration (days)</label>
                                        <input type="text" name="duration" placeholder="" id="duration_input_up" class="form-control" value="{{ $leave_application->duration }}" disabled/>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="enddate">
                                            <h6>Date filed</h6>
                                        </label>
                                        <h5>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:ia') }}</h5>
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
                                        @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                            @if (!empty($leave_application->attachment))
                                                <a class="btn btn-sm rounded-0 btn-primary text-center" target="_blank" href="{{ asset('storage/images/leave_attachment/'.$leave_application->attachment) }}">View Attachment</a>
                                            @else
                                                @if ($leave_application->employee_id == auth()->user()->employees->id)
                                                    <label class="" for="attachment">
                                                        <h6 class="">Attachment</h6>
                                                    </label>
                                                    <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                                @else
                                                    <a class="btn btn-sm rounded-0 btn-primary text-center disabled">No Attachment</a>
                                                @endif
                                            @endif
                                        @else
                                            @if (!empty($leave_application->attachment))
                                                <a class="btn rounded-0 btn-primary text-center" target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                            @else
                                                <a class="btn btn-sm rounded-0 btn-primary text-center disabled">No Attachment</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-2">
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
                                                            <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                        @elseif($leave_approval->status_id == 'sta-1004')
                                                            @if ($leave_approval->reason_note != null)
                                                                <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                            @endif
                                                            <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                                        @elseif($leave_approval->status_id == 'sta-1005')
                                                            @if ($leave_approval->reason_note != null)
                                                                <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                            @endif
                                                            <p class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
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
                                            @if ($leave_application->employee_id == auth()->user()->employees->id)
                                                @if (!empty($leave_application->attachment))
                                                    <button class="btn btn-sm btn-primary ms-3 rounded-0" disabled>Update Details</button>
                                                @else
                                                    <button type="submit" id="submit_button1" class="btn btn-sm btn-primary ms-3 rounded-0" onclick="onClickApprove()">Update Details</button>
                                                @endif
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
                                            @if ($leave_application->status_id == 'sta-1001' && $leave_application->approver_id == auth()->user()->employees->id)
                                                <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                            @elseif ($leave_application->status_id == 'sta-1003' && $leave_application->second_approver_id == auth()->user()->employees->id)
                                                <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                            @elseif ($leave_application->employee_id == auth()->user()->employees->id)
                                                <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                            @else
                                                <textarea class="form-control" id="reason" name="reason" placeholder="add note" disabled></textarea>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col text-end">
                                            @if ($leave_application->status_id == 'sta-1001' && $leave_application->approver_id == auth()->user()->employees->id)
                                                <button type="submit" id="submit_button1" class="btn btn-sm btn-primary ms-3 rounded-0" onclick="onClickApprove()">Add Note</button>
                                            @elseif ($leave_application->status_id == 'sta-1003' && $leave_application->second_approver_id == auth()->user()->employees->id)
                                                <button type="submit" id="submit_button1" class="btn btn-sm btn-primary ms-3 rounded-0" onclick="onClickApprove()">Add Note</button>
                                            @elseif ($leave_application->employee_id == auth()->user()->employees->id)
                                                <button type="submit" id="submit_button1" class="btn btn-sm btn-primary ms-3 rounded-0" onclick="onClickApprove()">Add Note</button>
                                            @else
                                                <button id="submit_button1" class="btn btn-sm btn-success ms-3 rounded-0" disabled>Add Note</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="row text-end mt-5">
                        <div class="col">
                            @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                @if ($leave_application->status_id == 'sta-1001')
                                    @if ($leave_application->employee_id == auth()->user()->employees->id)
                                        <a class="btn btn-danger text-center rounded-0" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_application->reference_number }}">Cancel Request</a>
                                    @endif
                                    @if ($leave_application->approver_id == auth()->user()->employees->id)
                                        <a href="#" class="btn btn-danger text-center rounded-0" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_application->reference_number }}">Reject</a>
                                        <a href="#" class="btn btn-success text-center rounded-0 ms-3" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">Approve</a>
                                    @endif
                                @elseif ($leave_application->status_id == 'sta-1003')
                                    @if ($leave_application->second_approver_id == auth()->user()->employees->id)
                                        <a href="#" class="btn btn-danger text-center rounded-0" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_application->reference_number }}">Reject</a>
                                        <a href="#" class="btn btn-success text-center rounded-0 ms-3" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">Approve</a>
                                    @endif
                                @endif

                            @else
                                <a class="btn btn-primary rounded-0" href="{{ route('profile_leave_management_pending_approval_grid') }}">Back to Leave Management</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- approve leave Modal -->
                    <x-employee.leave-app-approve-modal
                        :leaveReferenceNumber="$leave_application->reference_number"
                        >
                    </x-employee.leave-app-approve-modal>
                {{-- end approve leave Modal --}}
                <!-- cancel details Modal -->
                    <x-employee.leave-app-cancel-modal
                        :leaveReferenceNumber="$leave_application->reference_number"
                        >
                    </x-employee.leave-app-cancel-modal>
                {{-- cancel details Modal --}}
                <!-- reject details Modal -->
                    <x-employee.leave-app-reject-modal
                        :leaveReferenceNumber="$leave_application->reference_number"
                        >
                    </x-employee.leave-app-reject-modal>
                {{-- reject details Modal --}}
            </div>
        </div>
        <div class="col-lg-1 col-md-12 col-sm-12"></div>
    </div>
    <div class="row"></div>
</div>

@endsection
