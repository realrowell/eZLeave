@extends('profiles.hr_staff.hrstaff_dashboard_layout')
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
    <div class="row">
        <div class="col text-end align-items-end">
            <div class="col text-end align-items-end">
                <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#AddLeaveCreditModal">
                    <i data-toggle="tooltip" title="list view" class="add-icon" >
                        <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                    </i>
                    Give Leave Credits
                </a>
                <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                    <i data-toggle="tooltip" title="list view" class="add-icon" >
                        <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                    </i>
                    Apply Leave
                </a>
            </div>
        </div>
    </div>

    <!-- Add Leave Credits Modal -->
        <div class="modal fade" id="AddLeaveCreditModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form action="{{ route('create_leavecredits') }}" method="POST" onsubmit="onClickApprove()">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Give Leave Credit</h5>
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
                                                    <h6 class="">Employee</h6>
                                                </label>
                                                <select class="form-select" id="employee" name="employee" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ optional($employee->users)->last_name }}, {{ optional($employee->users)->first_name }} {{ optional($employee->users)->middle_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Leave Type</h6>
                                                </label>
                                                <select class="form-select" id="leavetype" name="leavetype" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($leavetypes as $leavetype)
                                                        <option value="{{ $leavetype->id }}">{{ $leavetype->leave_type_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="credits">
                                                    <h6>Credits (Days)</h6>
                                                </label>
                                                <input type="number" step="0.5" class="form-control" id="credits" name="credits" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Fiscal Year</h6>
                                                </label>
                                                <select class="form-select" id="fiscal_year" name="fiscal_year" required>
                                                    <option selected value="{{ $current_fiscal_year->id }}">{{ $current_fiscal_year->fiscal_year_title }}</option>
                                                    @foreach ($fiscal_years as $fiscal_year)
                                                        @if ($fiscal_year->id != $current_fiscal_year->id)
                                                            <option value="{{ $fiscal_year->id }}">{{ $fiscal_year->fiscal_year_title }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                {{-- <label for="credits">
                                                    <h6>Credits (Days)</h6>
                                                </label>
                                                <input type="number" step="0.5" class="form-control" id="credits" name="credits" placeholder="" required> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                            <button id="submit_button1" type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- End Add Leave Credits Modal --}}
    <!-- Apply leave Modal -->
    <div class="modal fade" id="ApplyLeaveModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('create_leaveapplication') }}" method="POST" onsubmit="submitButtonDisabled()" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Apply Leave</h5>
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
                                                <h6 class="">For Employee</h6>
                                            </label>
                                            <select class="form-select" id="employee" name="employee" required>
                                                <option selected disabled value=""></option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ optional($employee->users)->first_name }} {{ optional($employee->users)->middle_name }} {{ optional($employee->users)->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label class="" for="leavetype">
                                                <h6 class="">Leave Type</h6>
                                            </label>
                                            <select class="form-select" id="leavetype" name="leavetype" required>
                                                <option selected disabled value=""></option>
                                                @foreach ($leavetypes as $leavetype)
                                                    <option value="{{ $leavetype->id }}">{{ $leavetype->leave_type_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="startdate">
                                                <h6>Start date</h6>
                                            </label>
                                            <input type="datetime-local" class="form-control" id="startdate" name="startdate" placeholder="" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="enddate">
                                                <h6>End date</h6>
                                            </label>
                                            <input type="datetime-local" class="form-control" id="enddate" name="enddate" placeholder="" required onchange="showPartDay()">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col " id="datelabel" style="display: none;">
                                            <div class="form-check">
                                                <label for="partOfDay_check" class="form-check-label" >Half Day?</label>
                                                <input type="checkbox" class="form-check-input" id="partOfDay_check" name="partOfDay_check" value="0.5" onchange="showPartDay()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label for="">Duration (days)</label>
                                            <input type="text" name="duration" placeholder="" id="duration_input" class="form-control" disabled/>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label class="" for="attachment">
                                                <h6 class="">Attachment</h6>
                                            </label>
                                            <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label class="" for="reason">
                                                <h6 class="">Reason / Note</h6>
                                            </label>
                                            <textarea class="form-control" id="reason" name="reason" rows="5" cols="50"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Discard</button>
                        <button id="submit_button2" type="submit" class="btn btn-success">Apply Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Apply leave Modal --}}


    <div class="row gap-3">
        <div class="col-md p-3 bg-light shadow">
            <div class="row">
                <div class="row ">
                    <div class="col"><h5>Overview</h5></div>
                    <div class="col d-flex justify-content-end pe-4">
                        <a href="{{ route('hrstaff_leave_management') }}" class="btn-sm btn-primary">see all</a>
                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="row justify-content-center align-items-center text-center g-2 mt-3">
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
                        <a href="{{ route('hrstaff_leave_cancelled') }}" class="col-md text-dark">
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
                <h5>Recent Activities</h5>
            </div>
        </div>
    </div>
    {{-- Employee Management Table --}}
    <div class="row bg-light p-3 m-1 shadow">
        <div class="row">
            <div class="col">
                <h5>Employee Leave Credits</h5>
            </div>
            <div class="col text-end">
                <a href="{{ route('hrstaff_leave_credits') }}" class="btn-sm btn-primary">See All</a>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper">
                <table class="table table-bordered table-hover bg-light">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Sub-department</th>
                            <th>Department</th>
                            <th>Leave Type</th>
                            <th>Leave Credits</th>
                            <th>Actions</th>
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
                            <td>{{ optional(optional(optional($employee_leavecredit->employees->employee_positions)->subdepartments)->departments)->department_title }}</td>
                            <td>{{ optional($employee_leavecredit->leavetypes)->leave_type_title }}</td>
                            <td>{{ $employee_leavecredit->leave_days_credit }}</td>
                            <td class="d-flex gap-2">
                                <a href="#" class="btn-sm btn-primary">Update</a>
                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                            </td>
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
                <h5>Leave Management</h5>
            </div>
            <div class="col text-end">
                <a href="{{ route('hrstaff_leave_management') }}" class="btn-sm btn-primary">See All</a>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper">
                <table class="table table-bordered table-hover bg-light">
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
                                    <p class="bg-secondary text-light ps-3 pe-2">{{ $leave_application->statuses->status_title }}</p>
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
