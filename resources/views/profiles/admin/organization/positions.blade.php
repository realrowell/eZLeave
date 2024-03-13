@extends('includes.admin_layout')
@section('title','Employee Positions')
@section('sidebar_organization_active','active')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">

    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin_departments_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Departments</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin_subdepartments_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Sub-departments</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
            <a href="{{ route('admin_positions_grid') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Positions</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin_areaofassignemnts_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Area of Assignments</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3><a href="{{ route('admin_org_menu') }}" class="text-dark">Organization</a> / Employee Positions</h3>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">
            <a href="{{ route('admin_positions_grid') }}" class="col p-2 custom-primary-button custom-rounded-top @yield('grid_active') ">
                <i data-toggle="tooltip" title="grid view" class="grid-view-icon">
                    <svg stroke="white" class="mb-2" width="25px" height="25px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3.5 3.5H10.5V10.5H3.5V3.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M3.5 13.5H10.5V20.5H3.5V13.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M13.5 3.5H20.5V10.5H13.5V3.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M13.5 13.5H20.5V20.5H13.5V13.5Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </i>
                Grid View
            </a>
            <a href="{{ route('admin_positions_list') }}" class="col p-2 ms-2 custom-primary-button custom-rounded-top @yield('list_active')">
                <i data-toggle="tooltip" title="list view" class="list-view-icon">
                    <svg fill="white" class="" width="25px" height="25px" viewBox="-2.1 -2.1 25.20 25.20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>list [#1497]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1"  fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -322.000000)" > <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M124.575,174 C123.7056,174 123,174.672 123,175.5 C123,176.328 123.7056,177 124.575,177 C125.4444,177 126.15,176.328 126.15,175.5 C126.15,174.672 125.4444,174 124.575,174 L124.575,174 Z M128.25,177 L144,177 L144,175 L128.25,175 L128.25,177 Z M124.575,168 C123.7056,168 123,168.672 123,169.5 C123,170.328 123.7056,171 124.575,171 C125.4444,171 126.15,170.328 126.15,169.5 C126.15,168.672 125.4444,168 124.575,168 L124.575,168 Z M128.25,171 L144,171 L144,169 L128.25,169 L128.25,171 Z M124.575,162 C123.7056,162 123,162.672 123,163.5 C123,164.328 123.7056,165 124.575,165 C125.4444,165 126.15,164.328 126.15,163.5 C126.15,162.672 125.4444,162 124.575,162 L124.575,162 Z M128.25,165 L144,165 L144,163 L128.25,163 L128.25,165 Z" id="list-[#1497]"> </path> </g> </g> </g> </g></svg>
                </i>
                List View
            </a>
            <a href="#create_position" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#create_position">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Create Position
            </a>
            <a href="#create_position_title" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#create_position_title">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Add Position Title
            </a>
        </div>
    </div>
    <!-- Add Position Modal -->
        <div class="modal fade" id="create_position" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none;">
                    <span class="visually-hidden" >Loading...</span>
                </div>
                <div class="modal-content">
                    <form action="{{ route('admin_create_position') }}" method="POST" onsubmit="onFormSubmit()">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Employee Positions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="form_to_submit">
                            <div class="container-fluid text-start">
                                <div class="row mt-2 mb-3" >
                                    <div class="col">
                                        <label for="position_title"><h6 class="profile-title">Position Title</h6></label>
                                        <select id="position_title" name="position_title" class="form-control" required>
                                            <option disabled selected required value="">— Please select here —</option>
                                            @foreach ($position_titles as $position_title)
                                                <option value="{{ $position_title->id }}">{{ $position_title->position_title }}</option>
                                            @endforeach
                                        </select>
                                        <label class=" mt-3" for="position_description"><h6 class="profile-title">Position Description</h6></label>
                                        <textarea class="form-control" id="position_description" name="position_description" rows="3" cols="10" required></textarea>
                                        {{-- <label class="mt-3" for="department"><h6 class="profile-title">Department</h6></label>
                                        <select id="department" name="department" id="department_value" class="form-control" required>
                                            <option disabled selected required value="">— Please select here —</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->department_title }}</option>
                                            @endforeach
                                        </select> --}}
                                        <label class="mt-3" for="subdepartment_title"><h6 class="profile-title">Sub-department</h6></label>
                                        <select id="subdepartment_title" name="subdepartment_title" class="form-control" required>
                                            <option disabled selected required value="">— Please select here —</option>
                                            @foreach ($subdepartments as $subdepartment)
                                                <option value="{{ $subdepartment->id }}">{{ $subdepartment->sub_department_title }}</option>
                                            @endforeach
                                        </select>
                                        <label class="mt-3" for="position_level"><h6 class="profile-title">Position Level</h6></label>
                                        <select id="position_level" name="position_level" class="form-control" required>
                                            <option disabled selected required value="">— Please select here —</option>
                                            @foreach ($position_levels as $position_level)
                                                <option value="{{ $position_level->id }}">{{ $position_level->level_title }}</option>
                                            @endforeach
                                        </select>
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
    {{-- End Add Position Modal --}}
    <!-- Add Position Title Modal -->
    <div class="modal fade" id="create_position_title" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="spinner-border text-primary" id="loading_spinner_2" role="status" style="display: none;">
                <span class="visually-hidden" >Loading...</span>
            </div>
            <div class="modal-content">
                <form action="{{ route('admin_create_position_title') }}" method="POST" onsubmit="onFormSubmit_1()">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Employee Positions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="form_to_submit_2">
                        <div class="container-fluid text-start">
                            <div class="row mt-2 mb-3" >
                                <div class="col">
                                    <label for="position_title"><h6 class="profile-title">Position Title</h6></label>
                                    <input type="text" class="form-control" id="position_title" name="position_title" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                        <button id="submit_button_2" type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- End Add Position Title Modal --}}
    @yield('sub-content')
</div>

@endsection
