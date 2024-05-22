@extends('includes.employee_profile_layout')
@section('title','Dashboard')
@section('sidebar_dashboard_active','active')
@section('content')

<div class="container-fluid" id="profile_body">
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
            <a href="{{ route('employee_dashboard') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('employee_profile') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Profile</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <div class="col mt-2">
            <h3>Dashboard</h3>
        </div>
    </div>
    <div class="row gap-3">
        <div class="col-md p-3 bg-light shadow-sm border border-warning border-5 border-bottom-0 border-end-0 border-top-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h5>Leave Management</h5>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('profile_leave_management_history_grid') }}" class="btn-sm btn btn-outline-primary">see all</a>
                    </div>
                </div>
                <div class="row text-center p-4">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="col-md text-dark">
                            <span id="approval_numbers" class="col">{{ $pending_leaves_count }}</span>
                            <div class="row">
                                <span class="col">Pending Approval</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="{{ route('profile_leave_management_pending_availment_grid') }}" class="col-md text-dark">
                            <span id="approval_numbers" class="col">{{ $approved_leaves_count }}</span>
                            <div class="row">
                                <span class="col">Upcoming Leaves</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="{{ route('profile_leave_management_for_approval_grid') }}" class="col-md text-dark">
                            <span id="approval_numbers" class="col">
                                {{ $for_approval_count }}
                            </span>
                            <div class="row position-relative">
                                <span class="col">For your Approval</span>
                                @if ( $for_approval_count != 0)
                                    <span class="position-absolute translate-middle " style="translate: 80% 0%;">
                                        <span class="badge rounded-pill bg-danger text-danger" style="font-size: 5px">.</span>
                                    </span>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md p-3 bg-light shadow-sm border border-warning border-5 border-bottom-0 border-end-0 border-top-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h5>Remaining Leave Credits</h5>
                    </div>
                </div>
                <div class="row text-center p-4">
                    @foreach ($leave_credits as $leave_credit)
                        @if ($leave_credit->expiration != null)
                            @if ($leave_credit->expiration >= now())
                                <div class="col">
                                    <span id="approval_numbers" class="col">{{ $leave_credit->leave_days_credit }}</span>
                                    <div class="row">
                                        <span class="col">{{ $leave_credit->leavetypes->leave_type_title }}</span>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if ($leave_credit->expiration == null)
                            @if ($leave_credit->leavetypes->cut_off_date != null)
                                @if ($leave_credit->leavetypes->cut_off_date >= now())
                                    <div class="col">
                                        <span id="approval_numbers" class="col">{{ $leave_credit->leave_days_credit }}</span>
                                        <div class="row">
                                            <span class="col">{{ $leave_credit->leavetypes->leave_type_title }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if ($leave_credit->leavetypes->cut_off_date == null)
                                <div class="col">
                                    <span id="approval_numbers" class="col">{{ $leave_credit->leave_days_credit }}</span>
                                    <div class="row">
                                        <span class="col">{{ $leave_credit->leavetypes->leave_type_title }}</span>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 bg-light shadow-sm p-3 border border-warning border-5 border-bottom-0 border-end-0 border-top-0" >
        <div class="col">
            <div class="row text-center align-items-center justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-12 text-start">
                    <h5>
                        Search Leave Request
                        <div class="spinner-border spinner-border-sm text-primary position-relative float-start" id="loading_spinner_1" role="status" style="display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h5>
                </div>
            </div>
            <div class="row text-center align-items-center justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <form action="{{ route('leave_details.search') }}" method="GET" onsubmit="onFormSubmit()" id="form_to_submit">
                    @csrf
                        <div class="input-group">
                            <span class="input-group-text bg-light ps-3 pe-3" id="basic-addon1"><i class='bx bx-search-alt' style="font-size: 1.4rem; margin-bottom: -1px"></i></span>
                            <input type="text" class="form-control form-control-sm" name="reference_number" id="reference_number" size="100" oninput="searchBtnEnable()">
                            <button type="submit" class="btn btn-primary ps-5 pe-5 disabled" id="search_btn" >Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row text-center align-items-center justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-12 text-start">
                    <h6>*input leave REFERENCE NUMBER here</h6>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->employees?->employee_positions?->positions?->is_hod == true || auth()->user()->employees?->employee_positions?->positions?->position_level_id == 'psl-1001')
        <div class="row mt-5 ">
            <div class="col">
                <div class="row ">
                    <h3>Employees on Leave</h3>
                </div>
                <div class="row p-4 border border-warning bg-light border-5 border-bottom-0 border-end-0 border-top-0 shadow">
                    <div class="table-wrapper">
                        <table id="data_table" class="table compact row-border table-sm table-hover bg-light">
                            {{-- <h5>Pending Approval</h5> --}}
                            <h5>Employees on Leave</h5>
                            <thead class="bg-success text-light border-light">
                                <tr>
                                    <th>Reference Number</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Duration (days)</th>
                                </tr>
                            </thead>
                                @foreach ($leave_applications as $leave_application)
                                    @if ($leave_application->employees?->employee_positions?->positions?->subdepartments?->department_id == auth()->user()->employees?->employee_positions?->positions?->subdepartments?->department_id)
                                        <tr>
                                            <td>
                                                {{ $leave_application->reference_number }}</td>
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
                                        </tr>
                                    @endif
                                    @if (auth()->user()->employees?->employee_positions?->positions?->position_level_id == 'psl-1001')
                                        @if ($leave_application->employees?->employee_positions?->reports_to_id == auth()->user()->employees->id || $leave_application->employees?->employee_positions?->second_superior_id == auth()->user()->employees->id)
                                            <tr>
                                                <td>
                                                    {{ $leave_application->reference_number }}
                                                </td>
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
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Apply leave Modal -->
        <div class="modal fade" id="ApplyLeaveModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none;">
                        <span class="visually-hidden" >Loading...</span>
                    </div>
                    <form action="{{ route('create_employee_leaveapplication') }}" method="POST" onsubmit="return submitButtonDisabled()" enctype="multipart/form-data" id="form_submit">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">File a Leave Application</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col text-center">
                                    <svg width="80px" height="80px" viewBox="-2.4 -2.4 28.80 28.80">
                                        {{ svg('tabler-calendar-time') }}
                                    </svg>
                                </div>
                            </div>
                            <div class="container-fluid text-start">
                                <div class="row">
                                    <div class="col">
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Leave Type</h6>
                                                </label>
                                                <select class="form-select" id="leavetype" name="leavetype" required>
                                                    <option selected disabled value=""></option>
                                                    @foreach ($leave_credits as $leave_credit)
                                                        <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <label for="startdate">
                                                    <h6>Start date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_startdate" name="startdate" placeholder="" required onchange="showLeaveDuration()">
                                            </div>
                                            <div class="col-6">
                                                <label for="enddate">
                                                    <h6>End date</h6>
                                                </label>
                                                <input type="date" class="form-control" id="datetime_enddate" name="enddate" placeholder="" required onchange="showLeaveDuration()">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            {{-- <div class="col " id="datelabel" style="display: none;">
                                                <div class="form-check">
                                                    <label for="partOfDay_check" class="form-check-label" >Half Day?</label>
                                                    <input type="checkbox" class="form-check-input" id="partOfDay_check" name="partOfDay_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div> --}}
                                            <div class="col" id="datelabel_start_am" style="display: none;">
                                                <div class="form-check">
                                                    <label for="start_am_check" class="form-check-label" >Morning</label>
                                                    <input type="checkbox" class="form-check-input" id="start_am_check" name="start_am_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_start_pm" style="display: none;">
                                                <div class="form-check">
                                                    <label for="start_pm_check" class="form-check-label" >Afternoon</label>
                                                    <input type="checkbox" class="form-check-input" id="start_pm_check" name="start_pm_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_end_am" style="display: none;">
                                                <div class="form-check">
                                                    <label for="end_am_check" class="form-check-label" >Morning</label>
                                                    <input type="checkbox" class="form-check-input" id="end_am_check" name="end_am_check" value="1" onchange="showLeaveDuration()">
                                                </div>
                                            </div>
                                            <div class="col " id="datelabel_end_pm" style="display: none;">
                                                <div class="form-check">
                                                    <label for="end_pm_check" class="form-check-label" >Afternoon</label>
                                                    <input type="checkbox" class="form-check-input" id="end_pm_check" name="end_pm_check" value="1" onchange="showLeaveDuration()">
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
                        <div class="modal-footer" id="form_submit" style="opacity: 1">
                            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal" >Discard</button>
                            <div class="spinner-border text-primary" id="loading_spinner1" role="status" style="display: none;">
                                <span class="visually-hidden" >Loading...</span>
                            </div>
                            <button id="submit_button1" type="submit" class="btn btn-success" onclick="onClickLeaveApplySpinnerShow()">Apply Leave</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- End Apply leave Modal --}}
</div>
@endsection
