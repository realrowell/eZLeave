@extends('profiles.admin.organization.departments')
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
    @foreach ($departments as $department)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <div class="card w-100 p-2 shadow">
                <div class="card-body row">
                    {{-- <div class="col-lg-4 col-md-4 col-4 ">
                        <img class="profile-photo-sm" src="/img/dummy_profile.jpg" alt="">
                    </div> --}}
                    <div class="">
                        <div class="row">
                            <h5><strong>{{ $department->department_title }}</strong></h5>
                        </div>
                        <div class="row">
                            <p class="card-desc">Employees: 6</p>
                            <p class="card-desc">Sub-departments: 2</p>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <a href="#" class="btn btn-sm btn-primary text-center">View</a>
                                <a href="#Update_department" class="btn btn-sm btn-outline-primary border border-primary" data-bs-toggle="modal" data-bs-target="#update_department{{ $department->id }}">
                                    Update
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <button id="submit_button2" type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Update Department Modal --}}
    @endforeach
    {{-- END CARDS --}}
    
</div>
@endsection