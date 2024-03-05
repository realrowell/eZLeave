@extends('profiles.employee.leave_management.for_approval')
@section('list_view_active','bg-selected-warning')
@section('sub-content')

<div class="row">
    <div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <table class="table table-striped table-hover bg-light">
                    <thead>
                        <tr>
                            <th>Reference Number</th>
                            <th>Full Name</th>
                            <th>Reports to</th>
                            <th>Leave Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Leave Credits</th>
                            <th>Filed at</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($leave_approvals->isNotEmpty())
                            @foreach ($leave_approvals as $leave_approval)
                                <tr>
                                    <td>{{ $leave_approval->leave_applications->reference_number }}</td>
                                    <td>
                                        {{ optional($leave_approval->leave_applications->employees->users)->first_name }} 
                                        {{ optional($leave_approval->leave_applications->employees->users)->last_name }} 
                                        {{ optional(optional($leave_approval->leave_applications->employees->users)->suffixes)->suffix_title }}
                                    </td>
                                    <td id="table_reports_to">
                                        @if (!empty($leave_approval->leave_applications->employees->employee_positions->reports_tos->users))
                                            {{ optional($leave_approval->leave_applications->employees->employee_positions->reports_tos)->first_name }} 
                                            {{ optional($leave_approval->leave_applications->employees->employee_positions->reports_tos->users)->middle_name }} 
                                            {{ optional($leave_approval->leave_applications->employees->employee_positions->reports_tos->users)->last_name }} 
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                    <td>{{ optional($leave_approval->leave_applications->leavetypes)->leave_type_title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->start_date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->end_date)->format('M d, Y') }}</td>
                                    <td>{{ $leave_approval->leave_applications->leave_days_credit }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->created_at)->format('M d, Y; h:i a') }}</td>
                                    <td>
                                        <p class="bg-secondary text-light ps-3 pe-2">{{ $leave_approval->leave_applications->statuses->status_title }}</p>
                                    </td>
                                    <td class="d-flex gap-2 pb-3">
                                        <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_approval->leave_applications->reference_number }}">View Details</button>
                                        <a href="#" class="btn btn-sm btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancel_modal">Cancel</a>
                                    </td>
                                </tr>
                                <!-- leave details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $leave_approval->leave_applications->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid text-start">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                                <h2></h2>
                                                            </div>
                                                            <div class="col-lg-8 col-md-12 col-sm-12">
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
                                                                        <h4>{{ $leave_approval->leave_applications->reference_number }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="employee">
                                                                            <h6 class="">Application by</h6>
                                                                        </label>
                                                                        <h4>
                                                                            {{ optional($leave_approval->leave_applications->employees->users)->first_name }} 
                                                                            {{ optional($leave_approval->leave_applications->employees->users)->last_name }} 
                                                                            {{ optional($leave_approval->leave_applications->employees->users->suffixes)->suffix_title }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col">
                                                                        <label class="" for="leavetype">
                                                                            <h6 class="">Leave Type</h6>
                                                                        </label>
                                                                        <h4>{{ optional($leave_approval->leave_applications->leavetypes)->leave_type_title }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-6">
                                                                        <label for="startdate">
                                                                            <h6>Start date</h6>
                                                                        </label>
                                                                        <h4>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->start_date)->format('M d, Y') }}</h4>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="enddate">
                                                                            <h6>End date</h6>
                                                                        </label>
                                                                        <h4>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->end_date)->format('M d, Y') }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col">
                                                                        <label for="enddate">
                                                                            <h6>Date filed</h6>
                                                                        </label>
                                                                        <h4>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->created_at)->format('M d, Y h:i:s A') }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col">
                                                                        @if (!empty($leave_applications->attachment))
                                                                            <a target="_blank" href="{{ asset('storage/images/'.$leave_approval->leave_applications->attachment) }}">View Attachment</a>
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
                                                                            @if ($leave_application_note->leave_application_reference == $leave_approval->leave_applications->reference_number)
                                                                                <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                                                @if ($leave_application_note->employee_id != null)
                                                                                    <p> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} ({{ optional($leave_application_note->employees->employee_positions->positions)->position_title }}) at {{ $leave_application_note->created_at }}</p>
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
                                                                        <p class="bg-secondary text-light ps-3">{{ $leave_approval->leave_applications->statuses->status_title }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label class="" for="update">
                                                                            @if ($leave_approval->leave_applications->status_id == 'sta-1001')
                                                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updatedetailsModal{{ $leave_approval->leave_applications->reference_number }}">
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
                                                    <a href="{{ route('employee_leave_rejection',$leave_approval->leave_application_reference) }}" class="btn btn-danger">Reject</a>
                                                    <a href="{{ route('employee_leave_approval',$leave_approval->leave_application_reference) }}" class="btn btn-success" id="submit_button2">Approve</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- leave details Modal --}}
                                <!-- update details Modal -->
                                    <div class="modal fade" id="updatedetailsModal{{ $leave_approval->leave_applications->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('update_leaveapplication',['leave_application_rn'=>$leave_approval->leave_applications->reference_number]) }}" id="form_submit" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="container-fluid text-start">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                                    <h2></h2>
                                                                </div>
                                                                <div class="col-lg-8 col-md-12 col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="employee">
                                                                                <h2 class="">Update Leave Details</h2>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="employee">
                                                                                <h6 class="">Reference Number</h6>
                                                                            </label>
                                                                            <h4>{{ $leave_approval->leave_applications->reference_number }}</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="employee">
                                                                                <h6 class="">Employee</h6>
                                                                            </label>
                                                                            <input type="text" class="form-control text-start" value="{{ optional($leave_approval->leave_applications->employees->users)->first_name }} {{ optional($leave_approval->leave_applications->employees->users)->last_name }} {{ optional($leave_approval->leave_applications->employees->users->suffixes)->suffix_title }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col">
                                                                            <label class="" for="leavetype">
                                                                                <h6 class="">Leave Type</h6>
                                                                            </label>
                                                                            <input type="text" class="form-control text-start" value="{{ optional($leave_approval->leave_applications->leavetypes)->leave_type_title }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-6">
                                                                            <label for="startdate">
                                                                                <h6>Start date</h6>
                                                                            </label>
                                                                            <input type="datetime-local" class="form-control" id="startdate" name="startdate" placeholder="" value="{{ $leave_approval->leave_applications->start_date }}">
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="enddate">
                                                                                <h6>End date</h6>
                                                                            </label>
                                                                            <input type="datetime-local" class="form-control" id="enddate" name="enddate" placeholder="" value="{{ $leave_approval->leave_applications->end_date }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col">
                                                                            @if (!empty($leave_approval->leave_applications->attachment))
                                                                                <a target="_blank" href="{{ asset('storage/images/'.$leave_approval->leave_applications->attachment) }}">View Attachment</a>
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
                                                                            @foreach ($leave_application_notes as $leave_application_note)
                                                                                @if ($leave_application_note->leave_application_reference == $leave_approval->leave_applications->reference_number)
                                                                                    <textarea class="form-control" disabled>{{ $leave_application_note->reason_note }}</textarea>
                                                                                    @if ($leave_application_note->employee_id != null)
                                                                                        <p> - {{ optional(optional($leave_application_note->employees)->users)->first_name }} {{ optional(optional($leave_application_note->employees)->users)->last_name }} ( {{ optional($leave_application_note->employees->employee_positions->positions)->position_title }} ) at {{ $leave_application_note->created_at }}</p>
                                                                                    @endif
                                                                                    
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col">
                                                                            <button class="btn btn-sm btn-primary" id="addNoteButton" type="button" data-bs-toggle="collapse" data-bs-target="#addNote" aria-expanded="false" aria-controls="addNote">
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
                                                                            @if ($leave_approval->leave_applications->status_id == 'sta-1001')
                                                                                <p class="bg-secondary text-light ps-3">{{ $leave_approval->leave_applications->statuses->status_title }}</p>
                                                                            @elseif ($leave_approval->leave_applications->status_id == 'sta-1002')
                                                                                <p class="bg-success text-light ps-3">{{ $leave_approval->leave_applications->statuses->status_title }}</p>
                                                                            @elseif ($leave_approval->leave_applications->status_id == 'sta-1003')
                                                                                <p class="bg-success text-light ps-3">{{ $leave_approval->leave_applications->statuses->status_title }}</p>
                                                                            @elseif ($leave_approval->leave_applications->status_id == 'sta-1004')
                                                                                <p class="bg-danger text-light ps-3">{{ $leave_approval->leave_applications->statuses->status_title }}</p>
                                                                            @elseif ($leave_approval->leave_applications->status_id == 'sta-1005')
                                                                                <p class="bg-danger text-light ps-3">{{ $leave_approval->leave_applications->statuses->status_title }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit1" class="btn btn-success" data-bs-dismiss="modal" onclick="onClickLinkSubmit()">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                {{-- update leave details Modal --}}
                            @endforeach
                        @else
                            <tr>
                                <div class="row align-items-center justify-content-center mt-5">
                                    <div class="col text-center">
                                        <h2>No leave application found!</h2>
                                    </div>
                                </div>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection