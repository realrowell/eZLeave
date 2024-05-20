@extends('includes.hrstaff_layout')
@section('title','Employee Management')
@section('sidebar_employee_management_active','active')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_employees_grid') }}" class="text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>All Employees</h6>
                    </div>
                </div>
            </a>
        </div>
        {{-- <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_employees_regular_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Regular</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('hrstaff_employees_probi_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Probationary</h6>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>
    <div class="row mb-2">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3>Employee Management</h3>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">
            <a href="{{ route('hrstaff_employees_grid') }}" class="col p-2 me-2 custom-primary-button custom-rounded-top @yield('grid_active')">
                <i data-toggle="tooltip" title="grid view" class="grid-view-icon">
                    <svg stroke="white" class="mb-2" width="25px" height="25px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3.5 3.5H10.5V10.5H3.5V3.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M3.5 13.5H10.5V20.5H3.5V13.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M13.5 3.5H20.5V10.5H13.5V3.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M13.5 13.5H20.5V20.5H13.5V13.5Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </i>
                Grid View
            </a>
            <a href="{{ route('hrstaff_employees_list') }}" class="col p-2 custom-primary-button custom-rounded-top @yield('list_active')">
                <i data-toggle="tooltip" title="list view" class="list-view-icon">
                    <svg fill="white" class="" width="25px" height="25px" viewBox="-2.1 -2.1 25.20 25.20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>list [#1497]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1"  fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -322.000000)" > <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M124.575,174 C123.7056,174 123,174.672 123,175.5 C123,176.328 123.7056,177 124.575,177 C125.4444,177 126.15,176.328 126.15,175.5 C126.15,174.672 125.4444,174 124.575,174 L124.575,174 Z M128.25,177 L144,177 L144,175 L128.25,175 L128.25,177 Z M124.575,168 C123.7056,168 123,168.672 123,169.5 C123,170.328 123.7056,171 124.575,171 C125.4444,171 126.15,170.328 126.15,169.5 C126.15,168.672 125.4444,168 124.575,168 L124.575,168 Z M128.25,171 L144,171 L144,169 L128.25,169 L128.25,171 Z M124.575,162 C123.7056,162 123,162.672 123,163.5 C123,164.328 123.7056,165 124.575,165 C125.4444,165 126.15,164.328 126.15,163.5 C126.15,162.672 125.4444,162 124.575,162 L124.575,162 Z M128.25,165 L144,165 L144,163 L128.25,163 L128.25,165 Z" id="list-[#1497]"> </path> </g> </g> </g> </g></svg>
                </i>
                List View
            </a>
            <a href="#AddAccount" class="col p-2 ms-2 custom-primary-button custom-rounded-top"  data-bs-toggle="modal" data-bs-target="#AddAccountModal">
                <i data-toggle="tooltip" title="list view" class="add-icon" >
                    <svg class="mb-1" width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80">{{ svg('css-add') }}</svg>
                </i>
                Add Account
            </a>
            <!-- Add Account Modal -->
                <div class="modal fade" id="AddAccountModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none;">
                            <span class="visually-hidden" >Loading...</span>
                        </div>
                        <div class="modal-content">
                            <form action="{{ route('admin_create_employee') }}" method="POST" onsubmit="onFormSubmit()">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="form_to_submit">
                                    <div class="container-fluid text-start">
                                        <div class="row">
                                            <div class="row ps-5 p-3 pe-5 text-dark">
                                                <div class="col-lg-6 col-md-6 col-sm-12 border-start border-warning border-5">
                                                    <div class="row mt-4 mb-1">
                                                        <div class="col">
                                                            <h5 class="profile-title-header">Personal Information</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1" >
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="firstname"><h6 class="profile-title">First name</h6></label>
                                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="lastname"><h6 class="profile-title">Last name</h6></label>
                                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1" >
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="middlename"><h6 class="profile-title">Middle name</h6></label>
                                                            <input type="text" class="form-control" id="middlename" name="middlename" value="{{ old('middlename') }}">
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="suffix"><h6 class="profile-title">Suffix</h6></label>
                                                            <select class="form-control" id="suffix" name="suffix">
                                                                <option selected value="{{ old('suffix') }}">-- N/A --</option>
                                                                @foreach ($suffixes as $suffix)
                                                                    <option value="{{ $suffix->id }}">{{ $suffix->suffix_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="gender"><h6 class="profile-title">Sex</h6></label>
                                                            <select class="form-control" id="gender" name="gender" required>
                                                                <option selected value="{{ old('gender') }}"></option>
                                                                @foreach ($genders as $gender)
                                                                    <option value="{{ $gender->id }}">{{ $gender->gender_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="marital_status"><h6 class="profile-title">Marital status</h6></label>
                                                            <select class="form-control" id="marital_status" name="marital_status" required>
                                                                <option selected value="{{ old('marital_status') }}"></option>
                                                                @foreach ($marital_statuses as $marital_status)
                                                                    <option value="{{ $marital_status->id }}">{{ $marital_status->marital_status_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col">
                                                            <label for="birthdate"><h6 class="profile-title">Birth date</h6></label>
                                                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col">
                                                            <label for="date_hired"><h6 class="profile-title">Date Hired</h6></label>
                                                            <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ old('date_hired') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 border-start border-warning border-5">
                                                    <div class="row mt-4 mb-1">
                                                        <div class="col">
                                                            <h5 class="profile-title-header">Account Details</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col">
                                                            <label for="email"><h6 class="profile-title">Email</h6></label>
                                                            <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col">
                                                            <label for="user_name"><h6 class="profile-title">Username</h6></label>
                                                            <input type="user_name" class="form-control" id="user_name" placeholder="" name="user_name" value="{{ old('user_name') }}" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="contact_number"><h6 class="profile-title">Contact number</h6></label>
                                                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="department"><h6 class="profile-title">Department</h6></label>
                                                            <select class="form-control" id="department" name="department">
                                                                <option disabled selected value="">Select department</option>
                                                                @foreach ($departments as $department)
                                                                    <option value="{{ $department->id }}">{{ $department->department_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12 placeholder-glow">
                                                            <label for="subdepartment"><h6 class="profile-title">Sub-department</h6></label>
                                                            <div class="spinner-border text-primary spinner-border-sm d-none" id="spinner_subdepartment" role="status" >
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                            <select class="form-control" id="subdepartment" name="subdepartment">
                                                                <option value="" disabled selected>Select Sub-department</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col-lg-6 col-md-12 col-sm-12 placeholder-glow">
                                                            <label for="position"><h6 class="profile-title">Position</h6></label>
                                                            <div class="spinner-border text-primary spinner-border-sm d-none" id="spinner_position" role="status" >
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                            <select class="form-control " id="position" name="position" required>
                                                                <option value="" disabled selected>Select position</option>
                                                                <option selected value="{{ old('position') }}"></option>
                                                                @foreach ($positions as $position)
                                                                    <option value="{{ $position->id }}">{{ $position->position_description }} ({{ $position->subdepartments->departments->department_title }}) </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="sap_id_number"><h6 class="profile-title">ID Number</h6></label>
                                                            <input type="text" class="form-control" id="sap_id_number" name="sap_id_number" value="{{ old('sap_id_number') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-1">
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="area_of_assignment"><h6 class="profile-title">Area of assignment</h6></label>
                                                            <select class="form-control" id="area_of_assignment" name="area_of_assignment" required>
                                                                <option selected value="{{ old('area_of_assignment') }}"></option>
                                                                @foreach ($area_of_assignments as $area_of_assignment)
                                                                    <option value="{{ $area_of_assignment->id }}">{{ $area_of_assignment->location_address }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                            <label for="employee_status"><h6 class="profile-title">Employment Status</h6></label>
                                                            <select class="form-control" id="employee_status" name="employee_status" required>
                                                                <option selected value="{{ old('employee_status') }}"></option>
                                                                @foreach ($employment_statuses as $employment_status)
                                                                    <option value="{{ $employment_status->id }}">{{ $employment_status->employment_status_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                                    <button type="submit" id="submit_button1" class="btn btn-success">Add Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $('#department').on('change',function(){
                            let id = $(this).val();
                            $('#subdepartment').empty();
                            $('#subdepartment').addClass('placeholder');
                            $('#position').addClass('placeholder');
                            $('#spinner_subdepartment').removeClass('d-none');
                            $('#spinner_position').removeClass('d-none');
                            $('#subdepartment').append('<option value="0" disabled selected >Processing...</option>');
                            $('#position').append('<option value="0" disabled selected>Processing...</option>');
                            $.ajax({
                                type: 'GET',
                                url: '/addAccount/getSubdepartment/'+id,
                                success: function (response){
                                    var response = JSON.parse(response);
                                    console.log(response);
                                    $('#subdepartment').empty();
                                    $('#position').empty();
                                    $('#subdepartment').removeClass('placeholder');
                                    $('#position').removeClass('placeholder');
                                    $('#spinner_subdepartment').addClass('d-none');
                                    $('#spinner_position').addClass('d-none');
                                    $('#subdepartment').append('<option value="0" disabled selected>*Select Sub-department</option>');
                                    $('#position').append('<option value="0" disabled selected>*Select Sub-department</option>');
                                    response.forEach(element => {
                                        $('#subdepartment').append(`<option value="${element['id']}">${element['sub_department_title']}</option>`);
                                    });
                                }
                            });
                        });
                        $('#subdepartment').on('change',function(){
                            let id = $(this).val();
                            $('#position').empty();
                            $('#position').append('<option value="0" disabled selected>Processing...</option>');
                            $('#position').addClass('placeholder');
                            $('#spinner_position').removeClass('d-none');
                            $.ajax({
                                type: 'GET',
                                url: '/addAccount/getPosition/'+id,
                                success: function (response){
                                    var response = JSON.parse(response);
                                    console.log(response);
                                    $('#position').empty();
                                    $('#position').removeClass('placeholder');
                                    $('#spinner_position').addClass('d-none');
                                    $('#position').append('<option value="0" disabled selected>*Select Position</option>');
                                    response.forEach(element => {
                                        $('#position').append(`<option value="${element['id']}">${element['position_description']}</option>`);
                                    });
                                }
                            });
                        });
                    });
                </script>
            {{-- End Add Account Modal --}}
        </div>
    </div>

    <div class="sub-content mb-5 bg-light p-3" id="form_submit" >
        @yield('sub-content')
    </div>

</div>

@endsection
