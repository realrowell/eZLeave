@extends('profiles.employee.leave_management.pending_availment')
@section('grid_view_active','bg-selected-warning')
@section('sub-content')

<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @if ($leave_applications->isNotEmpty())
        @foreach ($leave_applications as $leave_application)
            <div class="col-lg-3 col-md-6 col-sm-10">
                <div class="card w-100 p-2 shadow">
                    <div class="card-body">
                        <h4 class="card-title text-center">{{ $leave_application->leavetypes->leave_type_title }}</h4>
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
                                <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                                                <p> - {{ optional($leave_application_note->users)->first_name }} {{ optional($leave_application_note->users)->last_name }} at {{ $leave_application_note->created_at }}</p>
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
                                                    @if ($leave_application->status_id == 'sta-1002')
                                                        @foreach ($leave_approvals as $leave_approval)
                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                @if ($leave_approval->status_id == 'sta-1001')
                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
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
                                @if ($leave_application->status_id == 'sta-1002')
                                    <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-primary text-center">View in Detailed</a>
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
