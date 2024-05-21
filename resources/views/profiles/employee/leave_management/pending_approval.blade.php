@extends('includes.employee_profile_layout')
@section('title','Leave Management')
@section('sidebar_leave_management_active','active')
@section('sidebar_leave_management_active_custom','active_custom')
@section('custom_active_leave_icon','var(--accent-color)')
@section('custom_active_pending_approval','var(--accent-color)')
@section('content')

<div class="container-fluid d-print-none" id="profile_body" >
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch " style="min-height: 1rem" >
            <a href="{{ route('employee_dashboard') }}" class="text-dark">
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

        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid d-print-none " id="profile_body" >
    <div class="row">
        <h5>Leave Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch bg-selected-primary" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Pending Approval</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_pending_availment_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Pending Availment</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_history_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>History</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch ms-5" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_for_approval_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>For Approval</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile.leave_management.approval_history.list') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Approval History</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid d-print-none" id="profile_body">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <div class="row">
                <div class="col">
                    <h3>Leave Management</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="col p-2 custom-primary-button custom-rounded-top @yield('grid_view_active')">
                <i data-toggle="tooltip" title="grid view" class="grid-view-icon">
                    <svg stroke="white" class="mb-2" width="25px" height="25px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3.5 3.5H10.5V10.5H3.5V3.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M3.5 13.5H10.5V20.5H3.5V13.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M13.5 3.5H20.5V10.5H13.5V3.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M13.5 13.5H20.5V20.5H13.5V13.5Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </i>
                Grid View
            </a>
            <a href="{{ route('profile_leave_management_pending_approval_list') }}" class="col p-2 ms-2 custom-primary-button custom-rounded-top @yield('list_view_active')">
                <i data-toggle="tooltip" title="list view" class="list-view-icon">
                    <svg fill="white" class="" width="25px" height="25px" viewBox="-2.1 -2.1 25.20 25.20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>list [#1497]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1"  fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -322.000000)" > <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M124.575,174 C123.7056,174 123,174.672 123,175.5 C123,176.328 123.7056,177 124.575,177 C125.4444,177 126.15,176.328 126.15,175.5 C126.15,174.672 125.4444,174 124.575,174 L124.575,174 Z M128.25,177 L144,177 L144,175 L128.25,175 L128.25,177 Z M124.575,168 C123.7056,168 123,168.672 123,169.5 C123,170.328 123.7056,171 124.575,171 C125.4444,171 126.15,170.328 126.15,169.5 C126.15,168.672 125.4444,168 124.575,168 L124.575,168 Z M128.25,171 L144,171 L144,169 L128.25,169 L128.25,171 Z M124.575,162 C123.7056,162 123,162.672 123,163.5 C123,164.328 123.7056,165 124.575,165 C125.4444,165 126.15,164.328 126.15,163.5 C126.15,162.672 125.4444,162 124.575,162 L124.575,162 Z M128.25,165 L144,165 L144,163 L128.25,163 L128.25,165 Z" id="list-[#1497]"> </path> </g> </g> </g> </g></svg>
                </i>
                List View
            </a>
            <a href="#AddAccount" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Apply New
            </a>
        </div>
    </div>
</div>

<!-- Apply leave Modal -->
<div class="modal fade" id="ApplyLeaveModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none;">
                <span class="visually-hidden" >Loading...</span>
            </div>
            <form action="{{ route('create_employee_leaveapplication') }}" method="POST" onsubmit="onClickLeaveApplySpinnerShow()" enctype="multipart/form-data" id="form_submit">
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
                                                @if ($leave_credit->expiration != null)
                                                    @if ($leave_credit->expiration >= now())
                                                        <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }} - {{ $leave_credit->leave_days_credit }}</option>
                                                    @endif
                                                @endif
                                                @if ($leave_credit->expiration == null)
                                                    @if ($leave_credit->leavetypes->cut_off_date != null)
                                                        @if ($leave_credit->leavetypes->cut_off_date >= now())
                                                            <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }} - {{ $leave_credit->leave_days_credit }}</option>
                                                        @endif
                                                    @endif
                                                    @if ($leave_credit->leavetypes->cut_off_date == null)
                                                        <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }} - {{ $leave_credit->leave_days_credit }}</option>
                                                    @endif
                                                @endif
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
                    <button id="submit_button1" type="submit" class="btn btn-success" >Apply Leave</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#department').on('change',function(){
            let id = $(this).val();
            $('#subdepartment').empty();
            $('#subdepartment').addClass('placeholder');
            $('#position').addClass('placeholder');
            $('#spinner_subdepartment').removeClass('d-none');
            $('#spinner_position').removeClass('d-none');
            $('#subdepartment').append('<option value="0" disabled selected >Processing...</option>');
            $('#position').append('<option value="0" disabled selected>Processing...</option>');
            $.ajax({
                type: 'GET',
                url: '/addAccount/getSubdepartment/'+id,
                success: function (response){
                    var response = JSON.parse(response);
                    $('#subdepartment').empty();
                    $('#position').empty();
                    $('#subdepartment').removeClass('placeholder');
                    $('#position').removeClass('placeholder');
                    $('#spinner_subdepartment').addClass('d-none');
                    $('#spinner_position').addClass('d-none');
                    $('#subdepartment').append('<option value="0" disabled selected>*Select Sub-department</option>');
                    $('#position').append('<option value="0" disabled selected>*Select Sub-department</option>');
                    response.forEach(element => {
                        $('#subdepartment').append(`<option value="${element['id']}">${element['sub_department_title']}</option>`);
                    });
                }
            });
        });
        $('#subdepartment').on('change',function(){
            let id = $(this).val();
            $('#position').empty();
            $('#position').append('<option value="0" disabled selected>Processing...</option>');
            $('#position').addClass('placeholder');
            $('#spinner_position').removeClass('d-none');
            $.ajax({
                type: 'GET',
                url: '/addAccount/getPosition/'+id,
                success: function (response){
                    var response = JSON.parse(response);
                    $('#position').empty();
                    $('#position').removeClass('placeholder');
                    $('#spinner_position').addClass('d-none');
                    $('#position').append('<option value="0" disabled selected>*Select Position</option>');
                    response.forEach(element => {
                        $('#position').append(`<option value="${element['id']}">${element['position_description']}</option>`);
                    });
                }
            });
        });
    });
</script>
{{-- End Apply leave Modal --}}
<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none;">
        <span class="visually-hidden" >Loading...</span>
    </div>
    <div class="sub-content" id="form_submit_1" style="opacity: 1">
        <div class="container-fluid">
            <div class="row">
                @yield('sub-content')
            </div>
        </div>
    </div>
</div>

@endsection
