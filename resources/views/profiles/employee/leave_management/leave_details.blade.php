@extends('profiles.employee.leave_management.pending_approval')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="container">
    <div class="container-fluid bg-light shadow">
        <div class="row"></div>
        <div class="row mt-5 mb-5">
            <div class="col-lg-1 col-md-12 col-sm-12"></div>
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="row">
                    <form action="{{ route('update_employee_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
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
                                    <div class="row">
                                        <div class="col">
                                            <label class="" for="leavetype">
                                                <h6 class="">Leave Type</h6>
                                            </label>
                                            <input type="text" class="form-control text-start" value="{{ optional($leave_application->leavetypes)->leave_type_title }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        @if ($leave_application->status_id != 'sta-1001' || $leave_application->employee_id != auth()->user()->employees->id)
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
                                        @else
                                            <div class="col-6">
                                                <label for="startdate">
                                                    <h6>Start date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_startdate_update" name="startdate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->start_date)->format('Y-m-d') }}" onchange="showLeaveDuration_onUpdate()">
                                            </div>
                                            <div class="col-6">
                                                <label for="enddate">
                                                    <h6>End date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_enddate_update" name="enddate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->end_date)->format('Y-m-d') }}" onchange="showLeaveDuration_onUpdate()">
                                            </div>
                                        @endif
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
                                            <h5>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:i:s A') }}</h5>
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
                                            @if ($leave_application->status_id != 'sta-1001')
                                                <label class="" for="attachment">
                                                    <h6 class=""><i>No Attachment Attached</i> </h6>
                                                </label>
                                            @else
                                                @if (!empty($leave_application->attachment))
                                                    <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                                @else
                                                    @if ($leave_application->employee_id == auth()->user()->employees->id)
                                                        <label class="" for="attachment">
                                                            <h6 class="">Attachment</h6>
                                                        </label>
                                                        <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                                    @else
                                                        <i>No Attachment</i>
                                                    @endif
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
                                                                <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                            @elseif($leave_approval->status_id == 'sta-1004')
                                                                @if ($leave_approval->reason_note != null)
                                                                    <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                                @endif
                                                                <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                            @elseif($leave_approval->status_id == 'sta-1005')
                                                                @if ($leave_approval->reason_note != null)
                                                                    <textarea class="form-control" rows="1" disabled>{{ $leave_approval->reason_note }}</textarea>
                                                                @endif
                                                                <p class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col">
                                            <label class="mb-3" for="reason">
                                                <h5 class="">Reason / Note</h5>
                                            </label>
                                            @foreach ($leave_application_notes as $leave_application_note)
                                                @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                                    @if ($leave_application_note->employee_id != null)
                                                        @if ($leave_application_note->employee_id == $leave_application->employee_id)
                                                            <div class="row">
                                                                <div class="col">
                                                                    <span class="bg-msg-custom text-light rounded-pill pe-4 ps-4 pt-2 pb-2">
                                                                        {{ $leave_application_note->reason_note }}
                                                                    </span>
                                                                    <p class="mt-2"> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} at {{ $leave_application_note->created_at }}</p>
                                                                </div>
                                                            </div>
                                                        @elseif ($leave_application_note->employee_id != $leave_application->employee_id)
                                                            <div class="row">
                                                                <div class="col text-end">
                                                                    <span class="bg-msg-custom text-light rounded-pill pe-4 ps-4 pt-2 pb-2">
                                                                        {{ $leave_application_note->reason_note }}
                                                                    </span>
                                                                    <p class="mt-2"> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} at {{ $leave_application_note->created_at }}</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                        @if ($leave_application->employee_id == auth()->user()->employees->id || $leave_application->approver_id == auth()->user()->employees->id)

                                        @endif
                                        <div class="row mt-1">
                                            <div class="col">
                                                <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                            </div>
                                        </div>
                                    @else

                                    @endif
                                </div>
                            </div>
                            <div class="row text-end mt-3">
                                <div class="col">
                                    @if ($leave_application->status_id == 'sta-1001' || $leave_application->status_id == 'sta-1003')
                                        <a class="btn btn-danger" href="{{ route('profile_leave_management_pending_approval_grid') }}">Cancel</a>
                                        <button type="submit" class="btn btn-success ms-3" data-bs-dismiss="modal" onclick="onClickUpdateSubmit()">Update</button>
                                    @else
                                        <a class="btn btn-outline-primary" href="{{ route('profile_leave_management_pending_approval_grid') }}">Back to Leave Management</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-1 col-md-12 col-sm-12"></div>
        </div>
        <div class="row"></div>
    </div>
</div>

@endsection
