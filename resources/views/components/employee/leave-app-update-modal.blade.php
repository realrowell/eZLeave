<div class="modal fade" id="updatedetailsModal{{ $leave_reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('update_employee_leaveapplication',['leave_application_rn'=>$leave_reference_number]) }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid text-start">
                        <div class="row pt-3">
                            <div class="col " id="form_container_onUpdate{{ $leave_reference_number }}">
                                <div class="row">
                                    <div class="col-9">
                                        <label for="employee">
                                            <h3 class="">Update Leave Details</h3>
                                        </label>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="btn_modal_x_onUpdate{{ $leave_reference_number }}" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col">
                                        <label for="employee">
                                            <h6 class="">Reference Number</h6>
                                        </label>
                                        <h5>{{ $leave_reference_number }}</h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="leavetype">
                                            <h6 class="">Leave Type</h6>
                                        </label>
                                        <input type="text" class="form-control text-start" value="{{ $leave_type_title }}" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="startdate">
                                            <h6>Start date</h6>
                                        </label>
                                        <input type="date" class="form-control" id="startdate_onUpdate{{ $leave_reference_number }}" name="startdate" value="{{ \Carbon\Carbon::parse($leave_start)->format('Y-m-d') }}" disabled>
                                    </div>
                                    <div class="col-6">
                                        <label for="enddate">
                                            <h6>End date</h6>
                                        </label>
                                        <input type="date" class="form-control" id="enddate_onUpdate{{ $leave_reference_number }}" name="enddate" value="{{ \Carbon\Carbon::parse($leave_end)->format('Y-m-d') }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="startdate">
                                            <h6>{{ $leave_start_part }}</h6>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label for="enddate">
                                            <h6>{{ $leave_end_part }}</h6>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Duration (days)</label>
                                        <input type="text" name="duration" placeholder="" id="duration_onUpdate{{ $leave_reference_number }}" class="form-control" value="{{ $leave_duration }}" disabled/>
                                    </div>
                                </div>
                                <div class="row mt-4">
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
                                            <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment" oninput="submitBtnEnable_onUpdate('{{ $leave_reference_number }}')">
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="reason">
                                            <h6 class="">Reason / Note</h6>
                                        </label>
                                        @foreach ($leave_notes as $leave_application_note)
                                            @if ($leave_application_note->leave_application_reference == $leave_reference_number)
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
                                        <textarea class="form-control" id="reason" name="reason" placeholder="add note" oninput="submitBtnEnable_onUpdate('{{ $leave_reference_number }}')" ></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="status">
                                            <h6 class="">Status</h6>
                                        </label>
                                        @if ($status == 'sta-1001')
                                            @foreach ($leave_approvals as $leave_approval)
                                                @if ($leave_approval->leave_application_reference == $leave_reference_number)
                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                @endif
                                            @endforeach
                                        @elseif ($status == 'sta-1003')
                                            @foreach ($leave_approvals as $leave_approval)
                                                @if ($leave_approval->leave_application_reference == $leave_reference_number)
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
                    <button type="button" class="btn btn-transparent rounded-0" id="btn_close_onUpdate{{ $leave_reference_number }}" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-0 disabled" id="btn_update{{ $leave_reference_number }}" onclick="onClickUpdateLeaveId('{{ $leave_reference_number }}')">
                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_update{{ $leave_reference_number }}">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        Update Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
