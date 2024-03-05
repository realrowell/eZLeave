@extends('profiles.employee.leave_management.history')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @if ($leave_applications->isNotEmpty())
        @foreach ($leave_applications as $leave_application)
            <div class="col-lg-3 col-md-6 col-sm-10">
                <div class="card w-100 p-2 shadow">
                    <div class="card-body">
                        <h4 class="card-title text-center">{{ $leave_application->leavetypes->leave_type_title }}</h4>
                        <p class="card-text" id="approval_p">Reference #:</p>
                        <h5> {{ $leave_application->reference_number }}</h5>
                        <p class="card-text" id="approval_p">Approver:</p>
                        <h5> 
                            {{ optional($leave_application->employees->employee_positions->reports_tos->users)->first_name }} 
                            {{ optional($leave_application->employees->employee_positions->reports_tos->users)->last_name }} 
                            {{ optional($leave_application->employees->employee_positions->reports_tos->users->suffixes)->suffix_title }}
                        </h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" id="approval_p">Start date:</p>
                                <h5> {{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y')}}</h5>
                            </div>
                            <div class="col">
                                <p class="card-text" id="approval_p">End date:</p>
                                <h5> {{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y')}}</h5>
                            </div>
                        </div>
                        <p class="card-text" id="approval_p">Date of application:</p>
                        <h5> {{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y - h:i:sa')}}</h5>
                        <p class="card-text" id="approval_p">Status:</p>
                        @if ($leave_application->status_id == 'sta-1001')
                            <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                        @elseif ($leave_application->status_id == 'sta-1002')
                            <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                        @elseif ($leave_application->status_id == 'sta-1003')
                            <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                        @elseif ($leave_application->status_id == 'sta-1004')
                            <p class="bg-danger text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                        @elseif ($leave_application->status_id == 'sta-1005')
                            <p class="bg-warning text-dark ps-3">{{ $leave_application->statuses->status_title }}</p>
                        @endif
                        <div class="d-grid gap-2">
                            <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- leave details Modal -->
                <div class="modal fade" id="detailsModal{{ $leave_application->reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                    <h4>{{ $leave_application->reference_number }}</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="employee">
                                                        <h6 class="">Approver</h6>
                                                    </label>
                                                    <h4>
                                                        {{ optional($leave_application->employees->employee_positions->reports_tos->users)->first_name }} 
                                                        {{ optional($leave_application->employees->employee_positions->reports_tos->users)->last_name }} 
                                                        {{ optional($leave_application->employees->employee_positions->reports_tos->users->suffixes)->suffix_title }}
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label class="" for="leavetype">
                                                        <h6 class="">Leave Type</h6>
                                                    </label>
                                                    <h4>{{ optional($leave_application->leavetypes)->leave_type_title }}</h4>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <label for="startdate">
                                                        <h6>Start date</h6>
                                                    </label>
                                                    <h4>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }}</h4>
                                                </div>
                                                <div class="col-6">
                                                    <label for="enddate">
                                                        <h6>End date</h6>
                                                    </label>
                                                    <h4>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }}</h4>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="enddate">
                                                        <h6>Date filed</h6>
                                                    </label>
                                                    <h4>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y h:i:s A') }}</h4>
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
                                                    @if ($leave_application->status_id == 'sta-1001')
                                                        <p class="bg-secondary text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                    @elseif ($leave_application->status_id == 'sta-1002')
                                                        @foreach ($leave_approvals as $leave_approval)
                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                @if ($leave_approval->status_id == 'sta-1002')
                                                                    <p id="approval_p" class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                    <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                @elseif($leave_approval->status_id == 'sta-1005')
                                                                    <p id="approval_p" class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                    <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @elseif ($leave_application->status_id == 'sta-1003')
                                                        <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                    @elseif ($leave_application->status_id == 'sta-1004')
                                                        @foreach ($leave_approvals as $leave_approval)
                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                @if ($leave_approval->status_id == 'sta-1004')
                                                                    <p id="approval_p" class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                    <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @elseif ($leave_application->status_id == 'sta-1005')
                                                        @foreach ($leave_approvals as $leave_approval)
                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                @if ($leave_approval->status_id == 'sta-1002')
                                                                    <p id="approval_p" class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                    <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                @elseif($leave_approval->status_id == 'sta-1005')
                                                                    <p id="approval_p" class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                    <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
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
                                    <form action="{{ route('employee_leave_cancellation', $leave_application->reference_number) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" onclick="onClickLinkSubmit()">Cancel Request</button>
                                    </form>
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                @elseif ($leave_application->status_id == 'sta-1002')
                                    <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                @elseif ($leave_application->status_id == 'sta-1003')
                                    <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                @elseif ($leave_application->status_id == 'sta-1004')
                                    <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                @elseif ($leave_application->status_id == 'sta-1005')
                                    <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            {{-- leave details Modal --}}
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