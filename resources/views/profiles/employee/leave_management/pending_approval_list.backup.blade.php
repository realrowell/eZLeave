@extends('profiles.employee.leave_management.pending_approval')
@section('list_view_active','bg-selected-warning')
@section('sub-content')

<div class="row">
    <div>
        <div class="spinner-border text-primary" id="loading_spinner_approve" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>

            {{-- <div class="table-responsive" id="table_container">
            <ul class="list-group list-group-horizontal">
                <li class="col list-group-item"><b>Reference Number</b></li>
                <li class="col list-group-item"><b>Approver</b></li>
                <li class="col list-group-item"><b>Second Approver</b></li>
                <li class="col list-group-item"><b>Leave Type</b></li>
                <li class="col list-group-item"><b>Start date</b></li>
                <li class="col list-group-item"><b>End date</b></li>
                <li class="col list-group-item"><b>Duration (days)</b></li>
                <li class="col list-group-item"><b>Filed at</b></li>
            </ul>
            @forelse ($partial_leave_applications as $partial_leave_application)
                <ul class="list-group list-group-horizontal">
                    <li class="col list-group-item">{{ $partial_leave_application->reference_number }}</li>
                    <li class="col list-group-item">
                        {{ optional($partial_leave_application->approvers->users)->first_name }}
                        {{ optional($partial_leave_application->approvers->users)->middle_name }}
                        {{ optional($partial_leave_application->approvers->users)->last_name }}
                    </li>
                    <li class="col list-group-item">
                        {{ optional($partial_leave_application->second_approvers->users)->first_name }}
                        {{ optional($partial_leave_application->second_approvers->users)->middle_name }}
                        {{ optional($partial_leave_application->second_approvers->users)->last_name }}
                    </li>
                    <li class="col list-group-item">{{ optional($partial_leave_application->leavetypes)->leave_type_title }}</li>
                    <li class="col list-group-item">{{ \Carbon\Carbon::parse($partial_leave_application->start_date)->format('M d, Y') }} - {{ $partial_leave_application->start_of_date_parts->day_part_title }}</li>
                    <li class="col list-group-item">{{ \Carbon\Carbon::parse($partial_leave_application->end_date)->format('M d, Y') }} - {{ $partial_leave_application->end_of_date_parts->day_part_title }}</li>
                    <li class="col list-group-item">{{ $partial_leave_application->duration }}</li>
                    <li class="col list-group-item">{{ \Carbon\Carbon::parse($partial_leave_application->created_at)->format('M d, Y; h:i a') }}</li>
                </ul>
            @empty

            @endforelse --}}

            <div class="table-wrapper">
                <table class="table table-bordered table-hover bg-light">
                    <h5>Partially Approved</h5>
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Reference Number</th>
                            <th>Approver</th>
                            <th>Second Approver</th>
                            <th>Leave Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Duration (days)</th>
                            <th>Filed at</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($partial_leave_applications as $partial_leave_application)
                            <tr>
                                <td>{{ $partial_leave_application->reference_number }}</td>
                                <td id="table_reports_to">
                                    @if (!empty($partial_leave_application->approvers))
                                        {{ optional($partial_leave_application->approvers->users)->first_name }}
                                        {{ optional($partial_leave_application->approvers->users)->middle_name }}
                                        {{ optional($partial_leave_application->approvers->users)->last_name }}
                                    @else
                                        Not Available
                                    @endif
                                </td>
                                <td id="table_2nd_reports_to">
                                    @if (!empty($partial_leave_application->second_approvers))
                                        {{ optional($partial_leave_application->second_approvers->users)->first_name }}
                                        {{ optional($partial_leave_application->second_approvers->users)->middle_name }}
                                        {{ optional($partial_leave_application->second_approvers->users)->last_name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ optional($partial_leave_application->leavetypes)->leave_type_title }}</td>
                                <td>{{ \Carbon\Carbon::parse($partial_leave_application->start_date)->format('M d, Y') }} - {{ $partial_leave_application->start_of_date_parts->day_part_title }}</td>
                                <td>{{ \Carbon\Carbon::parse($partial_leave_application->end_date)->format('M d, Y') }} - {{ $partial_leave_application->end_of_date_parts->day_part_title }}</td>
                                <td>{{ $partial_leave_application->duration }}</td>
                                <td>{{ \Carbon\Carbon::parse($partial_leave_application->created_at)->format('M d, Y; h:i a') }}</td>
                                <td>
                                    @if ($partial_leave_application->status_id == 'sta-1001')
                                        <span class="badge bg-secondary">{{ $partial_leave_application->statuses->status_title }}</span>
                                    @elseif ($partial_leave_application->status_id == 'sta-1003')
                                        <span class="badge bg-secondary">{{ $partial_leave_application->statuses->status_title }}</span>
                                    @endif
                                </td>
                                <td class="d-flex gap-2 pb-3">
                                    <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $partial_leave_application->reference_number }}">View Details</button>
                                    {{-- <button class="btn btn-sm btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $partial_leave_application->reference_number }}">Cancel</button> --}}
                                </td>
                            </tr>
                            <!-- leave details Modal -->
                                <div class="modal fade" id="detailsModal{{ $partial_leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="modal-title">Leave Details</h5>
                                                        </div>
                                                        <div class="col text-end">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                            <h2></h2>
                                                        </div>
                                                        <div class="col-lg-9 col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="employee">
                                                                        <h6 class="">Reference Number</h6>
                                                                    </label>
                                                                    <h4>{{ $partial_leave_application->reference_number }}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="" for="leavetype">
                                                                        <h6 class="">Leave Type</h6>
                                                                    </label>
                                                                    <h4>{{ optional($partial_leave_application->leavetypes)->leave_type_title }}</h4>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="duration">
                                                                        <h6>Duration</h6>
                                                                    </label>
                                                                    <h4>{{ $partial_leave_application->duration }}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <label for="startdate">
                                                                        <h6>Start date</h6>
                                                                    </label>
                                                                    <h4>{{ \Carbon\Carbon::parse($partial_leave_application->start_date)->format('M d, Y') }} ({{ $partial_leave_application->start_of_date_parts->day_part_title }})</h4>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="enddate">
                                                                        <h6>End date</h6>
                                                                    </label>
                                                                    <h4>{{ \Carbon\Carbon::parse($partial_leave_application->end_date)->format('M d, Y') }} ({{ $partial_leave_application->end_of_date_parts->day_part_title }})</h4>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="enddate">
                                                                        <h6>Date filed</h6>
                                                                    </label>
                                                                    <h4>{{ \Carbon\Carbon::parse($partial_leave_application->created_at)->format('M d, Y h:i:s A') }}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div class="col">
                                                                    <label for="employee">
                                                                        <h6 class="">Approver</h6>
                                                                    </label>
                                                                    <h4>
                                                                        {{ optional($partial_leave_application->approvers->users)->first_name }}
                                                                        {{ optional($partial_leave_application->approvers->users)->last_name }}
                                                                        {{ optional($partial_leave_application->approvers->users->suffixes)->suffix_title }}
                                                                    </h4>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="employee">
                                                                        <h6 class="">Second Approver</h6>
                                                                    </label>
                                                                    <h4>
                                                                        @if ($partial_leave_application->second_approver_id == null)
                                                                            N/A
                                                                        @else
                                                                            {{ optional(($partial_leave_application->second_approvers)->users)->first_name }}
                                                                            {{ optional($partial_leave_application->second_approvers->users)->last_name }}
                                                                            {{ optional($partial_leave_application->second_approvers->users->suffixes)->suffix_title }}
                                                                        @endif
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    @if (!empty($partial_leave_application->attachment))
                                                                        <a target="_blank" href="{{ asset('storage/images/'.$partial_leave_application->attachment) }}">View Attachment</a>
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
                                                                        @if ($leave_application_note->leave_application_reference == $partial_leave_application->reference_number)
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
                                                                    @if ($partial_leave_application->status_id == 'sta-1001')
                                                                        @foreach ($leave_approvals as $leave_approval)
                                                                            @if ($leave_approval->leave_application_reference == $partial_leave_application->reference_number)
                                                                                <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif ($partial_leave_application->status_id == 'sta-1003')
                                                                        @foreach ($leave_approvals as $leave_approval)
                                                                            @if ($leave_approval->leave_application_reference == $partial_leave_application->reference_number)
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
                                                                        @if ($partial_leave_application->status_id == 'sta-1001' || $partial_leave_application->status_id == 'sta-1003')
                                                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNoteModal{{ $partial_leave_application->reference_number }}">
                                                                                Add Note
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
                                                @if ($partial_leave_application->status_id == 'sta-1001')
                                                    {{-- <button class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $partial_leave_application->reference_number }}">Cancel</button> --}}
                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                @elseif ($partial_leave_application->status_id == 'sta-1003')
                                                    {{-- <button class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $partial_leave_application->reference_number }}">Cancel</button> --}}
                                                    <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- leave details Modal --}}
                            <!-- add note Modal -->
                                <div class="modal fade" id="addNoteModal{{ $partial_leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('update_employee_leaveapplication',['leave_application_rn'=>$partial_leave_application->reference_number]) }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-body">
                                                    <div class="container-fluid text-start">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                                <h2></h2>
                                                            </div>
                                                            <div class="col-lg-9 col-md-12 col-sm-12">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="employee">
                                                                            <h6 class="">Reference Number</h6>
                                                                        </label>
                                                                        <h4>{{ $partial_leave_application->reference_number }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col">
                                                                        <label class="" for="leavetype">
                                                                            <h6 class="">Leave Type</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control text-start" value="{{ optional($partial_leave_application->leavetypes)->leave_type_title }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-6">
                                                                        <label for="startdate">
                                                                            <h6>Start date</h6>
                                                                        </label>
                                                                        <input type="date" class="form-control" id="datetime_startdate_update" name="startdate" placeholder="" value="{{ \Carbon\Carbon::parse($partial_leave_application->start_date)->format('Y-m-d') }}" disabled>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="enddate">
                                                                            <h6>End date</h6>
                                                                        </label>
                                                                        <input type="date" class="form-control" id="datetime_enddate_update" name="enddate" placeholder="" value="{{ \Carbon\Carbon::parse($partial_leave_application->end_date)->format('Y-m-d') }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label for="startdate">
                                                                            <h6>{{ $partial_leave_application->start_of_date_parts->day_part_description }}</h6>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="enddate">
                                                                            <h6>{{ $partial_leave_application->end_of_date_parts->day_part_description }}</h6>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="">Duration (days)</label>
                                                                        <input type="text" name="duration" placeholder="" id="duration_input_up" class="form-control" value="{{ $partial_leave_application->duration }}" disabled/>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col">
                                                                        <label for="employee">
                                                                            <h6 class="">Approver</h6>
                                                                        </label>
                                                                        <h5>
                                                                            {{ optional($partial_leave_application->approvers->users)->first_name }}
                                                                            {{ optional($partial_leave_application->approvers->users)->last_name }}
                                                                            {{ optional($partial_leave_application->approvers->users->suffixes)->suffix_title }}
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="employee">
                                                                            <h6 class="">Second Approver</h6>
                                                                        </label>
                                                                        <h5>
                                                                            @if ($partial_leave_application->second_approver_id == null)
                                                                                N/A
                                                                            @else
                                                                                {{ optional(($partial_leave_application->second_approvers)->users)->first_name }}
                                                                                {{ optional($partial_leave_application->second_approvers->users)->last_name }}
                                                                                {{ optional($partial_leave_application->second_approvers->users->suffixes)->suffix_title }}
                                                                            @endif
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col">
                                                                        @if (!empty($partial_leave_application->attachment))
                                                                            <a target="_blank" href="{{ asset('storage/images/'.$partial_leave_application->attachment) }}">View Attachment</a>
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
                                                                            @if ($leave_application_note->leave_application_reference == $partial_leave_application->reference_number)
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
                                                                        <textarea class="form-control" id="reason" name="reason" placeholder="add note"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col">
                                                                        <label class="" for="status">
                                                                            <h6 class="">Status</h6>
                                                                        </label>
                                                                        @if ($partial_leave_application->status_id == 'sta-1001')
                                                                            @foreach ($leave_approvals as $leave_approval)
                                                                                @if ($leave_approval->leave_application_reference == $partial_leave_application->reference_number)
                                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                                @endif
                                                                            @endforeach
                                                                        @elseif ($partial_leave_application->status_id == 'sta-1003')
                                                                            @foreach ($leave_approvals as $leave_approval)
                                                                                @if ($leave_approval->leave_application_reference == $partial_leave_application->reference_number)
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
                                                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onclick="onClickUpdateSubmit()">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            {{--  add note Modal --}}
                            <!-- cancel details Modal -->
                                {{-- <div class="modal fade" id="cancelleaveModal{{ $partial_leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('employee_leave_cancellation',$partial_leave_application->reference_number) }}" method="PUT" onsubmit="onClickApprove()">
                                                @csrf
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
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
                                                                <textarea class="form-control" id="reason" name="reason" rows="6" cols=50 maxlength=250 placeholder="add note" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-danger" type="submit" >Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- cancel details Modal --}}
                        @empty
                            <tr>
                                <td>
                                    <div class="row align-items-center justify-content-center mt-3">
                                        <div class="col text-center">
                                            <h2>No leave application available!</h2>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mt-2 mb-5">
                    <ul class="pagination justify-content-center align-items-center">
                        {!! $partial_leave_applications->links('pagination::bootstrap-5') !!}
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive" id="table_container">
            <div class="table-wrapper">
                <table class="table table-bordered table-hover bg-light">
                    <h5>Pending Approval</h5>
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Reference Number</th>
                            <th>Approver</th>
                            <th>Second Approver</th>
                            <th>Leave Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Duration (days)</th>
                            <th>Filed at</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($leave_applications->isNotEmpty())
                            @foreach ($leave_applications as $leave_application)
                                <tr>
                                    <td>{{ $leave_application->reference_number }}</td>
                                    <td id="table_reports_to">
                                        @if (!empty($leave_application->approvers))
                                            {{ optional($leave_application->approvers->users)->first_name }}
                                            {{ optional($leave_application->approvers->users)->middle_name }}
                                            {{ optional($leave_application->approvers->users)->last_name }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                    <td id="table_2nd_reports_to">
                                        @if (!empty($leave_application->second_approvers))
                                            {{ optional($leave_application->second_approvers->users)->first_name }}
                                            {{ optional($leave_application->second_approvers->users)->middle_name }}
                                            {{ optional($leave_application->second_approvers->users)->last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ optional($leave_application->leavetypes)->leave_type_title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} - {{ $leave_application->start_of_date_parts->day_part_title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} - {{ $leave_application->end_of_date_parts->day_part_title }}</td>
                                    <td>{{ $leave_application->duration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y; h:i a') }}</td>
                                    <td>
                                        @if ($leave_application->status_id == 'sta-1001')
                                            {{-- <p class="bg-secondary text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p> --}}
                                            <span class="badge bg-secondary">{{ $leave_application->statuses->status_title }}</span>
                                        @elseif ($leave_application->status_id == 'sta-1002')
                                            <p class="bg-success text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                        @elseif ($leave_application->status_id == 'sta-1003')
                                            <p class="bg-success text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                        @elseif ($leave_application->status_id == 'sta-1004')
                                            <p class="bg-danger text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                        @elseif ($leave_application->status_id == 'sta-1005')
                                            <p class="bg-warning text-dark ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-2 pb-3">
                                        <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
                                        <button class="btn btn-sm btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_application->reference_number }}">Cancel</button>
                                    </td>
                                </tr>
                                <!-- leave details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="modal-title">Leave Details</h5>
                                                            </div>
                                                            <div class="col text-end">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid text-start">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                                <h2></h2>
                                                            </div>
                                                            <div class="col-lg-9 col-md-12 col-sm-12">
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
                                                                        <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="duration">
                                                                            <h6>Duration</h6>
                                                                        </label>
                                                                        <h4>{{ $leave_application->duration }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label for="startdate">
                                                                            <h6>Start date</h6>
                                                                        </label>
                                                                        <h4>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} ({{ $leave_application->start_of_date_parts->day_part_title }})</h4>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="enddate">
                                                                            <h6>End date</h6>
                                                                        </label>
                                                                        <h4>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} ({{ $leave_application->end_of_date_parts->day_part_title }})</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="enddate">
                                                                            <h6>Date filed</h6>
                                                                        </label>
                                                                        <h4>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:i:s A') }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col">
                                                                        <label for="employee">
                                                                            <h6 class="">Approver</h6>
                                                                        </label>
                                                                        <h4>
                                                                            {{ optional($leave_application->approvers->users)->first_name }}
                                                                            {{ optional($leave_application->approvers->users)->last_name }}
                                                                            {{ optional($leave_application->approvers->users->suffixes)->suffix_title }}
                                                                        </h4>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="employee">
                                                                            <h6 class="">Second Approver</h6>
                                                                        </label>
                                                                        <h4>
                                                                            @if ($leave_application->second_approver_id == null)
                                                                                N/A
                                                                            @else
                                                                                {{ optional(($leave_application->second_approvers)->users)->first_name }}
                                                                                {{ optional($leave_application->second_approvers->users)->last_name }}
                                                                                {{ optional($leave_application->second_approvers->users->suffixes)->suffix_title }}
                                                                            @endif
                                                                        </h4>
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
                                                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updatedetailsModal{{ $leave_application->reference_number }}">
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
                                                        <button class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_application->reference_number }}">Cancel</button>
                                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                    @elseif ($leave_application->status_id == 'sta-1003')
                                                        <button class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_application->reference_number }}">Cancel</button>
                                                        <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- leave details Modal --}}
                                <!-- update details Modal -->
                                    <div class="modal fade" id="updatedetailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('update_employee_leaveapplication',['leave_application_rn'=>$leave_application->reference_number]) }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="container-fluid text-start">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                                    <h2></h2>
                                                                </div>
                                                                <div class="col-lg-9 col-md-12 col-sm-12">
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
                                                                            <h4>{{ $leave_application->reference_number }}</h4>
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
                                                                    <div class="row mt-2 text-end">
                                                                        <div class="col">
                                                                            <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-sm btn-primary">Update Date</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="">Duration (days)</label>
                                                                            <input type="text" name="duration" placeholder="" id="duration_input_up" class="form-control" value="{{ $leave_application->duration }}" disabled/>
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
                                                                                <a target="_blank" href="{{ asset('storage/images/'.$leave_application->attachment) }}">View Attachment</a>
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
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success"  onclick="onClickUpdateSubmit()">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                {{-- update leave details Modal --}}
                                <!-- cancel details Modal -->
                                    <div class="modal fade" id="cancelleaveModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('employee_leave_cancellation',$leave_application->reference_number) }}" method="PUT" onsubmit="onClickApprove()">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
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
                                                                    <textarea class="form-control" id="reason" name="reason" rows="6" cols=50 maxlength=250 placeholder="add note" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                        <button class="btn btn-danger" type="submit" >Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                {{-- cancel details Modal --}}
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <div class="row align-items-center justify-content-center mt-3">
                                        <div class="col text-center">
                                            <h2>No leave application available!</h2>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
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
