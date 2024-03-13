@extends('profiles.admin.organization.subdepartments')
@section('grid_active','bg-selected-warning')
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
    {{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($subdepartments as $subdepartment)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <div class="card w-100 p-2 shadow">
                <div class="card-body row">
                    <div class="">
                        <div class="row">
                            <h5><strong>{{ $subdepartment->sub_department_title }}</strong></h5>
                        </div>
                        <div class="row">
                            <p class="card-desc">Employees: 4</p>
                            <p class="card-desc">Parent department: {{ $subdepartment->departments->department_title }}</p>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <a href="#" class="btn-sm btn-primary text-center">View</a>
                                <a href="#update_subdepartment" class="btn-sm btn-outline-primary border border-primary" data-bs-toggle="modal" data-bs-target="#update_subdepartment{{ $subdepartment->id }}">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update SubDepartment Modal -->
        <div class="modal fade" id="update_subdepartment{{ $subdepartment->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin_update_subdepartment',['id'=>$subdepartment->id]) }}" method="PUT" onsubmit="submitButtonDisabled()">
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
                            <button id="submit_button" type="submit" class="btn btn-success" >Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Update SubDepartment Modal --}}
    @endforeach
    {{-- END CARDS --}}
    <div class="row">
        <div class="col">
            <div class="mt-2 mb-5">
                <ul class="pagination justify-content-center align-items-center">
                    {!! $subdepartments->links('pagination::bootstrap-5') !!}
                </ul>
            </div>
        </div>
    </div>
    
</div>
@endsection