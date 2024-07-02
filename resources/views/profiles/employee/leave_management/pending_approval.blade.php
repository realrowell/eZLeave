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
    <div class="container-fluid">
        <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch " >
                <a href="{{ route('employee_dashboard') }}" class="text-dark">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Dashboard</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" >
                <a href="{{ route('employee_profile') }}" class="text-dark">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Profile</h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning"  >
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
</div>

<div class="container-fluid d-print-none " id="profile_body" >
    <div class="row">
        <h5>Leave Menu</h5>
    </div>
    <div class="container-fluid">
        <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch bg-selected-primary" >
                <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-light">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Pending Approval</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" >
                <a href="{{ route('profile_leave_management_pending_availment_grid') }}" class="text-dark">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Pending Availment</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch" >
                <a href="{{ route('profile_leave_management_history_grid') }}" class="text-dark">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>History</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch ms-5" >
                <a href="{{ route('profile_leave_management_for_approval_grid') }}" class="text-dark">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>For Approval</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch">
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
</div>

<div class="container-fluid d-print-none " id="profile_body" >
    <div class="row">
        <div class="col">
            <div class="container-fluid bg-light shadow mb-5">
                <div class="row pt-4 pb-3">
                    <div class="col-12 col-lg-6 text-start mt-2">
                        <form action="{{ route('leave_details.search') }}" method="GET" onsubmit="onFormSubmit()" id="form_to_submit">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm rounded-0" placeholder="*Input Reference Number here" name="reference_number" id="reference_number" size="100" oninput="searchBtnEnable()">
                                <button type="submit" class="btn btn-sm btn-secondary rounded-0 disabled" id="search_btn">
                                    <i class='bx bx-search'></i>
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-lg-6 text-end mt-2">
                        <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 @yield('grid_view_active')">
                            <i class='fs-6 bx bxs-grid-alt' ></i>
                            Grid View
                        </a>
                        <a href="{{ route('profile_leave_management_pending_approval_list') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 @yield('list_view_active')">
                            <i class='fs-6 bx bx-list-ul' ></i>
                            List View
                        </a>
                        <a href="#AddAccount" class="ms-1 me-1 custom-primary-button rounded-0 p-2"  data-bs-toggle="modal" data-bs-target="#ApplyLeaveModal">
                            <i class='bx bx-calendar-plus' ></i>
                            Apply New
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @yield('sub-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Apply leave Modal -->
<div class="modal fade bg-static" id="ApplyLeaveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('create_employee_leaveapplication') }}" method="POST" enctype="multipart/form-data" id="form_submit" onsubmit="onClickApplyLeave()">
                @csrf
                @method('POST')
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">File a Leave Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onApply"></button>
                </div> --}}
                <div class="modal-body" id="form_container_onApply">
                    {{-- <div class="row">
                        <div class="col text-center">
                            <svg width="80px" height="80px" viewBox="-2.4 -2.4 28.80 28.80">
                                {{ svg('tabler-calendar-time') }}
                            </svg>
                        </div>
                    </div> --}}
                    <div class="row pt-3">
                        <div class="col-9">
                            <h5 class="modal-title" id="staticBackdropLabel">File a Leave Application</h5>
                        </div>
                        <div class="col-3 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onApply"></button>
                        </div>
                    </div>
                    <div class="container-fluid text-start">
                        <div class="row">
                            <div class="col">
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="leavetype">
                                            <h6 class="">*Leave Type</h6>
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
                                            <h6>*Start date</h6>
                                        </label>
                                        <input type="date" class="form-control" id="datetime_startdate" name="startdate" placeholder="" required onchange="showLeaveDuration()" novalidate>
                                        <span class="invalid-feedback" id="error_startdate"></span>
                                        <span class="valid-feedback" >looks good!</span>
                                    </div>
                                    <div class="col-6">
                                        <label for="enddate">
                                            <h6>*End date</h6>
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
                                        <label for="duration">Duration (days)</label>
                                        <a class="m-2 fs-6" data-bs-toggle="tooltip" data-bs-placement="right" title="*If the date range includes a weekend, it will not be count after creating the application.">
                                            <i class='bx bx-info-circle text-primary'></i>
                                        </a>
                                        <input type="text" name="duration" placeholder="" id="duration_input" class="form-control" disabled/>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="attachment">
                                            <h6 class="">Attachment (optional)</h6>
                                        </label>
                                        <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="reason">
                                            <h6 class="">Reason / Note (optional)</h6>
                                        </label>
                                        <textarea class="form-control" id="reason" name="reason" rows="5" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="form_submit" style="opacity: 1">
                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal" id="btn_close_onApply">Cancel</button>
                    <button id="btn_apply" type="submit" class="btn btn-success rounded-0" >
                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_apply">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        Create Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <script>
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
</script> --}}
{{-- End Apply leave Modal --}}

@endsection
