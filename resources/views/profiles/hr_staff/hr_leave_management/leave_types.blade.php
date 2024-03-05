@extends('profiles.hr_staff.hrstaff_dashboard_layout')
@section('menu_hr_dashboard','text-dark')
@section('menu_leave_credits','text-dark')
@section('menu_leave_management','text-dark')
@section('menu_leave_types','bg-selected-warning text-light')
@section('sub-content')

<div class="spinner-border text-primary" id="loading_spinner_approve" role="status" style="display: none;">
    <span class="visually-hidden" >Loading...</span>
</div>
<div class="row">
    <div class="col mt-2">
      <h3>Leave Management HR Staff / Leave Types</h3>
    </div> 
</div>
<div class="row gap-3" id="table_container">
    <div class="row">
        <div class="col text-end align-items-end">
            <a href="#Add" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#AddTypeModal">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Add
            </a>
        </div>
    </div>

    <!-- Add Type Modal -->
    <div class="modal fade" id="AddTypeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('create_leavetypes') }}" method="POST" onsubmit="onClickApprove()">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Leave Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid text-start">
                            <div class="row mt-2 mb-3" >
                                <div class="col">
                                    <label for="leavetype_title">
                                        <h6 class="">Leave Type Title</h6>
                                    </label>
                                    <input type="text" class="form-control" id="leavetype_title" name="leavetype_title" placeholder="" required>
                                    <label class="mt-3" for="leavetype_description">
                                        <h6 class="">Leave Type Description</h6>
                                    </label>
                                    <textarea class="form-control" id="leavetype_description" name="leavetype_description" rows="5" cols="50" required></textarea>
                                </div>
                                <div class="col">
                                    <label for="days_per_year">
                                        <h6>Leave per year (Days)</h6>
                                    </label>
                                    <input type="number" step="0.5" class="form-control" id="days_per_year" name="days_per_year" placeholder="" required>
                                    <label class="mt-3" for="max_days">
                                        <h6>Max Accumulation (Days)</h6>
                                    </label>
                                    <input type="number" class="form-control" id="max_days" name="max_days" placeholder="" required>
                                    <label class="mt-3" for="reset_date">
                                        <h6>Reset Date</h6>
                                    </label>
                                    <input type="date" class="form-control" id="reset_date" name="reset_date" placeholder="" required>
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
    {{-- End Add Type Modal --}}
    
    <div class="row bg-light p-3 m-1">
        <div class="row">
            <div class="col">
                <h5>Employee Leave Type Management</h5>
            </div>
        </div>
        <div class="row">
            <div class="table-wrapper text-wrap">
                <table class="table table-striped table-hover bg-light">
                    <thead>
                        <tr>
                            <th>Leave Title</th>
                            <th>Description</th>
                            <th>Days per year</th>
                            <th>Max days</th>
                            <th>Reset Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leavetypes as $leavetype)
                        <tr>
                            <td>{{ $leavetype->leave_type_title }}</td>
                            <td>{{ $leavetype->leave_type_description }}</td>
                            <td>{{ $leavetype->leave_days_per_year }}</td>
                            <td>{{ $leavetype->max_leave_days }}</td>
                            <td>{{ \Carbon\Carbon::parse($leavetype->reset_date)->format('M d, Y') }}</td>
                            <td class="m-2">
                                <a href="#" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#UpdatetypeModal{{ $leavetype->id }}">Update</a>
                                <a href="#" type="button" class="btn btn-sm btn-transparent text-danger" data-bs-toggle="modal" data-bs-target="#delete_modal{{ $leavetype->id }}"><b>Delete</b></a>
                            </td>
                        </tr>
                        <!-- Update Leave Type Modal -->
                            <div class="modal fade" id="UpdatetypeModal{{ $leavetype->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('update_leavetypes',['leavetype_id'=>$leavetype->id]) }}" method="PATCH" onsubmit="onClickApprove()">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update Leave Type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label for="leavetype_title">
                                                                <h6 class="">Leave Type Title</h6>
                                                            </label>
                                                            <input type="text" class="form-control" id="leavetype_title" name="leavetype_title" value="{{ $leavetype->leave_type_title }}" required>
                                                            <label class="mt-3" for="leavetype_description">
                                                                <h6 class="">Leave Type Description</h6>
                                                            </label>
                                                            <textarea class="form-control" id="leavetype_description" name="leavetype_description" rows="5" cols="50" required>{{ $leavetype->leave_type_description }}</textarea>
                                                        </div>
                                                        <div class="col">
                                                            <label for="days_per_year">
                                                                <h6>Leave per year (Days)</h6>
                                                            </label>
                                                            <input type="number" step="0.5" class="form-control" id="days_per_year" name="days_per_year" value="{{ $leavetype->leave_days_per_year }}" required>
                                                            <label class="mt-3" for="max_days">
                                                                <h6>Max Accumulation (Days)</h6>
                                                            </label>
                                                            <input type="number" class="form-control" id="max_days" name="max_days" value="{{ $leavetype->max_leave_days }}" required>
                                                            <label class="mt-3" for="reset_date">
                                                                <h6>Reset Date</h6>
                                                            </label>
                                                            <input type="date" class="form-control" id="reset_date" name="reset_date" value="{{ \Carbon\Carbon::parse($leavetype->reset_date)->format('Y-m-d') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                                <button id="submit_button1" type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {{-- End update leave Type Modal --}}
                        <!-- delete leave type Modal -->
                            <div class="modal fade" id="delete_modal{{ $leavetype->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid text-start">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <h2>Are you sure?</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('delete_leavetypes',['leavetype_id'=>$leavetype->id]) }}" method="PUT" onsubmit="onClickApprove()">
                                                @csrf
                                                <button class="btn btn-danger" type="submit" data-bs-dismiss="modal">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- end delete leave type Modal --}}
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection