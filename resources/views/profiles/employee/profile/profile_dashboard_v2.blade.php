@extends('includes.employee_profile_layout')
@section('title','Dashboard')
@section('sidebar_dashboard_active','active')
@section('profile_bar_display', 'none')
@section('content')

<div class="container-fluid" id="profile_body">
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
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
    <div class="row gap-3 ">
        <div class="col-md p-3 bg-light shadow-sm border border-warning border-5 border-bottom-0 border-end-0 border-top-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h5>Leave Management</h5>
                    </div>
                    <div class="col text-end">
                        <a href="#AddAccount" class="ms-1 me-1 btn-sm btn btn-primary"  data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                            <i class='bx bx-calendar-plus' ></i>
                            Create Leave App
                        </a>
                        <x-employee.leave-app-modal>
                        </x-employee.leave-app-modal>
                        <a href="{{ route('profile_leave_management_history_grid') }}" class="btn-sm btn btn-secondary">see all</a>
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
                        <h5>Leave Credits Balance</h5>
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
    @if (auth()->user()->employees?->employee_positions?->positions?->is_hod == true || auth()->user()->employees?->employee_positions?->positions?->position_level_id == 'psl-1001')
        <div class="row mt-3 ">
            <div class="col">
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
                                @forelse ($leave_applications as $leave_application)
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
                                @empty
                                    <tr>
                                        <td>
                                            <x-errors.no-leave-app-found>
                                            </x-errors.no-leave-app-found>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-lg-3 col-md-4 col-sm-12 col-12 nopadding">
            <div class="p-3 bg-light shadow-sm border border-warning border-5 border-bottom-0 border-end-0 border-top-0">
                <div class="container-fluid text-center">
                    <div class="row">
                        <div class="col">
                            @if (auth()->user()->profile_photos == null)
                                <img class="profile-photo-sm" src="{{ asset('img/dummy_profile.jpg') }}" alt="profile photo">
                            @else
                                <img class="profile-photo-sm" src="{{ asset('storage/images/profile_photos/'.auth()->user()->profile_photos->profile_photo) }}" alt="profile photo">
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <p class="fs-5 mb-0">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ optional(Auth::user()->suffixes)->suffix_title }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col">
                            <p>
                                <b>Organization</b>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <b>Position</b>
                        </div>
                        <div class="col">
                            {{ optional(optional(Auth::user()->employees->employee_positions)->positions)->position_description }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <b>Department</b>
                        </div>
                        <div class="col">
                            {{ optional(optional(optional(optional(Auth::user()->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <b>Area Assignment</b>
                        </div>
                        <div class="col">
                            {{ Auth::user()->employees->employee_positions?->area_of_assignments?->location_address ?? 'No data available' }}
                        </div>
                    </div>

                    <div class="container-fluid mt-4 mb-5 text-center">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('employee_profile') }}" class="text-success"><u>My Profile</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 ps-lg-3 nopadding">
            <div class="row">
                <div class="col">
                    <div class="bg-light shadow-sm p-3 border border-warning border-5 border-bottom-0 border-end-0 border-top-0">
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
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="bg-light shadow-sm p-3 border border-warning border-5 border-bottom-0 border-end-0 border-top-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <h5>Frequently Asked Questions</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    How to Apply or Create a New Leave Application
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <ol>
                                                        <li>
                                                            Go to the Leave Management tab, then the Pending Approval sub-menu.
                                                        </li>
                                                        <li>
                                                            Click “Apply New” or the leave card.
                                                        </li>
                                                        <li>
                                                            Fill out the form, including the leave type, dates, reason, and any attachments.
                                                        </li>
                                                        <li>
                                                            Check the box for Morning or Afternoon for half-day leave, or leave it unchecked for a full day.
                                                        </li>
                                                        <li>
                                                            Click “Create Application” to submit your leave request.
                                                        </li>
                                                    </ol>
                                                    <div class="container-fluid">
                                                        <div class="row text-center">
                                                            <div class="col">
                                                                <a href="{{ route('article.faq.1') }}">View more details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    How to Approve a Leave Application
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <ol>
                                                        <li>
                                                            On the Dashboard page, click “For your Approval” or go to the Leave Management tab and select the "For Approval" sub-menu.
                                                        </li>
                                                        <li>
                                                            Click “Approve” on the selected leave application.
                                                        </li>
                                                        <li>
                                                            Confirm the approval.
                                                        </li>
                                                    </ol>
                                                    <div class="container-fluid">
                                                        <div class="row text-center">
                                                            <div class="col">
                                                                <a href="{{ route('article.faq.2') }}">View more details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
