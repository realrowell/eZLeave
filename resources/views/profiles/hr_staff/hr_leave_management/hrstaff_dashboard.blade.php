@extends('profiles.hr_staff.hrstaff_dashboard_layout')
@section('title','HR Dashboard')
@section('menu_hr_dashboard','bg-selected-warning text-light')
@section('menu_leave_credits','text-dark')
@section('menu_leave_management','text-dark')
@section('menu_leave_types','text-dark')
@section('sidebar_dashboard_active','active')
@section('sub-content')

<div class="row">
    <div class="col mt-2">
        <div class="row">
            <div class="col">
                <h3>HR Staff Dashboard</h3>
            </div>
            <div class="col">
                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                          <li><a class="dropdown-item" href="{{ route('hrstaff_fy_dashboard',['fiscal_year'=>$fiscal_year->id]) }}">{{ $fiscal_year->fiscal_year_title }}</a></li>
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>
<div class="row gap-3">
    <div class="container-fluid">
        <div class="row gap-3">
            <div class="col-md p-3 bg-light shadow">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col"><h5>Overview</h5></div>
                        <div class="col d-flex justify-content-end ">
                            <a href="{{ route('hrstaff_leave_management') }}" class="btn-sm btn-secondary">see all</a>
                        </div>
                    </div>
                    <div class="container-fluid mb-4">
                        <div class="row align-items-center text-center g-2 mt-3">
                            <a href="{{ route('hrstaff_leave_pending_approval') }}" class="col-md text-dark">
                            <span id="approval_numbers" class="col">{{ $pending_leaves_count }}</span>
                                <div class="row">
                                <span class="col">Pending Approval</span>
                                </div>
                            </a>
                            <a href="{{ route('hrstaff_leave_approved') }}" class="col-md text-dark">
                            <span id="approval_numbers" class="col">{{ $approved_leaves_count }}</span>
                                <div class="row">
                                <span class="col">Approved</span>
                                </div>
                            </a>
                            <a href="{{ route('hrstaff_leave_pending_availment') }}" class="col-md text-dark">
                                <span id="approval_numbers" class="col">{{ $pending_availment_count }}</span>
                                <div class="row">
                                    <span class="col">Pending Availment</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md p-3 bg-light shadow">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col"><h5>Recent Activities</h5></div>
                            <div class="col d-flex justify-content-end ">
                                {{-- <a href="{{ route('hrstaff_leave_management') }}" class="btn-sm btn-primary">see all</a> --}}
                            </div>
                        </div>
                        <div class="container-fluid mt-3 mb-3">
                            @forelse ($notifications as $notification)
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-action mt-1">
                                        <div class="row">
                                            <div class="col">
                                                {{ $notification->title }}
                                            </div>
                                            <div class="col text-end">
                                                {{ timestamp_leadtime($notification->created_at) }}
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col">
                                                {{ $notification->author_id }}
                                                {{ $notification->employee_id }}
                                            </div>
                                        </div> --}}
                                    </li>
                                </ul>
                            @empty
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-action mt-1">
                                        <div class="row">
                                            <div class="col text-center">
                                                No Recent Activities
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Employee Management Table --}}
    <div class="row bg-light p-3 m-1 shadow">
        <div class="row">
            <div class="col">
                <h5>Employee Leave Credits Overview</h5>
            </div>
            <div class="col text-end">
                <a href="{{ route('hrstaff_leave_credits') }}" class="btn-sm btn-secondary">See All</a>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper">
                <table class="table table-sm table-bordered table-hover bg-light">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Sub-department</th>
                            <th>Department</th>
                            <th>Leave Type</th>
                            <th>Leave Credits</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee_leavecredits as $employee_leavecredit)
                        <tr>
                            <td>
                                {{ optional($employee_leavecredit->employees->users)->first_name }}
                                {{ optional($employee_leavecredit->employees->users)->middle_name }}
                                {{ optional($employee_leavecredit->employees->users)->last_name }}
                                {{ optional($employee_leavecredit->employees->users->suffixes)->suffix_title }}
                            </td>
                            <td>{{ optional(optional($employee_leavecredit->employees->employee_positions)->positions)->position_description }}</td>
                            <td>{{ optional(optional(optional($employee_leavecredit->employees->employee_positions)->positions)->subdepartments)->sub_department_title }}</td>
                            <td>{{ $employee_leavecredit->employees->employee_positions?->positions?->subdepartments?->departments?->department_title }}</td>
                            <td>{{ optional($employee_leavecredit->leavetypes)->leave_type_title }}</td>
                            <td>{{ $employee_leavecredit->leave_days_credit }}</td>
                            {{-- <td class="d-flex gap-2">
                                <a href="#" class="btn-sm btn-primary">Update</a>
                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END Employee Management Table --}}
    {{-- Leave application Table --}}
    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="z-index: 1060; display: none;">
        <span class="visually-hidden" >Loading...</span>
    </div>
    <div class="row bg-light p-3 m-1 shadow" id='form_submit'>
        <div class="row">
            <div class="col">
                <h5>Leave Management Overview</h5>
            </div>
            <div class="col text-end">
                <a href="{{ route('hrstaff_leave_management') }}" class="btn-sm btn-secondary">See All</a>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper">
                <table class="table table-sm table-bordered table-hover bg-light">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Reference Number</th>
                            <th>Full Name</th>
                            <th>Reports to</th>
                            <th>Leave Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Leave Credits</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leave_applications as $leave_application)

                        <tr>
                            <td>{{ $leave_application->reference_number }}</td>
                            <td>
                                {{ optional($leave_application->employees->users)->first_name }}
                                {{ optional($leave_application->employees->users)->middle_name }}
                                {{ optional($leave_application->employees->users)->last_name }}
                                {{ optional($leave_application->employees->users->suffixes)->suffix_title }}
                            </td>
                            <td>
                                @if (!empty($leave_application->employees->employee_positions->reports_tos->users))
                                    {{ optional($leave_application->employees->employee_positions->reports_tos)->first_name }}
                                    {{ optional($leave_application->employees->employee_positions->reports_tos->users)->middle_name }}
                                    {{ optional($leave_application->employees->employee_positions->reports_tos->users)->last_name }}
                                @else
                                    Not Available
                                @endif
                            </td>
                            <td>{{ optional($leave_application->leavetypes)->leave_type_title }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave_application->start_date)->format('M d, Y') }} - {{ $leave_application->start_of_date_parts->day_part_description }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave_application->end_date)->format('M d, Y') }} - {{ $leave_application->end_of_date_parts->day_part_description }}</td>
                            <td>{{ $leave_application->duration }}</td>
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
                        </tr>
                        @empty
                            <tr>
                                <td class="justify-content-center text-center align-items-center">NOT AVAILABLE</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- End Leave application Table --}}
</div>
@endsection
