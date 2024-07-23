<div class="modal fade" id="AddAccountModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="spinner-border text-primary" id="loading_spinner_2" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>
        <div class="modal-content border-top-0 border-end-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('admin_create_account') }}" method="POST" onsubmit="onFormSubmit_1()">
                @csrf
                <div class="modal-body" id="form_to_submit_2">
                    <div class="container-fluid text-start mb-4">
                        <div class="row p-3">
                            <div class="col-6">
                                <h5 class="profile-title-header" id="staticBackdropLabel">Create Account <span class="text-secondary">(Admin Account)</span></h5>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row ps-3 pe-3 mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row mt-3 mb-1">
                                    <div class="col">
                                        <h5 class="profile-title-header">Personal Information</h5>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-1" >
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="firstname"><h6 class="profile-title">First name</h6></label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="lastname"><h6 class="profile-title">Last name</h6></label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
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
                                            <option selected value="">-- N/A --</option>
                                            @foreach ($suffixes as $suffix)
                                                <option value="{{ $suffix->id }}">{{ $suffix->suffix_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <div class="col">
                                        <label for="role"><h6 class="profile-title">Role</h6></label>
                                        <select class="form-control" id="role" name="role">
                                            <option selected disabled>-- Select Role --</option>
                                            @foreach ($roles as $role)
                                                @if ($role->id != 'rol-0003')
                                                    <option value="{{ $role->id }}">{{ $role->role_title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row mt-4 mb-1">
                                    <div class="col">
                                        <h5 class="profile-title-header">Account Details</h5>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <div class="col">
                                        <label for="email"><h6 class="profile-title">Email</h6></label>
                                        <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <div class="col">
                                        <label for="user_name"><h6 class="profile-title">Username</h6></label>
                                        <input type="user_name" class="form-control" id="user_name" placeholder="" name="user_name" value="{{ old('user_name') }}">
                                    </div>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <div class="col-lg-6 col-md-12 col-sm-12 ">
                                        <label for="password"><h6 class="profile-title">Password</h6></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" placeholder="" name="password" value="{{ old('password') }}" required>
                                            <button type="button" class="btn rounded-end btn-outline-primary" id="show_password" onclick="showPass()">
                                                show
                                            </button>
                                            <button type="button" class="btn rounded-end btn-outline-primary" id="hide_password" onclick="hidePass()" hidden>
                                                hide
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="repassword"><h6 class="profile-title">Re-type password</h6></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                            <button type="button" class="btn rounded-end btn-outline-primary" id="show_repassword" onclick="showRePass()">
                                                show
                                            </button>
                                            <button type="button" class="btn rounded-end btn-outline-primary" id="hide_repassword" onclick="hideRePass()" hidden>
                                                hide
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row ps-3 pe-3">
                            <div class="col text-start">
                                <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col text-end">
                                <button id="submit_button_2" type="submit" class="btn btn-success rounded-0 ps-3 pe-3">Create Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
