@extends('profiles.admin.organization.positions')
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
            <p>*Search position title here</p>
        </div>
    </div>
</div>
    {{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($positions as $position)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <div class="card w-100 p-2 shadow">
                <div class="card-body row">
                    <div class="row">
                        <h5><strong>{{ $position->position_title }}</strong></h5>
                    </div>
                    <div class="row">
                        <p class="card-desc">Employees: 4</p>
                        {{-- <p class="card-desc">Sub-department: {{ $position->subdepartments->sub_department_title }}</p> --}}
                        {{-- <p class="card-desc">Department: {{ $position->subdepartments->departments->department_title }}</p> --}}
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <a href="#View_position" class="btn-sm btn-primary text-center">View</a>
                            <a href="#Update_position" class="btn-sm btn-outline-primary border border-primary" data-bs-toggle="modal" data-bs-target="#update_position{{ $position->id }}" title="Update">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Department Modal -->
        <div class="modal fade" id="update_position{{ $position->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="/organization/update_position/{{ $position->id }}" method="PUT" onsubmit="submitButtonDisabled()">
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
                                        <label for="position_title"><h6 class="profile-title">Position title</h6></label>
                                        <input type="text" class="form-control" id="position_title" name="position_title" value="{{ $position->position_title }}">
                                        <label class="mt-3" for="position_title"><h6 class="profile-title">Position description</h6></label>
                                        <textarea class="form-control" id="position_description" name="position_description" rows="10" cols="50" required>{{ $position->position_description }}</textarea>
                                        {{-- <label class="mt-3" for="subdepartment_title"><h6 class="profile-title">Sub-department</h6></label>
                                        <select id="subdepartment_title" name="subdepartment_title" class="form-control" required maxlength="12">
                                            <option selected hidden value="{{ $position->subdepartment_id }}">{{ $position->subdepartments->sub_department_title }}</option>
                                            @foreach ($subdepartments as $subdepartment)
                                                <option value="{{ $subdepartment->id }}">{{ $subdepartment->sub_department_title }}</option>
                                            @endforeach
                                        </select> --}}
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
        {{-- End Update Department Modal --}}
        <!-- Delete Department Modal -->
        <div class="modal fade " id="delete_position_{{ $position->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/organization/delete_position/{{ $position->id }}" method="PUT" onsubmit="submitButtonDisabled()">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Delete position</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid text-start">
                                <div class="row mt-2 mb-3" >
                                    <div class="col">
                                        <label class="mb-3"><h6 class="profile-title">Are you sure you want to delete this?</h6></label>
                                        <p class="card-desc"><b>{{ $position->position_title }}</b> </p>
                                        {{-- <p class="card-desc">Sub-department: {{ $position->subdepartments->sub_department_title }}</p>
                                        <p class="card-desc">Department: {{ $position->subdepartments->departments->department_title }}</p> --}}
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
    
    {{-- END CARDS --}}
    
</div>
@endsection