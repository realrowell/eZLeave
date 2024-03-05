@extends('profiles.admin.organization.departments')
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
                            <th>Department</th>
                            <th># of Employee</th>
                            <th># of Sub-departments</th>
                            <th class="text-end pe-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td>{{ $department->department_title }}</td>
                                <td>6</td>
                                <td>2</td>
                                <td class="text-end pe-5">
                                    {{-- <a href="/profile/user_profile" class="btn-sm btn-primary">View</a>
                                    <a href="#Update_department" class="btn-sm btn-outline-primary border border-primary" data-bs-toggle="modal" data-bs-target="#update_department{{ $department->id }}">
                                        <svg class="m-1" width="15px" height="15px" viewBox="0 1 10 8">{{ svg('grommet-update') }}</svg> Update
                                    </a>
                                    <a href="#Delete_department" class="btn-sm btn-outline-danger border border-danger" data-bs-toggle="modal" data-bs-target="#delete_department{{ $department->id }}">
                                        Delete
                                    </a> --}}
                                    <a href="#" class="" title="View">
                                        <svg class="m-1" width="23px" height="23px" viewBox="0 0 20 20">
                                            {{ svg('carbon-view-filled') }}
                                        </svg>
                                    </a>
                                    <a href="#Update_department" class="" data-bs-toggle="modal" data-bs-target="#update_department{{ $department->id }}" title="Update">
                                        <svg class="m-1" width="20px" height="20px" viewBox="0 0 25 25">
                                            {{ svg('feathericon-edit') }}
                                        </svg>Update
                                    </a>
                                    <a href="#Delete_department" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_department_{{ $department->id }}" title="Delete">
                                        <svg class="m-1" width="23px" height="23px" viewBox="0 0 23 23">
                                            {{ svg('css-trash') }} 
                                        </svg>Delete
                                    </a>
                                </td>
                            </tr>
                            <!-- Update Department Modal -->
                            <div class="modal fade" id="update_department{{ $department->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/organization/update-department/{{ $department->id }}" method="PUT" onsubmit="submitButtonDisabled()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update Department</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label for="department_title"><h6 class="profile-title">Deparment name</h6></label>
                                                            <input type="text" class="form-control" id="department_title" name="department_title" placeholder="{{ $department->department_title }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                                                <button id="submit_button" type="submit" class="btn btn-success" >Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Update Department Modal --}}
                            <!-- Delete Department Modal -->
                            <div class="modal fade " id="delete_department_{{ $department->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/organization/delete-department/{{ $department->id }}" method="PUT" onsubmit="submitButtonDisabled()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete department</h5>
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
                                                <button type="button" class="btn btn-outlined" data-bs-dismiss="modal">Discard</button>
                                                <button id="submit_button2" type="submit" class="btn btn-danger" >Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Delete Department Modal --}}
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