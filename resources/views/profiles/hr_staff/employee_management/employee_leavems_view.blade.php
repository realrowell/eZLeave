@extends('profiles.hr_staff.employee_management.employees')
@section('tab_options_display','d-none')
@section('submenu_all','text-dark')
@section('submenu_regular','text-dark')
@section('submenu_proba','text-dark')
@section('sub-content')

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 border border-start-0 border-top-0 border-bottom-0" >
        <div class="row">
            <div class="col text-center p-5">
                <div class="row justify-content-center align-items-start">
                    <div class="profile-photo-box align-items-start pt-3 pb-4">
                        @if ($profile_photo == null)
                            <img class="profile-photo" src="/img/dummy_profile.jpg" alt="profile photo">
                        @else
                            <img class="profile-photo" src="{{ asset('storage/images/profile_photos/'.$profile_photo->profile_photo) }}" alt="profile photo">
                        @endif
                    </div>
                </div>
                <h4 class="text-dark">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h4>
                <div class="text-light">
                    @if ($user->status_id == 'sta-2001')
                        <p class="card-desc rounded-pill badge bg-success">{{ optional($user->statuses)->status_title }}</p>
                    @elseif ($user->status_id == 'sta-2002')
                        <p class="card-desc rounded-pill badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                    @elseif ($user->status_id == 'sta-2003')
                        <p class="card-desc rounded-pill badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                    @elseif ($user->status_id == 'sta-2004')
                        <p class="card-desc rounded-pill badge bg-danger">{{ optional($user->statuses)->status_title }}</p>
                    @elseif ($user->status_id == 'sta-2002')
                        <p class="card-desc rounded-pill badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 ps-5 pe-5 pb-5">
        <div class="row ">
            <div class="col">
                <a href="{{ route('user_profile',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 ps-3 pe-3 custom-primary-button">
                    Profile
                </a>
                <a href="{{ route('user_profile_leave',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 ps-3 pe-3 custom-primary-button bg-selected-warning">
                    Leave MS
                </a>
                <div class="btn-group me-1 ">
                    <button class="btn btn-secondary btn-sm dropdown-toggle ms-1 me-1 ps-3 pe-3 rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <li>
                            <a class="dropdown-item" href="{{ route('hrstaff_fy_leave_credits',['fiscal_year'=>$fiscal_year->id]) }}">{{ $fiscal_year->fiscal_year_title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col text-end align-items-end">
                <div class="btn-group me-1"  role="group">
                    <a href="#" class="btn btn-sm btn-outline-primary ps-3 pe-3 ">Export PDF</a>
                    <a href="#" class="btn btn-sm btn-primary ps-3 pe-3">Export CSV</a>
                </div>
            </div>
        </div>

        {{-- LIST PROFILE --}}
        <div class="row">
            <div class="row mt-4 d-grid gap-1 mx-auto justify-content-center text-center">
                <div class="col">
                    <h3>Leave Monitoring</h3>
                </div>
                <div class="col">
                    <h3>{{ \Carbon\Carbon::now()->format('M d, Y') }}</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="row mt-2 mb-2" >
                    <div class="col-12">
                        <h6 class="profile-title">Full Name</h6>
                        <h6 class="profile-title-value">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6 class="profile-title">Position</h6>
                        <h6 class="profile-title-value">{{ optional(optional($user->employees->employee_positions)->positions)->position_description }}</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="profile-title">Sub-department</h6>
                        <h6 class="profile-title-value">{{ optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->sub_department_title }}</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="profile-title">Department</h6>
                        <h6 class="profile-title-value">{{ optional(optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6 class="profile-title">Date Hired</h6>
                        <h6 class="profile-title-value">{{ \Carbon\Carbon::parse(optional($user->employees)->date_hired)->format('M d, Y') }}</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="profile-title">Length of Service</h6>
                        <h6 class="profile-title-value">
                            @if ($length_of_service > 1.9)
                                {{ $length_of_service }} years
                            @else
                                {{ $length_of_service }} year
                            @endif
                        </h6>
                    </div>
                    <div class="col-4">
                        <h6 class="profile-title">Employment Status</h6>
                        <h6 class="profile-title-value">{{ $user->employees->employment_statuses->employment_status_title }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h6 class="profile-title">Reports to</h6>
                        <h6 class="profile-title-value">{{ $reports_to }}</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="profile-title">Second superior</h6>
                        <h6 class="profile-title-value">{{ $second_reports_to }}</h6>
                    </div>
                </div>
            </div>

            <div class=" mt-3 row">
                <hr class="hr" />
            </div>

            <div class="mt-3" id="CollapseMenu">
                <div class="row">
                    <div class="col d-flex gap-3">
                        <button class="btn btn-sm btn-primary rounded-0 ps-3 pe-3" type="button" data-bs-toggle="collapse" data-bs-target="#LeaveCollapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
                            Leave Credit Monitoring
                        </button>
                        <button class="btn btn-sm btn-primary rounded-0 ps-3 pe-3" type="button" data-bs-toggle="collapse" data-bs-target="#LogsCollapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
                            Logs
                        </button>
                        <button class="btn btn-sm btn-primary rounded-0 ps-3 pe-3" type="button" data-bs-toggle="collapse" data-bs-target="#HistoryCollapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
                            History
                        </button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        {{-- Leave Applications Collapse --}}
                            <div class="collapse show multi-collapse" id="LeaveCollapse" data-bs-parent="#CollapseMenu">
                                <div class="row mt-3 d-grid ">
                                    <div class="col">
                                        <h4>Leave Credit Monitoring</h4>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    @foreach ($employee_leavecredits as $employee_leavecredit)
                                        <div class="row mt-1 d-grid ">
                                            <div class="col">
                                                <h5><i class='bx bx-chevron-right' ></i>  {{ $employee_leavecredit->leavetypes->leave_type_title }}</h5>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="table-wrapper">
                                                <table id="" class="table table-hover table-sm table-bordered bg-light">
                                                    <thead role="rowgroup">
                                                        <tr class="bg-primary text-light border-light" style="font-size: 0.9rem">
                                                            <th>FROM</th>
                                                            <th>TO</th>
                                                            <th>DAYS</th>
                                                            <th>BALANCE</th>
                                                            <th>NOTE</th>
                                                            <th>CREATED</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($employee_leavecredit_logs as $employee_leavecredit_log)
                                                            <tr role="rowgroup">
                                                                @if (optional($employee_leavecredit_log->employee_leave_credits)->leave_type_id == $employee_leavecredit->leave_type_id)
                                                                    @foreach ($employee_leave_applications as $employee_leave_application)
                                                                        @if (optional($employee_leavecredit_log->leave_application_rn)!=null)
                                                                            @if ($employee_leavecredit_log->leave_application_rn == $employee_leave_application->reference_number)
                                                                                <td class=" text-break" style="width: 15%">
                                                                                    {{ \Carbon\Carbon::parse(optional($employee_leavecredit_log->leave_applications)->start_date)->format('M d, Y') }} - {{ optional(optional($employee_leavecredit_log->leave_applications)->start_of_date_parts)->day_part_title }}
                                                                                </td>
                                                                                <td class=" text-break" style="width: 15%">
                                                                                    {{ \Carbon\Carbon::parse(optional($employee_leavecredit_log->leave_applications)->end_date)->format('M d, Y') }} - {{ optional(optional($employee_leavecredit_log->leave_applications)->end_of_date_parts)->day_part_title }}
                                                                                </td>
                                                                                <td class=" text-break" style="width: 10%">{{ $employee_leavecredit_log->leave_days_credit }}</td>
                                                                                <td class=" text-break" style="width: 10%">{{ $employee_leavecredit_log->employee_leave_credits->leave_days_credit }}</td>
                                                                                <td class=" text-break" style="width: 35%">{{ $employee_leavecredit_log->reason_note }}</td>
                                                                                <td class=" text-break" style="width: 15%">{{ optional($employee_leavecredit_log->leave_applications)->created_at }}</td>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        {{-- End Leave Applications Collapse --}}
                        {{-- Logs Collapse --}}
                            <div class="collapse multi-collapse" id="LogsCollapse" data-bs-parent="#CollapseMenu">
                                <div class="row mt-3 d-grid ">
                                    <div class="col">
                                        <h4>Leave Credits Log</h4>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    @foreach ($employee_leavecredits as $employee_leavecredit)
                                        <div class="row mt-1 d-grid ">
                                            <div class="col">
                                                <h5><i class='bx bx-chevron-right' ></i>  {{ $employee_leavecredit->leavetypes->leave_type_title }}</h5>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="table-wrapper">
                                                <table id="" class="table table-hover table-sm table-bordered bg-light">
                                                    <thead role="rowgroup">
                                                        <tr class="bg-primary text-light border-light" style="font-size: 0.9rem">
                                                            <th>Leave Type</th>
                                                            <th>Credits</th>
                                                            <th>Adjustment</th>
                                                            <th>Note</th>
                                                            <th>Created at</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($employee_leavecredit_logs as $employee_leavecredit_log)
                                                            <tr role="rowgroup">
                                                                @if (optional($employee_leavecredit_log->employee_leave_credits)->leave_type_id == $employee_leavecredit->leave_type_id)
                                                                    <td class="col-2 text-break">{{ $employee_leavecredit_log->employee_leave_credits->leavetypes->leave_type_title }}</td>
                                                                    <td class="col-1 text-break">{{ $employee_leavecredit_log->employee_leave_credits->leave_days_credit }}</td>
                                                                    <td class="col-1 text-break">{{ $employee_leavecredit_log->leave_days_credit }}</td>
                                                                    <td class="col-4 text-break">{{ $employee_leavecredit_log->reason_note }}</td>
                                                                    <td class="col-2 text-break">{{ $employee_leavecredit_log->created_at }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row mt-3">
                                    <hr class="hr" />
                                </div>

                                <div class="row mt-4 d-grid ">
                                    <div class="col">
                                        <h4>Leave Applcations Log</h4>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="table-responsive">
                                        <div class="table-wrapper">
                                            <table id="" class="table table-hover table-sm table-bordered bg-light">
                                                <thead role="rowgroup">
                                                    <tr class="bg-primary text-light border-light" style="font-size: 0.9rem">
                                                        <th>Reference #</th>
                                                        <th>Leave Type</th>
                                                        <th>Start date</th>
                                                        <th>End date</th>
                                                        <th>Duration</th>
                                                        <th>Attachment</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    @foreach ($employee_leave_applications as $employee_leave_application)
                                                        <tr role="rowgroup card-body">
                                                            <td class="text-break text-dark"><a class="custom-bg-primary-hover text-light-hover" href="{{ route('hr_leave_details_page',['leave_application_rn'=>$employee_leave_application->reference_number]) }}" target="_blank">{{ $employee_leave_application->reference_number }}</a> </td>
                                                            <td class="text-break">{{ $employee_leave_application->leavetypes->leave_type_title }}</td>
                                                            <td class="text-break">{{ \Carbon\Carbon::parse($employee_leave_application->start_date)->format('M d, Y') }} - {{ $employee_leave_application->start_of_date_parts->day_part_title }}</td>
                                                            <td class="text-break">{{ \Carbon\Carbon::parse($employee_leave_application->end_date)->format('M d, Y') }} - {{ $employee_leave_application->end_of_date_parts->day_part_title }}</td>
                                                            <td class="text-break">{{ $employee_leave_application->duration }}</td>
                                                            <td class="text-break">
                                                                @if (!empty($employee_leave_application->attachment))
                                                                    <a target="_blank" href="{{ asset('storage/images/'.$employee_leave_application->attachment) }}">View Attachment</a>
                                                                @else
                                                                    <label for="">No Attachment</label>
                                                                @endif
                                                            </td>
                                                            <td class="text-break">
                                                                @if ($employee_leave_application->status_id == 'sta-1001')
                                                                    <span class="badge bg-secondary rounded-pill">{{ $employee_leave_application->statuses->status_title }}</span>
                                                                @elseif ($employee_leave_application->status_id == 'sta-1002')
                                                                    <span class="badge bg-success rounded-pill">{{ $employee_leave_application->statuses->status_title }}</span>
                                                                @elseif ($employee_leave_application->status_id == 'sta-1003')
                                                                    <span class="badge bg-secondary rounded-pill">{{ $employee_leave_application->statuses->status_title }}</span>
                                                                @elseif ($employee_leave_application->status_id == 'sta-1004')
                                                                    <span class="badge bg-danger rounded-pill">{{ $employee_leave_application->statuses->status_title }}</span>
                                                                @elseif ($employee_leave_application->status_id == 'sta-1005')
                                                                    <span class="badge text-dark bg-warning rounded-pill">{{ $employee_leave_application->statuses->status_title }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- End Logs Collapse --}}
                        {{-- History Collapse --}}
                            <div class="collapse multi-collapse" id="HistoryCollapse" data-bs-parent="#CollapseMenu">
                                <div class="row mt-3 d-grid ">
                                    <div class="col">
                                        <h4>Leave Credit History</h4>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    {{-- @foreach ($employee_leavecredit_histories as $employee_leavecredit)
                                        @foreach ($fiscal_years as $fiscal_year)
                                            @if ($employee_leavecredit->fiscal_year_id == $fiscal_year->id)
                                                <div class="row mt-1 d-grid ">
                                                    <div class="col">
                                                        <h5><i class='bx bx-chevron-right' ></i>  {{ $employee_leavecredit->fiscal_years->fiscal_year_title }}</h5>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach --}}
                                    <div class="table-responsive">
                                        <div class="table-wrapper">
                                            <table id="" class="table table-hover table-sm table-bordered bg-light">
                                                <thead role="rowgroup">
                                                    <tr class="bg-primary text-light border-light" style="font-size: 0.9rem">
                                                        <th>Year</th>
                                                        <th>Leave Type</th>
                                                        <th>Credits Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($employee_leavecredit_histories as $employee_leavecredit_history)
                                                        <tr>
                                                            <td>{{ $employee_leavecredit_history->fiscal_years->fiscal_year_title }}</td>
                                                            <td>{{ $employee_leavecredit_history->leavetypes->leave_type_title }}</td>
                                                            <td>{{ $employee_leavecredit_history->leave_days_credit }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- End History Collapse --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- END LIST --}}

    </div>
</div>

@endsection
