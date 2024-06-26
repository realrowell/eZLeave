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
                <div class="modal fade" id="detailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
                            <div class="modal-body">
                                <div class="container-fluid text-start">
                                    <div class="row pt-3">
                                        <div class="col-9">
                                            <h5 class="modal-title">Leave Details</h5>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row pt-3">
                                                <div class="col">
                                                    <label for="employee">
                                                        <h6 class="">Reference Number</h6>
                                                    </label>
                                                    <input type="text" class="form-control" disabled value="{{ $leave_application->reference_number }}">
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col">
                                                    <label class="" for="leavetype">
                                                        <h6 class="">Leave Type</h6>
                                                    </label>
                                                    <input type="text" class="form-control" disabled value="{{ optional($leave_application->leavetypes)->leave_type_title }}">
                                                    {{-- <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4> --}}
                                                </div>
                                                <div class="col">
                                                    <label for="duration">
                                                        <h6>Duration</h6>
                                                    </label>
                                                    <input type="text" class="form-control" disabled value="{{ $leave_application->duration }}">
                                                    {{-- <h4>{{ $leave_application->duration }}</h4> --}}
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-6">
                                                    <label for="startdate">
                                                        <h6>Start date</h6>
                                                    </label>
                                                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} ({{ $leave_application->start_of_date_parts->day_part_title }})">
                                                    {{-- <h4>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} ({{ $leave_application->start_of_date_parts->day_part_title }})</h4> --}}
                                                </div>
                                                <div class="col-6">
                                                    <label for="enddate">
                                                        <h6>End date</h6>
                                                    </label>
                                                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} ({{ $leave_application->end_of_date_parts->day_part_title }})">
                                                    {{-- <h4>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} ({{ $leave_application->end_of_date_parts->day_part_title }})</h4> --}}
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col">
                                                    <label for="enddate">
                                                        <h6>Date filed</h6>
                                                    </label>
                                                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y - h:i:s A') }}">
                                                    {{-- <h4>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:i:s A') }}</h4> --}}
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
                                                    @if (!empty($leave_application->attachment))
                                                        <a class="btn btn-sm btn-primary rounded-0" target="_blank" href="{{ asset('storage/images/leave_attachment/'.$leave_application->attachment) }}">View Attachment</a>
                                                    @else
                                                        <a class="btn btn-sm btn-primary disabled rounded-0" >No Attachment</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label class="" for="reason">
                                                        <h6 class="">Reason / Note</h6>
                                                    </label>
                                                    @foreach ($leave_application_notes as $leave_application_note)
                                                        @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                                            <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                            @if ($leave_application_note->author_id != null)
                                                                <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} • {{ timestamp_leadtime($leave_application_note->created_at)}}</p>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label class="" for="status">
                                                        <h6 class="">Status</h6>
                                                    </label>
                                                    @if ($leave_application->status_id == 'sta-1001')
                                                        @foreach ($leave_approvals as $leave_approval)
                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                            @endif
                                                        @endforeach
                                                    @elseif ($leave_application->status_id == 'sta-1003')
                                                        @foreach ($leave_approvals as $leave_approval)
                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                @if ($leave_approval->status_id == 'sta-1001')
                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="" for="update">
                                                        @if ($leave_application->status_id == 'sta-1001')
                                                            <button type="button" class="btn btn-sm btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#updatedetailsModal{{ $leave_application->reference_number }}">
                                                                Update Application
                                                            </button>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @if ($leave_application->status_id == 'sta-1001')
                                    <button class="btn btn-danger text-center rounded-0" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_application->reference_number }}">Cancel Application</button>
                                @else
                                    <button class="btn btn-danger text-center rounded-0" disabled>Cancel</button>
                                @endif
                                <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- leave details Modal --}}
            <!-- update details Modal -->
                <div class="modal fade" id="updatedetailsModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
                            <form action="{{ route('update_employee_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="container-fluid text-start">
                                        <div class="row pt-3">
                                            <div class="col " id="form_container_onUpdate{{ $leave_application->reference_number }}">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <label for="employee">
                                                            <h2 class="">Update Leave Details</h2>
                                                        </label>
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="btn_modal_x_onUpdate{{ $leave_application->reference_number }}" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="employee">
                                                            <h6 class="">Reference Number</h6>
                                                        </label>
                                                        <input type="text" class="form-control" disabled value="{{ $leave_application->reference_number }}">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
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
                                                        <input type="date" class="form-control" id="startdate_onUpdate{{ $leave_application->reference_number }}" name="startdate" value="{{ \Carbon\Carbon::parse($leave_application->start_date)->format('Y-m-d') }}" disabled>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="enddate">
                                                            <h6>End date</h6>
                                                        </label>
                                                        <input type="date" class="form-control" id="enddate_onUpdate{{ $leave_application->reference_number }}" name="enddate" value="{{ \Carbon\Carbon::parse($leave_application->end_date)->format('Y-m-d') }}" disabled>
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
                                                {{-- <div class="row mt-2 text-end">
                                                    <div class="col">
                                                        <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-sm btn-primary">Update Date</a>
                                                    </div>
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Duration (days)</label>
                                                        <input type="text" name="duration" placeholder="" id="duration_onUpdate{{ $leave_application->reference_number }}" class="form-control" value="{{ $leave_application->duration }}" disabled/>
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
                                                        @if (!empty($leave_application->attachment))
                                                            <a class="btn btn-sm btn-primary rounded-0" target="_blank" href="{{ asset('storage/images/leave_attachment/'.$leave_application->attachment) }}">View Attachment</a>
                                                        @else
                                                            <label class="" for="attachment">
                                                                <h6 class="">Attachment</h6>
                                                            </label>
                                                            <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment" oninput="submitBtnEnable_onUpdate('{{ $leave_application->reference_number }}')">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <label class="" for="reason">
                                                            <h6 class="">Reason / Note</h6>
                                                        </label>
                                                        @foreach ($leave_application_notes as $leave_application_note)
                                                            @if ($leave_application_note->leave_application_reference == $leave_application->reference_number)
                                                                <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                                @if ($leave_application_note->author_id != null)
                                                                    <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} • {{ timestamp_leadtime($leave_application_note->created_at)}}</p>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col">
                                                        <button class="btn btn-sm btn-primary rounded-0" id="addNoteButton" type="button" data-bs-toggle="collapse" data-bs-target="#addNote" aria-expanded="false" aria-controls="addNote">
                                                            Add Note
                                                        </button>
                                                    </div>
                                                    <div class="collapse mt-1" id="addNote">
                                                        <textarea class="form-control" id="reason" name="reason" placeholder="add note" oninput="submitBtnEnable_onUpdate('{{ $leave_application->reference_number }}')" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <label class="" for="status">
                                                            <h6 class="">Status</h6>
                                                        </label>
                                                        @if ($leave_application->status_id == 'sta-1001')
                                                            @foreach ($leave_approvals as $leave_approval)
                                                                @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                @endif
                                                            @endforeach
                                                        @elseif ($leave_application->status_id == 'sta-1003')
                                                            @foreach ($leave_approvals as $leave_approval)
                                                                @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                    @if ($leave_approval->status_id == 'sta-1001')
                                                                        <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                    @elseif ($leave_approval->status_id == 'sta-1002')
                                                                        <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent rounded-0" id="btn_close_onUpdate{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success rounded-0 disabled" id="btn_update{{ $leave_application->reference_number }}" onclick="onClickUpdateLeaveId('{{ $leave_application->reference_number }}')">
                                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_update{{ $leave_application->reference_number }}">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        Update Application
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- update leave details Modal --}}
            <!-- cancel details Modal -->
                <div class="modal fade" id="cancelleaveModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('employee_leave_cancellation',$leave_application->reference_number) }}" method="POST" >
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onCancel{{ $leave_application->reference_number }}"></button>
                                </div>
                                <div class="modal-body" id="form_container_onCancel{{ $leave_application->reference_number }}">
                                    <div class="container-fluid text-start">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h2>Are you sure to Cancel this Leave Request?</h2>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <h5>Reason / Note:</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <textarea class="form-control" id="reason" name="reason" rows="6" cols=50 maxlength=250 placeholder="add note" oninput="submitBtnEnable_onCancel('{{ $leave_application->reference_number }}')" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent" id="btn_close_onCancel{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-danger disabled" type="submit" id="btn_cancel{{ $leave_application->reference_number }}" onclick="onClickCancelId('{{ $leave_application->reference_number }}')">
                                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_cancel{{ $leave_application->reference_number }}">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        Confirm
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
