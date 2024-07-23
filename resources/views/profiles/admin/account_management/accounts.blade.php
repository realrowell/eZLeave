@extends('profiles.admin.admin_dashboard_layout')
@section('title','Account Management')
@section('sidebar_employee_management_active','active')
@section('sub-content')



<div class="row">
    <div class="container-fluid">
        <div class="row mt-3 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
            <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_all')" style="min-height: 1rem" >
                <a href="{{ route('admin_accounts_grid') }}" class="@yield('submenu_all')">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>All Accounts</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_admin')" style="min-height: 1rem" >
                <a href="#" class="@yield('submenu_admin')">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Admin Accounts</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_employee')" style="min-height: 1rem" >
                <a href="#" class="@yield('submenu_employee')">
                    <div class="col text-light-hover">
                        <div class="card-body">
                            <h6>Employee Accounts</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-3 bg-light shadow">
        <div class="row p-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row">
                    <form action="{{ route('admin_accounts_search_grid') }}" onkeyup="searchBtnEnable()">
                    @csrf
                        <div class="input-group">
                            <input type="search" class="form-control form-control-sm rounded-0" name="search_input" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-sm btn-primary ps-3 pe-3 rounded-0 disabled" id="search_btn">search</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <p>*Search employee by first name or by last name here</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end mt-2">
                <a href="{{ route('admin_accounts_grid') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('grid_active')">
                    <i class='fs-6 bx bxs-grid-alt' ></i>
                    Grid View
                </a>
                <a href="{{ route('admin_accounts_list') }}" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3 @yield('list_active')">
                    <i class='fs-6 bx bx-list-ul' ></i>
                    List View
                </a>
                <a href="#AddAccount" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#AddAccountModal">
                    <i class='bx bxs-user-plus' ></i>
                    Apply Account
                </a>
                <a href="#AddEmployee" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#AddEmployeeModal">
                    <i class='bx bxs-user-plus' ></i>
                    Apply Employee
                </a>
                <!-- Add Account Modal -->
                    <x-admin.admin-account-add-modal>
                    </x-admin.admin-account-add-modal>
                {{-- End Add Account Modal --}}
                <!-- Add Employee Modal -->
                    <x-hrstaff.hr-employee-add-modal>
                    </x-hrstaff.hr-employee-add-modal>
                    <div class="modal fade" id="AddEmployeeModal1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
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
                {{-- End Add Employee Modal --}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                @yield('sub-sub-content')
            </div>
        </div>
    </div>
</div>
@endsection
