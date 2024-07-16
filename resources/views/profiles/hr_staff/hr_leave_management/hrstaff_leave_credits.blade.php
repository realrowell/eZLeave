@extends('profiles.hr_staff.hrstaff_dashboard_layout')
@section('title','HR Leave Credits')
@section('menu_hr_dashboard','text-dark')
@section('menu_leave_credits','bg-selected-warning text-light')
@section('menu_leave_management','text-dark')
@section('menu_leave_types','text-dark')
@section('sub-content')

<div class="row mt-3 bg-light shadow" >
    {{-- <div class="row">
        <div class="col text-end align-items-end">
            <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#AddLeaveCreditModal">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Give Leave Credits
            </a>
        </div>
    </div> --}}

    <!-- Add Leave Credits Modal -->
        <div class="modal fade" id="AddLeaveCreditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
                    <form action="{{ route('create_leavecredits') }}" method="POST" onsubmit="onClickApplyForm()">
                        @csrf
                        {{-- <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Give Leave Credit</h5>
                            <button type="button" id="btn_modal_x_onApply" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> --}}
                        <div class="modal-body " id="form_container_onApply">
                            <div class="container-fluid text-start">
                                <div class="row">
                                    <div class="col">
                                        <div class="row pt-3 pb-2">
                                            <div class="col-9">
                                                <h5 class="modal-title" id="staticBackdropLabel">Give Leave Credit</h5>
                                            </div>
                                            <div class="col-3 text-end">
                                                <button type="button" id="btn_modal_x_onApply" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="employee">
                                                    <h6 class="">Employee</h6>
                                                </label>
                                                <select class=" js-select-employee js-states form-control form-control-lg" id="select-state" name="employee" placeholder="Search here" required style="width: 100%; margin: 200px">
                                                    <option selected disabled value=""></option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->employees->id }}">{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }}</option>
                                                    @endforeach
                                                </select>
                                                <script>
                                                    $(document).ready(function () {
                                                        $('.js-select-employee').select2({
                                                            placeholder: "select option",
                                                            selectOnClose: true,
                                                            width: 'resolve',
                                                            dropdownParent: $('#AddLeaveCreditModal')

                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Leave Type</h6>
                                                </label>
                                                <select class="form-select form-select-sm" id="leavetype" name="leavetype" required>
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
                                                <input type="number" step="0.1" class="form-control form-control-sm" id="credits" name="credits" placeholder="" onchange="" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label class="" for="leavetype">
                                                    <h6 class="">Fiscal Year</h6>
                                                </label>
                                                <select class="form-select form-select-sm" id="fiscal_year" name="fiscal_year" required>
                                                    <option selected value="{{ $current_fiscal_year->id }}">{{ $current_fiscal_year->fiscal_year_title }}</option>
                                                    @foreach ($fiscal_years as $fiscal_year)
                                                        @if ($fiscal_year->id != $current_fiscal_year->id)
                                                            <option value="{{ $fiscal_year->id }}">{{ $fiscal_year->fiscal_year_title }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="expiration">
                                                    <h6>Expiration (for Offset)</h6>
                                                </label>
                                                <input type="date" class="form-control form-control-sm" name="expiration" id="expiration">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <div class="form-check form-switch mt-3">
                                                    <input class="form-check-input" type="checkbox" id="show_on_employee2{{ $leavetype->leave_type_title }}" name="show_on_employee" value="1">
                                                    <label class="form-check-label" for="show_on_employee2{{ $leavetype->leave_type_title }}">Show this to Employee</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label for="reason_note">
                                                    <h6>Note</h6>
                                                </label>
                                                <textarea class="form-control form-control-sm" name="reason_note" id="reason_note" cols="30" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="btn_close_onApply" data-bs-dismiss="modal">Cancel</button>
                            <button id="btn_apply" type="submit" class="btn btn-success">
                                <div class="spinner-border spinner-border-sm text-light d-none" id="loading_spinner_apply" role="status">
                                    <span class="visually-hidden" >Loading...</span>
                                </div>
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- End Add Leave Credits Modal --}}

    {{-- Employee Management Table --}}
    <div class="row p-3 m-1">
        <div class="d-flex gap-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="d-lg-inline-flex d-md-inline-flex d-sm-grid d-grid gap-3 ">
                    <h5>Employee Leave Credits</h5>
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
                                <li><a class="dropdown-item" href="{{ route('hrstaff_fy_leave_credits',['fiscal_year'=>$fiscal_year->id]) }}">{{ $fiscal_year->fiscal_year_title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-secondary btn-sm" href="{{ route('export') }}">Export CSV</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end pe-5">
                <a class="btn btn-primary btn-sm" href="#Add" data-bs-toggle="modal" data-bs-target="#AddLeaveCreditModal">
                    <i class='bx bx-message-square-add' ></i>
                    Give Leave Credits
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="table-wrapper">
                <table id="data_table" class="table table-bordered table-hover bg-light table-sm compact ">
                    <thead class="bg-success text-light border-light dataTables_wrapper">
                        <tr>
                            <th>Full Name</th>
                            {{-- <th>Position</th>
                            <th>Sub-department</th> --}}
                            <th>Department</th>
                            <th>Leave Type</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee_leavecredits as $employee_leavecredit)
                        <tr>
                            <td>
                                {{ optional($employee_leavecredit->employees->users)->last_name }},
                                {{ optional($employee_leavecredit->employees->users)->first_name }}
                                {{ optional($employee_leavecredit->employees->users)->middle_name }}
                                {{ optional($employee_leavecredit->employees->users->suffixes)->suffix_title }}
                            </td>
                            {{-- <td>{{ optional(optional($employee_leavecredit->employees->employee_positions)->positions)->position_description }}</td> --}}
                            {{-- <td>{{ optional(optional(optional($employee_leavecredit->employees->employee_positions)->positions)->subdepartments)->sub_department_title }}</td> --}}
                            {{-- <td>{{ optional(optional(optional(optional($employee_leavecredit->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}</td> --}}
                            <td>{{ $employee_leavecredit->employees->employee_positions->positions->subdepartments->departments->department_title }}</td>
                            <td>{{ optional($employee_leavecredit->leavetypes)->leave_type_title }}</td>
                            <td>{{ $employee_leavecredit->leave_days_credit }}</td>
                            <td class="d-flex gap-2 ">
                                <a href="#" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateLeaveCreditModal{{ $employee_leavecredit->id }}">Update</a>
                                <a href="{{ route('user_profile_leave',['username' => $employee_leavecredit->employees?->users?->user_name]) }}" class="btn-sm btn-outline-primary">Details</a>
                            </td>
                        </tr>

                        {{-- Update Leave Credits Modal --}}
                            <div class="modal fade" id="UpdateLeaveCreditModal{{ $employee_leavecredit->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
                                        <form action="{{ route('update_leavecredits',['leavecredit_id'=>$employee_leavecredit->id]) }}" method="POST" onsubmit="onClickUpdateFormId('{{ $employee_leavecredit->id }}')">
                                            @csrf
                                            <div class="modal-body" id="form_container_onUpdate{{ $employee_leavecredit->id }}">
                                                <div class="container-fluid text-start">
                                                    <div class="row">
                                                        <div class="col ">
                                                            <div class="row pt-3 pb-2">
                                                                <div class="col-9">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Update Leave Credit</h5>
                                                                </div>
                                                                <div class="col-3 text-end">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="btn_modal_x_onUpdate{{ $employee_leavecredit->id }}" aria-label="Close"></button>
                                                                </div>
                                                            </div>
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
                                                                    <input type="number" step="0.5" class="form-control" id="credits" name="credits" disabled value="{{ $employee_leavecredit->leave_days_credit }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col">
                                                                    <label class="" for="leavetype">
                                                                        <h6 class="">Fiscal Year</h6>
                                                                    </label>
                                                                    <input type="text" step="0.5" class="form-control" id="credits" name="credits" value="{{ $employee_leavecredit->fiscal_years->fiscal_year_title }}" disabled>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="expiration">
                                                                        <h6>Expiration (for Offset)</h6>
                                                                    </label>
                                                                    <input type="date" class="form-control form-control-sm" name="expiration" id="expiration" value="{{ $employee_leavecredit->expiration }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col">
                                                                    @if ($employee_leavecredit->show_on_employee == false)
                                                                        <div class="form-check form-switch mt-3">
                                                                            <input class="form-check-input" type="checkbox" id="show_on_employee2{{ $employee_leavecredit->id }}" name="show_on_employee" value="1">
                                                                            <label class="form-check-label" for="show_on_employee2{{ $employee_leavecredit->id }}">Show this to Employee</label>
                                                                        </div>
                                                                    @else
                                                                        <div class="form-check form-switch mt-3">
                                                                            <input class="form-check-input" type="checkbox" id="show_on_employee1{{ $employee_leavecredit->id }}" name="show_on_employee" value="1" checked>
                                                                            <label class="form-check-label" for="show_on_employee1{{ $leavetype->id }}">Show this to Employee</label>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-transparent" id="btn_close_onUpdate{{ $employee_leavecredit->id }}" data-bs-dismiss="modal">Cancel</button>
                                                <button id="btn_update{{ $employee_leavecredit->id }}" type="submit" class="btn btn-success">
                                                    <div class="spinner-border spinner-border-sm text-light d-none" id="loading_spinner_update{{ $employee_leavecredit->id }}" role="status">
                                                        <span class="visually-hidden" >Loading...</span>
                                                    </div>
                                                    Update
                                                </button>
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
                                {{-- {!! $employee_leavecredits->links('pagination::bootstrap-5') !!} --}}
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
