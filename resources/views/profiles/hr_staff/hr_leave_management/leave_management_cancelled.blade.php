@extends('profiles.hr_staff.hr_leave_management.hrstaff_leave_management')
@section('sub_menu_pending_approval','text-dark')
@section('sub_menu_approved','text-dark')
@section('sub_menu_pending_availment','text-dark')
@section('sub_menu_cancelled','bg-selected-primary text-light')
@section('sub_menu_reject','text-dark')
@section('sub_menu_all','text-dark')
@section('sub-sub-content')
{{-- Leave application Table --}}
<div class="row bg-light p-3 m-1">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h5>Leave Management / Cancelled</h5>
                </div>
                <div class="col">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Fiscal Year:
                            @if (Request()->fiscal_year == null)
                                {{ $current_fiscal_year->fiscal_year_title }}
                            @else
                                @foreach ($fiscal_years as $fiscal_year)
                                    @if ( $fiscal_year->id == Request()->fiscal_year)
                                        {{ $fiscal_year->fiscal_year_title }}
                                    @endif
                                @endforeach
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($fiscal_years as $fiscal_year)
                                <li><a class="dropdown-item" href="{{ route('hrstaff_fy_leave_management',['fiscal_year'=>$fiscal_year->id]) }}">{{ $fiscal_year->fiscal_year_title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <div class="row mt-2" id="form_submit">
        <div class="table-wrapper">
            <table class="table table-bordered table-hover bg-light">
                <thead class="bg-success text-light border-light">
                    <tr>
                        <th>Reference Number</th>
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Duration (days)</th>
                        <th>Filed at</th>
                        <th>Approver</th>
                        <th>Second Approver</th>
                        <th>Status</th>
                        <th>Actions</th>
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
                            <td>{{ optional($leave_application->leavetypes)->leave_type_title }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} - {{ $leave_application->start_of_date_parts->day_part_title }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} - {{ $leave_application->end_of_date_parts->day_part_title }}</td>
                            <td>{{ $leave_application->duration }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave_application->created_at)->format('M d, Y; h:i a') }}</td>
                            <td id="table_reports_to" class="text-wrap">
                                @if (!empty($leave_application->approver_id))
                                    {{ optional($leave_application->approvers->users)->first_name }}
                                    {{ optional($leave_application->approvers->users)->middle_name }}
                                    {{ optional($leave_application->approvers->users)->last_name }}
                                    {{ optional($leave_application->approvers->users->suffixes)->suffix_title }}
                                @else
                                    Not Available
                                @endif
                            </td>
                            <td id="table_second_reports_to" class="text-wrap">
                                @if (!empty($leave_application->second_approver_id))
                                    {{ optional($leave_application->second_approvers->users)->first_name }}
                                    {{ optional($leave_application->second_approvers->users)->middle_name }}
                                    {{ optional($leave_application->second_approvers->users)->last_name }}
                                    {{ optional($leave_application->second_approvers->users->suffixes)->suffix_title }}
                                @else
                                    Not Available
                                @endif
                            </td>
                            <td>
                                @if ($leave_application->status_id == 'sta-1001')
                                    <span class="badge bg-secondary rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                                @elseif ($leave_application->status_id == 'sta-1002')
                                    <span class="badge bg-success rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                                @elseif ($leave_application->status_id == 'sta-1003')
                                    <span class="badge bg-secondary rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                                @elseif ($leave_application->status_id == 'sta-1004')
                                    <span class="badge bg-danger rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                                @elseif ($leave_application->status_id == 'sta-1005')
                                    <span class="badge text-dark bg-warning rounded-pill">{{ $leave_application->statuses->status_title }}</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2 pb-3">
                                @if ( $leave_application->status_id == 'sta-1005')
                                    <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded' ></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#" class="dropdown-item bg-primary text-light pb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_application->reference_number }}">
                                                <i class='bx bx-align-middle me-2 pt-1' ></i>View Details
                                            </a>
                                        </li>
                                    </ul>
                                @endif
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
                                                <div class="col-lg-2 col-md-12 col-sm-12 bg-pattern-1 text-light text-center justify-content-center align-items-center">
                                                    <h2></h2>
                                                </div>
                                                <div class="col-lg-10 col-md-12 col-sm-12">
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
                                                                <h6>Employee</h6>
                                                            </label>
                                                            <h4>
                                                                {{ $leave_application->employees->users->first_name }}
                                                                {{ $leave_application->employees->users->last_name }}
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
                                        <a href="{{ route('hr_leave_details_page',['leave_application_rn'=>$leave_application->reference_number]) }}" class="btn btn-primary text-center">View in Detailed</a>
                                        <button type="button" class="btn btn-light border-primary" data-bs-dismiss="modal">Close</button>
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
