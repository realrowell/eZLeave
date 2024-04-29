@extends('profiles.admin.organization.departments')
@section('list_active','bg-selected-warning')
@section('sub-content')

{{-- <div class="row mt-2">
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
</div> --}}
{{-- LIST PROFILE --}}
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
            <div class="table-wrapper">
                <table id="data_table" class="table table-bordered table-hover bg-light shadow">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Department</th>
                            <th class="text-end pe-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->department_title }}</td>
                                <td class="text-end pe-5">
                                    <a type="button" href="#" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#update_department{{ $department->id }}" title="Update">
                                        Update
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_department_{{ $department->id }}" title="Delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <!-- Update Department Modal -->
                                <div class="modal fade" id="update_department{{ $department->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin_update_department',['id'=>$department->id]) }}" method="PUT" onsubmit="submitButtonDisabled()">
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
                                            <form action="{{ route('admin_delete_department',['id'=>$department->id]) }}" method="PUT" onsubmit="submitButtonDisabled()">
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
                <div class="row">
                    <div class="col">
                        <div class="mt-2 mb-5">
                            <ul class="pagination justify-content-center align-items-center">
                                {{-- {!! $departments->links('pagination::bootstrap-5') !!} --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
{{-- END LIST --}}


@endsection
