@extends('includes.hrstaff_layout')
@section('title','Employee Management')
@section('sidebar_employee_management_active','active')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-4 col-lg-6 mt-2">
            <h3><a href="{{ route('admin_accounts_grid') }}" class="text-dark">Employee Management</a> /
                <a href="#" class="text-dark">Profile</a>
            </h3>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6 justify-content-end align-items-end text-end mt-2">

        </div>
    </div>
    <div class="row justify-content-center align-items-start d-flex gap-2 mb-5">
        <div class="col-lg-3 col-md-3 col-sm-10 bg-light align-self-stretch shadow bg-gradient-primary m-2" >

            <div class="row">
                <div class="col text-center p-5">
                    <div class="row justify-content-center align-items-start">
                        <div class="profile-photo-box align-items-start pt-3 pb-4">
                            @if ($profile_photo == null)
                                <img class="profile-photo" src="/img/dummy_profile.jpg" alt="profile photo">
                            @else
                                <img class="profile-photo" src="{{ asset('storage/images/profile_photos/'.$profile_photo->profile_photo) }}" alt="profile photo">
                            @endif
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto mb-3">
                        {{-- <button class="btn btn-sm btn-primary" type="button">Upload Profile Photo</button> --}}
                        <div class="form-control form">
                            <form action="{{ route('admin_update_profile_photo',['username'=>$user->user_name]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="profile_photo" class="form-label mt-3">Upload Profile Photo</label>
                                <input class="form-control" type="file" id="profile_photo" name="profile_photo">
                                <button class="form-control btn btn-sm btn-primary mt-4 mb-3" type="submit">Upload</button>
                            </form>
                        </div>
                    </div>
                    <h4 class="text-light text-shadow-1">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ optional($user->suffixes)->suffix_title }}</h4>
                    <div class="text-light">
                        @if ($user->status_id == 'sta-2001')
                            <p class="card-desc badge bg-success">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2002')
                            <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2003')
                            <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2004')
                            <p class="card-desc badge bg-danger">{{ optional($user->statuses)->status_title }}</p>
                        @elseif ($user->status_id == 'sta-2002')
                            <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-10">
            <div class="row bg-light mt-2 z-1 p-1 ps-4 m-1 shadow">
                <div class="row justify-content-start align-items-start text-start">
                    <div class="col">
                        <a href="{{ route('admin_visit_employee_view',['username'=>$user->user_name]) }}" class="ms-1 me-1 p-2 custom-primary-button bg-selected-warning">
                            Profile
                        </a>
                        <a href="#regular" class="ms-1 me-1 p-2 custom-primary-button @yield('grid_active') ">
                            Leave MS
                        </a>
                    </div>
                </div>
                {{-- PROFILE Fields --}}
                <form action="{{ route('admin_update_employee',['user_id'=>$user->id,'employee_id'=>$user->employees->id]) }}" method="POST" onsubmit="submitButtonDisabled()">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="row mt-5">
                            <div class="col-lg-4 col-md-3 col-sm-12">
                                <h3>Employee details</h3>
                            </div>
                            <div class="col-lg-8 col-md-9 col-sm-12">
                                <div class="text-end d-flex gap-3 justify-content-end">
                                    <a href="{{ URL::previous() }}" class="btn btn-danger">Discard Changes</a>
                                    <button id="submit_button1" type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <div class="row mt-2 mb-1" >
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">First name</h6>
                                        <input type="text" class="form-control" id="first_name" name="firstname" value="{{ $user->first_name }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Middle name</h6>
                                        <input type="text" class="form-control" id="middle_name" name="middlename" value="{{ $user->middle_name }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Last name</h6>
                                        <input type="text" class="form-control" id="last_name" name="lastname" value="{{ $user->last_name }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Suffix</h6>
                                        <select class="form-control" id="suffix" name="suffix">
                                            @if ($user->suffix_id == null)
                                                <option selected value="">N/A</option>
                                                @foreach ($suffixes as $suffix)
                                                    <option value="{{ $suffix->id }}">{{ $suffix->suffix_title }}</option>
                                                @endforeach
                                            @else
                                                <option selected value="{{ null }}">remove</option>
                                                <option selected value="{{ $user->suffix_id }}">{{ optional($user->suffixes)->suffix_title }}</option>
                                                @foreach ($suffixes as $suffix)
                                                    @if ($suffix->id != $user->suffix_id)
                                                        <option value="{{ $suffix->id }}">{{ $suffix->suffix_title }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Sex</h6>
                                        <select class="form-control" id="gender" name="gender">
                                            <option selected value="{{ $user->employees->gender_id }}">{{ optional($user->employees->genders)->gender_title }}</option>
                                            @foreach ($genders as $gender)
                                                @if ($user->employees->gender_id != $gender->id)
                                                    <option value="{{ $gender->id }}">{{ $gender->gender_title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Marital Status</h6>
                                        <select class="form-control" id="marital_status" name="marital_status">
                                            <option selected value="{{ $user->employees->marital_status_id }}">{{ optional($user->employees->marital_statuses)->marital_status_title }}</option>
                                            @foreach ($marital_statuses as $marital_status)
                                                @if ($marital_status->id != $user->employees->marital_status_id)
                                                    <option value="{{ $marital_status->id }}">{{ $marital_status->marital_status_title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Birth Date</h6>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ optional($user->employees)->birthdate }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Contact Number</h6>
                                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ optional($user->employees)->contact_number }}">
                                    </div>
                                </div>
                                <div class="row mt-5 mb-5">
                                    <div class="mb-2 col-lg-12 col-md-12 col-sm-12">
                                        <h6 class="profile-title">Address line 1</h6>
                                        <input type="text" class="form-control" id="address_line_1" name="address_line_1" value="{{ optional($user->employees->employee_addresses)->address_line_1 }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">City</h6>
                                        <input type="text" class="form-control" id="address_city" name="address_city" value="{{ optional($user->employees->employee_addresses)->city }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Province</h6>
                                        <input type="text" class="form-control" id="address_province" name="address_province" value="{{ optional($user->employees->employee_addresses)->province }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Region</h6>
                                        <input type="text" class="form-control" id="address_region" name="address_region" value="{{ optional($user->employees->employee_addresses)->region }}">
                                    </div>
                                </div>
                                <div class="row mt-5 mb-3">
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Employment status</h6>
                                        <select class="form-control" id="employment_status" name="employment_status">
                                            <option selected value="{{ $user->employees->employment_status_id }}">{{ optional($user->employees->employment_statuses)->employment_status_title }}</option>
                                            @foreach ($employment_statuses as $employment_status)
                                                @if ($employment_status->id != $user->employees->employment_status_id)
                                                    <option value="{{ $employment_status->id }}">{{ $employment_status->employment_status_title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Date hired</h6>
                                        <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ optional($user->employees)->date_hired }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                        <h6 class="profile-title">ID Number</h6>
                                        <input type="text" class="form-control" id="sap_id_number" name="sap_id_number" value="{{ optional($user->employees)->sap_id_number }}">
                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">

                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Reports to</h6>
                                        <select class="form-control" id="reports_to" name="reports_to">
                                            @if (optional(optional($user->employees->employee_positions)->positions)->position_level_id != 'psl-1002' && optional(optional($user->employees->employee_positions)->positions)->position_level_id != 'psl-1001')
                                                @if ( !empty(optional($user->employees->employee_positions)->reports_to_id))
                                                    <option selected value="{{ $user->employees->employee_positions->reports_to_id }}">{{ $reports_to }}</option>
                                                    @foreach ($user_reports_tos as $user_reports_to)
                                                        @if (optional(optional(optional($user_reports_to->employee_positions)->positions)->subdepartments)->department_id == optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->department_id)
                                                            <option value="{{ optional($user_reports_to->users->employees)->id }}">
                                                                {{ optional($user_reports_to->users)->first_name }}
                                                                {{ optional($user_reports_to->users)->middle_name }}
                                                                {{ optional($user_reports_to->users)->last_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option selected disabled > - Please Select - </option>
                                                    @foreach ($user_reports_tos as $user_reports_to)
                                                        @if (optional(optional(optional($user_reports_to->employee_positions)->positions)->subdepartments)->department_id == optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->department_id)
                                                            <option value="{{ optional($user_reports_to->users->employees)->id }}">
                                                                {{ optional($user_reports_to->users)->first_name }}
                                                                {{ optional($user_reports_to->users)->middle_name }}
                                                                {{ optional($user_reports_to->users)->last_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @else
                                                <option selected disabled > - Please Select - </option>
                                                @foreach ($user_reports_tos as $user_reports_to)
                                                    @if (optional(optional($user_reports_to->employee_positions)->positions)->position_level_id == optional(optional($user->employee_positions)->positions)->position_level_id || optional(optional($user_reports_to->employee_positions)->positions)->position_level_id <= optional(optional($user->employee_positions)->positions)->position_level_id)
                                                        <option value="{{ optional($user_reports_to->users->employees)->id }}">
                                                            {{ optional($user_reports_to->users)->first_name }}
                                                            {{ optional($user_reports_to->users)->middle_name }}
                                                            {{ optional($user_reports_to->users)->last_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1 mb-1">
                                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Second superior</h6>
                                        <select class="form-control" id="second_reports_to" name="second_reports_to">
                                            @if (optional(optional($user->employees->employee_positions)->positions)->position_level_id != 'psl-1002' && optional(optional($user->employees->employee_positions)->positions)->position_level_id != 'psl-1001')
                                                @if ( !empty(optional($user->employees->employee_positions)->reports_to_id))
                                                    <option selected value="{{ $user->employees->employee_positions->second_superior_id }}">{{ $second_reports_to }}</option>
                                                    @foreach ($user_reports_tos as $user_reports_to)
                                                        @if (optional(optional(optional($user_reports_to->employee_positions)->positions)->subdepartments)->department_id == optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->department_id)
                                                            <option value="{{ optional($user_reports_to->users->employees)->id }}">
                                                                {{ optional($user_reports_to->users)->first_name }}
                                                                {{ optional($user_reports_to->users)->middle_name }}
                                                                {{ optional($user_reports_to->users)->last_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option selected disabled > - Please Select - </option>
                                                    @foreach ($user_reports_tos as $user_reports_to)
                                                        @if (optional(optional(optional($user_reports_to->employee_positions)->positions)->subdepartments)->department_id == optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->department_id)
                                                            <option value="{{ optional($user_reports_to->users->employees)->id }}">
                                                                {{ optional($user_reports_to->users)->first_name }}
                                                                {{ optional($user_reports_to->users)->middle_name }}
                                                                {{ optional($user_reports_to->users)->last_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @else
                                                <option selected disabled > - Please Select - </option>
                                                @foreach ($user_reports_tos as $user_reports_to)
                                                    @if (optional(optional($user_reports_to->employee_positions)->positions)->position_level_id == optional(optional($user->employee_positions)->positions)->position_level_id || optional(optional($user_reports_to->employee_positions)->positions)->position_level_id <= optional(optional($user->employee_positions)->positions)->position_level_id)
                                                        <option value="{{ optional($user_reports_to->users->employees)->id }}">
                                                            {{ optional($user_reports_to->users)->first_name }}
                                                            {{ optional($user_reports_to->users)->middle_name }}
                                                            {{ optional($user_reports_to->users)->last_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    @if ($user->employees->employee_position_id == null)
                                        <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                            <h6 class="profile-title">Position</h6>
                                            <select class="form-control" id="position" name="position" required>
                                                <option selected value="{{ optional($user->employees->employee_positions)->position_id }}">{{ optional(optional($user->employees->employee_positions)->positions)->position_description }}</option>
                                                @foreach ($positions as $position)
                                                    @if ($position->id != optional($user->employees->employee_positions)->position_id)
                                                        <option value="{{ $position->id }}">{{ $position->position_description }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                            <h6 class="profile-title">Area of assignment</h6>
                                            <select class="form-control" id="area_of_assignment" name="area_of_assignment" required>
                                                <option selected value="{{ optional($user->employees->employee_positions)->area_of_assignment_id }}">{{ optional(optional($user->employees->employee_positions)->area_of_assignments)->location_address }}</option>
                                                @foreach ($area_of_assignments as $area_of_assignment)
                                                    @if ($area_of_assignment->id != optional($user->employees->employee_positions)->area_of_assignment_id)
                                                        <option value="{{ $area_of_assignment->id }}">{{ $area_of_assignment->location_address }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                            <h6 class="profile-title">Position</h6>
                                            <select class="form-control" id="position" name="position">
                                                <option selected value="{{ optional($user->employees->employee_positions)->position_id }}">{{ optional(optional($user->employees->employee_positions)->positions)->position_description }}</option>
                                                @foreach ($positions as $position)
                                                    @if ($position->id != optional($user->employees->employee_positions)->position_id)
                                                        <option value="{{ $position->id }}">{{ $position->position_description }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                                            <h6 class="profile-title">Area of assignment</h6>
                                            <select class="form-control" id="area_of_assignment" name="area_of_assignment">
                                                <option selected value="{{ optional($user->employees->employee_positions)->area_of_assignment_id }}">{{ optional(optional($user->employees->employee_positions)->area_of_assignments)->location_address }}</option>
                                                @foreach ($area_of_assignments as $area_of_assignment)
                                                    @if ($area_of_assignment->id != optional($user->employees->employee_positions)->area_of_assignment_id)
                                                        <option value="{{ $area_of_assignment->id }}">{{ $area_of_assignment->location_address }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">

                                    </div>
                                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">

                                    </div>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <i class="text-danger">*update the position field to automatically update the fields below</i>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h6 class="profile-title">Sub-department</h6>
                                        <h6 class="profile-title-value">{{ optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->sub_department_title }}</h6>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                        <h6 class="profile-title">Department </h6>
                                        <h6 class="profile-title-value">{{ optional(optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <h3>Account details</h3>
                        </div>
                        <div class="row mt-1">
                            <div class="row mt-2 mb-1">
                                <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Email</h6>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="row mt-2 mb-1">
                                <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                    <h6 class="profile-title">User name</h6>
                                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $user->user_name }}">
                                </div>
                            </div>
                            <div class="row mt-2 mb-1">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Password</h6>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" placeholder="" name="password" value="{{ old('password') }}">
                                            <button type="button" class="btn rounded-end btn-outline-primary" id="show_password" onclick="showPass()">
                                                show
                                            </button>
                                            <button type="button" class="btn rounded-end btn-warning" id="hide_password" onclick="hidePass()" hidden>
                                                hide
                                            </button>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h6 class="profile-title">Retype Password</h6>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                        <button type="button" class="btn rounded-end btn-outline-primary" id="show_repassword" onclick="showRePass()">
                                            show
                                        </button>
                                        <button type="button" class="btn rounded-end btn-warning" id="hide_repassword" onclick="hideRePass()" hidden>
                                            hide
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-1">
                                <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                    <a href="#" class="profile-title-value btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reset_password_modal">reset password</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                @if ($user->status_id == 'sta-2001')
                                    <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                        <a href="#" class="profile-title-value btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deactivate_account_modal">Deactivate Account</a>
                                    </div>
                                @elseif ($user->status_id == 'sta-2002')
                                    <div class="mb-2 col-lg-4 d-grid gap-2 col-md-6 col-sm-12">
                                        <a href="#" class="profile-title-value btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#activate_account_modal">Activate Account</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3 mb-5">
                            <div class="mb-2 col-lg-6 col-md-6 col-sm-12 text-end d-grid gap-2 mx-auto">
                                <button id="submit_button2" type="submit" class="btn btn-success">Save Changes</button>
                                <a href="{{ URL::previous() }}" class="btn btn-danger">Discard Changes</a>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- END PROFILE Fields --}}
                <!-- confirm reset password Modal -->
                    <div class="modal fade" id="reset_password_modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid text-start">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h2>Please confirm to reset the password</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('account_reset_password',['username'=>$user->user_name]) }}" method="PUT" onsubmit="onClickApprove()">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- end confirm reset password Modal --}}
                <!-- deactivate account Modal -->
                    <div class="modal fade" id="deactivate_account_modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid text-start">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h2>Please confirm to deactivate account</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('account_deactivate',['username'=>$user->user_name]) }}" method="PUT" onsubmit="onClickApprove()">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- end deactivate account Modal --}}
                <!-- activate account Modal -->
                <div class="modal fade" id="activate_account_modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid text-start">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h2>Please confirm to activate account</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('account_activate',['username'=>$user->user_name]) }}" method="PUT" onsubmit="onClickApprove()">
                                    @csrf
                                    <button class="btn btn-success" type="submit">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- end activate account Modal --}}
            </div>
        </div>
    </div>
</div>
@endsection
