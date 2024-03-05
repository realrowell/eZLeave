@extends('profiles.admin.organization.subdepartments')
@section('list_active','bg-selected-warning')
@section('sub-content')

<div class="row mt-2">
    <div class="col-lg-6 col-md-6 col-sm-12">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="row">
            <div class="input-group">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-primary">search</button>
            </div>
        </div>
        <div class="row">
            <p>*Search department here</p>
        </div>
    </div>
</div>
{{-- LIST PROFILE --}}
<div class="row">
    <div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <table class="table table-striped table-hover bg-light">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Sub-department</th>
                            <th># of Employees</th>
                            <th>Parent Department</th>
                            <th class="text-end pe-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subdepartments as $subdepartment)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox2" name="options[]" value="1">
                                        <label for="checkbox2"></label>
                                    </span>
                                </td>
                                <td>{{ $subdepartment->sub_department_title }}</td>
                                <td>32</td>
                                <td>{{ $subdepartment->departments->department_title }} </td>
                                <td class="text-end pe-5">
                                    <a href="#" class="" title="View">
                                        <svg class="m-1" width="23px" height="23px" viewBox="0 0 20 20">
                                            {{ svg('carbon-view-filled') }}
                                        </svg>
                                    </a>
                                    <a href="#Update_department" class="" data-bs-toggle="modal" data-bs-target="#update_subdepartment{{ $subdepartment->id }}" title="Update">
                                        <svg class="m-1" width="20px" height="20px" viewBox="0 0 25 25">
                                            {{ svg('feathericon-edit') }}
                                        </svg>Update
                                    </a>
                                    <a href="#Delete_department" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_subdepartment_{{ $subdepartment->id }}" title="Delete">
                                        <svg class="m-1" width="23px" height="23px" viewBox="0 0 23 23">
                                            {{ svg('css-trash') }} 
                                        </svg>Delete
                                    </a>
                                </td>
                            </tr>
                            <!-- Update SubDepartment Modal -->
                            <div class="modal fade" id="update_subdepartment{{ $subdepartment->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/organization/update_subdepartment/{{ $subdepartment->id }}" method="PUT" onsubmit="submitButtonDisabled()">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update Department</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label for="subdepartment_title"><h6 class="profile-title">Sub-deparment name</h6></label>
                                                            <input type="text" class="form-control" id="subdepartment_title" name="subdepartment_title" placeholder="{{ $subdepartment->sub_department_title }}" value="{{ $subdepartment->sub_department_title }}">
                                                            <label class="mt-3" for="dept_name"><h6 class="profile-title">Department</h6></label>
                                                            <select id="dept_name" name="dept_name" class="form-control" required>
                                                                <option selected hidden value="{{ $subdepartment->departments->id }}">{{ $subdepartment->departments->department_title }}</option>
                                                                @foreach ($departments as $department)
                                                                    <option value="{{ $department->id }}">{{ $department->department_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                                                <button id="submit_button2" type="submit" class="btn btn-success" >Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Update SubDepartment Modal --}}
                            <!-- Delete SubDepartment Modal -->
                            <div class="modal fade " id="delete_subdepartment_{{ $subdepartment->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/organization/delete_subdepartment/{{ $subdepartment->id }}" method="PUT" onsubmit="submitButtonDisabled()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete sub-department</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label for="department_title"><h6 class="profile-title">Are you sure you want to delete this?</h6></label>
                                                            {{-- <input type="text" class="form-control" id="department_title" name="department_title" placeholder="{{ $department->department_title }}"> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outlined" data-bs-dismiss="modal">Cancel</button>
                                                <button id="submit_button" type="submit" class="btn btn-danger" >Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Delete SubDepartment Modal --}}
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
{{-- END LIST --}}
    
</div>

@endsection