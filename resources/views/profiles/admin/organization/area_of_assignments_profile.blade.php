@extends('includes.admin_layout')
@section('title','Deparments')
@section('sidebar_organization_active','active')
@section('content')


<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3><a href="/admin/organization/menu" class="text-dark">Organization</a> /
                <a href="/admin/organization/area_of_assignments/grid" class="text-dark">Area of Assignments</a>
                 / Profile</h3>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">

        </div>
    </div>
    <div class="row justify-content-center align-items-start d-flex gap-2">
        <div class="col-lg-3 col-md-3 col-sm-10 bg-light align-self-stretch shadow bg-gradient-primary m-2" style="min-height: 10rem">
            <div class="row mt-3 text-end">
                <a href="#Update_area_of_assignment" class="text-light" data-bs-toggle="modal" data-bs-target="#update_area_of_assignment{{ $area_of_assignments->id }}" title="Update">
                    <svg class="m-1" width="20px" height="20px" viewBox="0 0 25 25">
                        {{ svg('feathericon-edit') }}
                    </svg>Update
                </a>
            </div>
            <div class="row">
                <div class="col text-center p-5">
                    <h4 class="text-light text-shadow-1">{{ $area_of_assignments->location_address }}</h4>
                    <p class="text-light text-shadow-1">Description: {{ $area_of_assignments->location_desc }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-10">
            <div class="row justify-content-lg-center justify-content-md-start justify-content-sm-center justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-11 mt-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <p class="card-desc fs-1">65</p>
                            <div class="custom-h-50 custom-bg-primary custom-bg-primary-hover transition-1 text-shadow-2 text-light pt-2 fs-5">
                                Employees
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-11 mt-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <p class="card-desc fs-1">55</p>
                            <div class="custom-h-50 custom-bg-warning custom-bg-warning-hover transition-1 text-shadow-2 text-light pt-2 fs-5">
                                Regular
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-11 mt-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <p class="card-desc fs-1">10</p>
                            <div class="custom-h-50 custom-bg-warning custom-bg-warning-hover transition-1 text-shadow-2 text-light pt-2 fs-5">
                                Probationary
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-light mt-4 z-1 p-1 m-1 shadow">
                <div class="row justify-content-start align-items-start text-start">
                    <div class="col">
                        <a href="#employees" class="ms-1 me-1 p-2 custom-primary-button bg-selected-warning">
                            Employees
                        </a>
                        <a href="#regular" class="ms-1 me-1 p-2 custom-primary-button @yield('grid_active') ">
                            Regular
                        </a>
                        <a href="#probationary" class="ms-1 me-1 p-2 custom-primary-button @yield('list_active') ">
                            Probationary
                        </a>
                    </div>
                </div>
                {{-- LIST PROFILE --}}
                <div class="row mt-3">
                    <div>
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <table id="data_table" class="table table-bordered table-hover bg-light shadow">
                                    <thead class="bg-success text-light border-light">
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Position</th>
                                            <th>Sub-department</th>
                                            <th class="text-end pe-5">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            @foreach ($employee_positions as $employee_position)
                                                @if ($employee->employee_position_id == $employee_position->id)
                                                    <tr>
                                                        <td>{{ $employee->users?->first_name }}</td>
                                                        <td>{{ $employee?->employee_positions?->positions?->position_description }}</td>
                                                        <td>{{ $employee?->employee_positions?->positions?->subdepartments->sub_department_title }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            {{-- <tr>
                                                <td>{{ $subdepartment->sub_department_title }}</td>
                                                <td>{{ $subdepartment->departments->department_title }} </td>
                                                <td class="text-end pe-5">
                                                    <a type="button" href="#" class="btn btn-sm btn-primary">
                                                        View
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal">
                                                        Update
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- END LIST --}}
            </div>
        </div>

        <!-- Update Department Modal -->
        <div class="modal fade" id="update_area_of_assignment{{ $area_of_assignments->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="/organization/update_area_of_assignments/{{ $area_of_assignments->id }}" method="PUT">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Area of Assignment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid text-start">
                                <div class="row mt-2 mb-3" >
                                    <div class="col">
                                        <label for="location_address"><h6 class="profile-title">Area of assignment</h6></label>
                                        <input type="text" class="form-control" id="location_address" name="location_address" value="{{ $area_of_assignments->location_address }}" placeholder="">
                                        <label for="location_desc" class="mt-3"><h6 class="profile-title">Description</h6></label>
                                        <div class="form-floating">
                                            <textarea class="form-control" name="location_desc" placeholder="Type a reason here" id="location_desc" style="height: 100px">{{ $area_of_assignments->location_desc }}</textarea>
                                            <label for="location_desc">Description goes here</label>
                                        </div>
                                        <label for="embedmap" class="mt-3"><h6 class="profile-title">Embed Map</h6></label>
                                        <div class="form-floating">
                                            <textarea class="form-control" name="embedmap" placeholder="Type a reason here" id="embedmap" style="height: 300px">{{ $area_of_assignments->embedded_google_map }}</textarea>
                                            <label for="embedmap">HTML code goes here</label>
                                        </div>
                                        <a href="{{ $system_settings->embed_map_provider }}" class="text-end" target="_blank">get Embed Map code here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Update Department Modal --}}
    </div>
    <div class="row mt-4 z-1 p-1 m-1">
        {!! $area_of_assignments->embedded_google_map !!}
    </div>

</div>

@endsection
