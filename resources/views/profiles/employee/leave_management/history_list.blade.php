@extends('profiles.employee.leave_management.history')
@section('list_view_active','bg-selected-warning')
@section('sub-content')

<div class="row">
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
                                        <p class="bg-secondary text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                    @elseif ($leave_application->status_id == 'sta-1002')
                                        <p class="bg-success text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                    @elseif ($leave_application->status_id == 'sta-1003')
                                        <p class="bg-secondary text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                    @elseif ($leave_application->status_id == 'sta-1004')
                                        <p class="bg-danger text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                    @elseif ($leave_application->status_id == 'sta-1005')
                                        <p class="bg-warning text-dark ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                                    @endif
                                </td>
                                <td class="d-flex gap-2 pb-3">
                                    <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">View Details</button>
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
                                                                    @if($leave_application->status_id == 'sta-1001')
                                                                        @foreach ($leave_approvals as $leave_approval)
                                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                                @if ($leave_approval->status_id == 'sta-1001')
                                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif ($leave_application->status_id == 'sta-1002')
                                                                        @foreach ($leave_approvals as $leave_approval)
                                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                                @if ($leave_approval->status_id == 'sta-1001')
                                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif($leave_application->status_id == 'sta-1003')
                                                                        @foreach ($leave_approvals as $leave_approval)
                                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                                @if ($leave_approval->status_id == 'sta-1001')
                                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif($leave_application->status_id == 'sta-1004')
                                                                        @foreach ($leave_approvals as $leave_approval)
                                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                                @if ($leave_approval->status_id == 'sta-1001')
                                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                                @elseif ($leave_approval->status_id == 'sta-1004')
                                                                                    <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif($leave_application->status_id == 'sta-1005')
                                                                        @foreach ($leave_approvals as $leave_approval)
                                                                            @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                                @if ($leave_approval->status_id == 'sta-1001')
                                                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                                @elseif ($leave_approval->status_id == 'sta-1004')
                                                                                    <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                                @elseif ($leave_approval->status_id == 'sta-1005')
                                                                                    <p class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('(M d, Y h:i:sa)')}}</p>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            {{-- <div class="row">
                                                                <div class="col">
                                                                    <label class="" for="update">
                                                                        @if ($leave_application->status_id == 'sta-1001')
                                                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updatedetailsModal{{ $leave_application->reference_number }}">
                                                                                Update Application
                                                                            </button>
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-primary text-center">View in Detailed</a>
                                                <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- leave details Modal --}}
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

@endsection
