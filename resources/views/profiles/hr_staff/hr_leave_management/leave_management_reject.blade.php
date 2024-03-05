@extends('profiles.hr_staff.hr_leave_management.hrstaff_leave_management')
@section('sub_menu_pending_approval','text-dark')
@section('sub_menu_approved','text-dark')
@section('sub_menu_cancelled','text-dark')
@section('sub_menu_reject','bg-selected-primary text-light')
@section('sub_menu_all','text-dark')
@section('sub-sub-content')
{{-- Leave application Table --}}
<div class="row bg-light p-3 m-1">
    <div class="row">
        <div class="col">
            <h5>Leave Management / All</h5>
        </div>
    </div>
    <div class="row">
        <div class="table-wrapper">
            <table class="table table-striped table-hover bg-light">
                <thead>
                    <tr>
                        <tr>
                            <th>Reference Number</th>
                            <th>Full Name</th>
                            <th>Reports to</th>
                            <th>Leave Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Leave Credits</th>
                            <th>Rejected at</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leave_applications as $leave_application)
                    <tr>
                        <td>{{ $leave_application->reference_number }}</td>
                        <td>
                            {{ optional($leave_application->employees->users)->first_name }} 
                            {{ optional($leave_application->employees->users)->middle_name }} 
                            {{ optional($leave_application->employees->users)->last_name }} 
                            {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                        </td>
                        <td id="table_reports_to">
                            @if (!empty($leave_application->employees->employee_positions->reports_tos->users))
                                {{ optional($leave_application->employees->employee_positions->reports_tos)->first_name }} 
                                {{ optional($leave_application->employees->employee_positions->reports_tos->users)->middle_name }} 
                                {{ optional($leave_application->employees->employee_positions->reports_tos->users)->last_name }} 
                            @else
                                Not Available
                            @endif
                        </td>
                        <td>{{ optional($leave_application->leavetypes)->leave_type_title }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }}</td>
                        <td>{{ $leave_application->leave_days_credit }}</td>
                        <td>
                            @foreach ($leave_approvals as $leave_approval)
                                @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                    {{ \Carbon\Carbon::parse($leave_approval->created_at)->format('M d, Y - h:ia') }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <p class="bg-danger text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
                        </td>
                        <td class="d-flex gap-2 pb-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                View
                            </button>
                        </td>
                    </tr>
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
                                                            <h6 class="">Employee</h6>
                                                        </label>
                                                        <h4>
                                                            {{ optional($leave_application->employees->users)->first_name }} 
                                                            {{ optional($leave_application->employees->users)->middle_name }} 
                                                            {{ optional($leave_application->employees->users)->last_name }} 
                                                            {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                                                            <a target="_blank" href="{{ route('user_profile',$leave_application->employees->users->user_name) }}">
                                                                <i data-toggle="tooltip" title="search" class="search-icon" >
                                                                    <svg class="text-primary" width="30px" height="30px" viewBox="0 0 30 30">
                                                                        {{ svg('css-search') }}
                                                                    </svg>
                                                                </i>
                                                            </a>
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
                                                            <p id="approval_p" class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                            @foreach ($leave_approvals as $leave_approval)
                                                                @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                    <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
                                                                @endif
                                                            @endforeach
                                                        @elseif ($leave_application->status_id == 'sta-1003')
                                                            <p class="bg-success text-light ps-3">{{ $leave_application->statuses->status_title }}</p>
                                                        @elseif ($leave_application->status_id == 'sta-1004')
                                                            @foreach ($leave_approvals as $leave_approval)
                                                                @if ($leave_approval->leave_application_reference == $leave_application->reference_number)
                                                                    <p id="approval_p" class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }}</p>
                                                                    <p class="text-end"> - {{ optional(optional($leave_approval->employees)->users)->first_name }} {{ optional(optional($leave_approval->employees)->users)->last_name }} at {{ $leave_approval->created_at }}</p>
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
                                        <a href="{{ route('leave_application_rejection', $leave_application->reference_number) }}" class="btn btn-danger">
                                            Reject
                                        </a>
                                        <a href="{{ route('leave_application_approval', $leave_application->reference_number) }}" class="btn btn-success">
                                            Approve
                                        </a>
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
                    
                </tbody>
            </table>
            <div class="row">
                <div class="col">
                    <div class="mt-5">
                        <ul class="pagination justify-content-center align-items-center">
                            {!! $leave_applications->links('pagination::bootstrap-5') !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Leave application Table --}}
@endsection