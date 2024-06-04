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
                <div class="card w-100 p-2 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title text-center">{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" id="approval_p">Reference #:</p>
                                <h5> {{ $leave_application->reference_number }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" id="approval_p">Date of application:</p>
                                <h5> {{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y - h:i:sa')}}</h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <p class="card-text" id="approval_p">Application by:</p>
                                <h6>
                                    {{ optional($leave_application->employees->users)->first_name }}
                                    {{ optional($leave_application->employees->users)->last_name }}
                                    {{ optional(optional($leave_application->employees->users)->suffixes)->suffix_title }}
                                </h6>
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
                                    <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
                                    <a href="#" class="btn btn-sm btn-success text-center" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">Approve</a>
                                    <a href="#" class="btn btn-sm btn-danger text-center" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_application->reference_number }}">Reject</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- reject details Modal -->
                <div class="modal fade" id="rejectleaveModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('employee_leave_rejection',$leave_application->reference_number) }}" method="POST" >
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onReject{{ $leave_application->reference_number }}"></button>
                                </div>
                                <div class="modal-body" id="form_container_onReject{{ $leave_application->reference_number }}">
                                    <div class="container-fluid text-start">
                                        <div class="row">
                                            <div class="col">
                                                <label for="employee">
                                                    <h4 class="">CONFIRM LEAVE REJECTION</h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="employee">
                                                    <h6 class="">Reference Number</h6>
                                                </label>
                                                <h4>{{ $leave_application->reference_number }}</h4>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <h5>Reason / Note:</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <textarea class="form-control" name="reason" id="reason" cols="10" rows="5" required oninput="submitBtnEnable_onReject('{{ $leave_application->reference_number }}')"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-transparent " id="btn_close_onReject{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger disabled" id="btn_reject{{ $leave_application->reference_number }}" onclick="onClickRejectId('{{ $leave_application->reference_number }}')">
                                                <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_reject{{ $leave_application->reference_number }}">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                Confirm Rejection
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- reject details Modal --}}
            <!-- approve leave Modal -->
                <div class="modal fade" id="approveLeaveModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('employee_leave_approval',$leave_application->reference_number) }}" method="POST" id="form_submit_approve">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_application->reference_number }}"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid text-start" id="form_container{{ $leave_application->reference_number }}" >
                                        <div class="row">
                                            <div class="col">
                                                <label for="employee">
                                                    <h4 class="">CONFIRM LEAVE APPROVAL</h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="employee">
                                                    <h6 class="">Reference Number</h6>
                                                </label>
                                                <h4>{{ $leave_application->reference_number }}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h6>Reason / Note:</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <textarea class="form-control" name="reason" id="reason" cols="10" rows="5" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-transparent " id="btn_close{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success " id="btn_submit{{ $leave_application->reference_number }}" onclick="onClickApproveId('{{ $leave_application->reference_number }}')">
                                                <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_approve{{ $leave_application->reference_number }}">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                Confirm Approval
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- end approve leave Modal --}}
            <!-- leave details Modal -->
                <div class="modal fade" id="detailsModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_application->reference_number }}"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid text-start">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                            <h2></h2>
                                        </div>
                                        <div class="col-lg-8 col-md-12 col-sm-12" id="form_container{{ $leave_application->reference_number }}" >
                                            <div class="row">
                                                <div class="col">
                                                    <label for="employee">
                                                        <h2 class="">Leave Details</h2>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="employee">
                                                        <h6 class="">Reference Number</h6>
                                                    </label>
                                                    <h4>{{ $leave_application->reference_number }}</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="" for="leavetype">
                                                        <h6 class="">Leave Type</h6>
                                                    </label>
                                                    <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                                                </div>
                                                <div class="col-6">
                                                    <label for="duration">
                                                        <h6>Duration (days)</h6>
                                                    </label>
                                                    <h4> {{ $leave_application->duration }}</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="startdate">
                                                        <h6>Start date</h6>
                                                    </label>
                                                    <h4 id="datetime_startdate">{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} ({{ $leave_application->start_of_date_parts->day_part_title }})</h4>
                                                </div>
                                                <div class="col-6">
                                                    <label for="enddate">
                                                        <h6>End date</h6>
                                                    </label>
                                                    <h4 id="datetime_enddate">{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} ({{ $leave_application->end_of_date_parts->day_part_title }})</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="enddate">
                                                        <h6>Date filed</h6>
                                                    </label>
                                                    <h4>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y - h:i:s A') }}</h4>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <label for="employee">
                                                        <h6 class="">Application by</h6>
                                                    </label>
                                                    <h5>
                                                        {{ optional($leave_application->employees->users)->first_name }}
                                                        {{ optional($leave_application->employees->users)->last_name }}
                                                        {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    @if (!empty($leave_application->attachment))
                                                        <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                                    @else
                                                        <label for="">No Attachment</label>
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
                                                                <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} at {{ $leave_application_note->created_at }}</p>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="" for="update">
                                                        @if ($leave_application->status_id == 'sta-1001')
                                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updatedetailsModal{{ $leave_application->reference_number }}">
                                                                Add note / comment
                                                            </button>
                                                        @endif
                                                    </label>
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
                                <a href="#" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_application->reference_number }}">Reject</a>
                                <a href="#" class="btn btn-success text-center" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_application->reference_number }}">Approve</a>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- leave details Modal --}}
            <!-- update details Modal -->
                <div class="modal fade" id="updatedetailsModal{{ $leave_application->reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onUpdate{{ $leave_application->reference_number }}"></button>
                            </div>
                            <form action="{{ route('create_note_employee_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" id="form_submit" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="container-fluid text-start">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                <h2></h2>
                                            </div>
                                            <div class="col-lg-8 col-md-12 col-sm-12" id="form_container_onUpdate{{ $leave_application->reference_number }}">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="employee">
                                                            <h6 class="">Reference Number</h6>
                                                        </label>
                                                        <h4>{{ $leave_application->reference_number }}</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="" for="leavetype">
                                                            <h6 class="">Leave Type</h6>
                                                        </label>
                                                        <input type="text" class="form-control text-start" value="{{ optional($leave_application->leavetypes)->leave_type_title }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-6">
                                                        <label for="startdate">
                                                            <h6>Start date</h6>
                                                        </label>
                                                        <input type="date" class="form-control" id="startdate" name="startdate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->start_date)->format('Y-m-d') }}" disabled>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="enddate">
                                                            <h6>End date</h6>
                                                        </label>
                                                        <input type="date" class="form-control" id="enddate" name="enddate" placeholder="" value="{{ \Carbon\Carbon::parse($leave_application->end_date)->format('Y-m-d') }}" disabled>
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
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Duration (days)</label>
                                                        <input type="text" name="duration" placeholder="" id="duration_input_update" class="form-control" value="{{ $leave_application->duration }}" disabled/>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="employee">
                                                            <h6 class="">Employee</h6>
                                                        </label>
                                                        <h5>{{ optional($leave_application->employees->users)->first_name }} {{ optional($leave_application->employees->users)->last_name }} {{ optional($leave_application->employees->users->suffixes)->suffix_title }}</h5>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        @if (!empty($leave_application->attachment))
                                                            <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
                                                        @else
                                                            <i>No Attachment</i>
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
                                                                    <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} at {{ $leave_application_note->created_at }}</p>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col">
                                                        <textarea class="form-control" id="reason" name="reason" placeholder="add note / comment" rows="5" oninput="submitBtnEnable_onUpdate('{{ $leave_application->reference_number }}')" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <label class="" for="status">
                                                            <h6 class="">Status</h6>
                                                        </label>
                                                        @if ($leave_application->status_id == 'sta-1001')
                                                            <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                        @elseif ($leave_application->status_id == 'sta-1002')
                                                            <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                        @elseif ($leave_application->status_id == 'sta-1003')
                                                            <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                        @elseif ($leave_application->status_id == 'sta-1004')
                                                            <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                        @elseif ($leave_application->status_id == 'sta-1005')
                                                            <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent" id="btn_close_onUpdate{{ $leave_application->reference_number }}" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success disabled" id="btn_update{{ $leave_application->reference_number }}" onclick="onClickUpdateLeaveId('{{ $leave_application->reference_number }}')">
                                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_update{{ $leave_application->reference_number }}">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- update leave details Modal --}}
        @endforeach
    @else
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col text-center">
                <h2>No leave application found!</h2>
            </div>
        </div>
    @endif
</div>
@endsection
