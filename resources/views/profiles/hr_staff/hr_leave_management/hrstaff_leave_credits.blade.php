@extends('profiles.hr_staff.hrstaff_dashboard_layout')
@section('menu_hr_dashboard','text-dark')
@section('menu_leave_credits','bg-selected-warning text-light')
@section('menu_leave_management','text-dark')
@section('menu_leave_types','text-dark')
@section('sub-content')

<div class="spinner-border text-primary" id="loading_spinner_approve" role="status" style="display: none;">
    <span class="visually-hidden" >Loading...</span>
</div>
<div class="row">
    <div class="col mt-2">
      <h3>Leave Management HR Staff / Leave Credits</h3>
    </div> 
</div>
<div class="row gap-3" id="table_container">
    <div class="row">
        <div class="col text-end align-items-end">
            <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#AddLeaveCreditModal">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Give Leave Credits
            </a>
        </div>
    </div>

    <!-- Add Leave Credits Modal -->
    <div class="modal fade" id="AddLeaveCreditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    
    {{-- Employee Management Table --}}
    <div class="row bg-light p-3 m-1">
        <div class="row">
            <div class="col">
                <h5>Employee Leave Credits</h5>
            </div>
            <div class="col text-end">
                <form action="{{ route('hrstaff_leave_credits_search') }}" class="input-group">
                    {{-- @csrf --}}
                    <input class="form-control " type="text" name="search_input" id="myInput" onkeyup="searchBtnEnable()" onsubmit="submitButtonDisabled()" placeholder="Search here">
                    <button type="submit" id="search_btn" class="btn btn-primary disabled" onclick="onClickLinkSubmit()">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper">
                <table class="table table-striped table-hover bg-light">
                    <thead>
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
                            <td>{{ optional($employee_leavecredit->employees->employee_positions->positions)->position_title }}</td>
                            <td>{{ optional($employee_leavecredit->employees->employee_positions->subdepartments)->sub_department_title }}</td>
                            <td>{{ optional($employee_leavecredit->employees->employee_positions->subdepartments->departments)->department_title }}</td>
                            <td>{{ optional($employee_leavecredit->leavetypes)->leave_type_title }}</td>
                            <td>{{ $employee_leavecredit->leave_days_credit }}</td>
                            <td class="d-flex gap-2">
                                <a href="#" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateLeaveCreditModal{{ $employee_leavecredit->id }}">Update</a>
                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
                            </td>
                        </tr>

                        {{-- Update Leave Credits Modal --}}
                            <div class="modal fade" id="UpdateLeaveCreditModal{{ $employee_leavecredit->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('update_leavecredits',['leavecredit_id'=>$employee_leavecredit->id]) }}" method="PATCH" onsubmit="onClickApprove()">
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
                                                                    <input type="text" class="form-control" disabled value="{{ optional($employee_leavecredit->employees->users)->first_name }} {{ optional($employee_leavecredit->employees->users)->middle_name }} {{ optional($employee_leavecredit->employees->users)->last_name }} {{ optional($employee_leavecredit->employees->users->suffixes)->suffix_title }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col">
                                                                    <label class="" for="leavetype">
                                                                        <h6 class="">Leave Type</h6>
                                                                    </label>
                                                                    <input type="text" class="form-control" disabled value="{{ optional($employee_leavecredit->leavetypes)->leave_type_title }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="credits">
                                                                        <h6>Credits (Days)</h6>
                                                                    </label>
                                                                    <input type="number" step="0.5" class="form-control" id="credits" name="credits" value="{{ $employee_leavecredit->leave_days_credit }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                                                <button id="submit_button1" type="submit" class="btn btn-success" onclick="onClickApprove()" data-bs-dismiss="modal">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {{-- END Update Leave Credits Modal --}}
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        <div class="mt-5">
                            <ul class="pagination justify-content-center align-items-center">
                                {!! $employee_leavecredits->links('pagination::bootstrap-5') !!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END Employee Management Table --}}
</div>
@endsection