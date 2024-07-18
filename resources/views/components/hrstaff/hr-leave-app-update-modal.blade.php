<div class="modal fade" id="updatedetailsModal{{ $reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('update_leaveapplication',['leave_application_rn'=>$reference_number]) }}" method="POST" enctype="multipart/form-data" onsubmit="onClickUpdateLeaveId({{ $reference_number }})">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid text-start" id="form_container_onUpdate{{ $reference_number }}">
                        <div class="row">
                            <div class="col ">
                                <div class="row pt-3">
                                    <div class="col-9">
                                        <label for="employee">
                                            <h5 class="">Update Leave Details</h5>
                                        </label>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onUpdate{{ $reference_number }}"></button>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col">
                                        <label for="employee">
                                            <h6 class="">Reference Number</h6>
                                        </label>
                                        <h4>{{ $reference_number }}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="employee">
                                            <h6 class="">
                                                Employee
                                                <a target="_blank" href="{{ route('user_profile',$employee_username) }}">
                                                    <i class='bx bx-search' ></i>
                                                </a>
                                            </h6>
                                        </label>
                                        <input type="text" class="form-control text-start" value="{{ $employee_name }}" disabled>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col">
                                        <label class="" for="leavetype">
                                            <h6 class="">Leave Type</h6>
                                        </label>
                                        <input type="text" class="form-control" disabled value="{{ $leave_type_title }}">
                                    </div>
                                    <div class="col">
                                        <label for="duration">
                                            <h6>Duration</h6>
                                        </label>
                                        <input type="text" class="form-control" disabled value="{{ $leave_duration }}">
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-6">
                                        <label for="startdate">
                                            <h6>Start date</h6>
                                        </label>
                                        <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_start)->format('M d, Y') }} ({{ $leave_start_part }})">
                                    </div>
                                    <div class="col-6">
                                        <label for="enddate">
                                            <h6>End date</h6>
                                        </label>
                                        <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_end)->format('M d, Y') }} ({{ $leave_end_part }})">
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col">
                                        <label for="enddate">
                                            <h6>Date filed</h6>
                                        </label>
                                        <h5>{{ \Carbon\Carbon::parse($leave_created)->format('M d, Y \\a\\t h:i:s A') }}</h5>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col">
                                        <label for="employee">
                                            <h6 class="">Approver</h6>
                                        </label>
                                        <h5>
                                            {{ $leave_approver_name }}
                                        </h5>
                                    </div>
                                    <div class="col">
                                        <label for="employee">
                                            <h6 class="">Second Approver</h6>
                                        </label>
                                        <h5>
                                            @if ($second_approver_id == null)
                                                N/A
                                            @else
                                                {{ $second_approver_name }}
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        @if (!empty($attachment))
                                        <a class="btn btn-sm btn-primary rounded-0" target="_blank" href="{{ asset('storage/images/leave_attachment/'.$attachment) }}">View Attachment</a>
                                        @else
                                            <label class="" for="attachment">
                                                <h6 class="">Attachment</h6>
                                            </label>
                                            <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="reason">
                                            <h6 class="">Reason / Note</h6>
                                        </label>
                                        @foreach ($leave_notes as $leave_application_note)
                                            @if ($leave_application_note->leave_application_reference == $reference_number)
                                                <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                @if ($leave_application_note->author_id != null)
                                                    <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} at {{ $leave_application_note->created_at }}</p>
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
                                        <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="status">
                                            <h6 class="">Status</h6>
                                        </label>
                                        @foreach ($leave_approvals as $leave_approval)
                                            @if ($leave_approval->status_id == 'sta-1001')
                                                <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                            @elseif ($leave_approval->status_id == 'sta-1002')
                                                <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                            @elseif ($leave_approval->status_id == 'sta-1004')
                                                <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                            @elseif ($leave_approval->status_id == 'sta-1005')
                                                <p class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at) }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-start">
                                <button type="button" class="btn btn-transparent" id="btn_close_onUpdate{{ $reference_number }}" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="col text-end">
                                <button type="submit" class="btn btn-success rounded-0" id="btn_update{{ $reference_number }}">
                                    <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_update{{ $reference_number }}">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
