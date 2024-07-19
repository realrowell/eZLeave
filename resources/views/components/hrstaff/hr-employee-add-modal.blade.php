<div class="modal fade" id="AddAccountModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>
        <div class="modal-content border-top-0 border-end-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('admin_create_employee') }}" method="POST" onsubmit="onFormSubmit()">
                @csrf
                <div class="modal-body" id="form_to_submit">
                    <div class="container-fluid text-start">
                        <div class="row ms-2 mb-3">
                            <div class="row p-3">
                                <div class="col-6">
                                    <h5 class="profile-title-header" id="staticBackdropLabel">Create Employee Account</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="row ps-3 pe-3 text-dark">
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mb-3">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <h5 class="profile-title-header">Personal Information</h5>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-1" >
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
                                            <label for="middlename"><h6 class="profile-title">Middle name <span class="text-secondary">(optional)</span></h6></label>
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
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mb-3">
                                    <div class="row  mb-1">
                                        <div class="col">
                                            <h5 class="profile-title-header">Account Details</h5>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-1">
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
                                            <label for="contact_number"><h6 class="profile-title">Contact number <span class="text-secondary">(optional)</span></h6></label>
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
                                            <label for="sap_id_number"><h6 class="profile-title">ID Number <span class="text-secondary">(optional)</span></h6></label>
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
                    <div class="container-fluid text-start">
                        <div class="row ms-2 me-3">
                            <div class="col-6">
                                <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-6 text-end ">
                                <button type="submit" id="submit_button1" class="btn btn-success ps-3 pe-3 rounded-0">Create Account</button>
                            </div>
                        </div>
                    </div>
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
