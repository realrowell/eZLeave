@extends('includes.employee_empty_layout')
@section('title','Password Reset')
@section('content')

<div class="container" id="profile-body">
    <div class="row pt-5">
        <div class="col-lg-2 col-md-2 col-sm-12 col-12"></div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="container bg-light mt-5 p-5 shadow">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12 col-12"></div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                        <div class="row text-center ">
                            <div class="col ">
                                <h3 class="fw-bold" style="color: var(--header-bg)">Password Reset</h3>
                            </div>
                        </div>
                        <div class="row text-center ps-4 pe-4">
                            <div class="col ">
                                <p class=" mb-0" >We highly recommended to change your default password. Please change it to more secure one.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12 col-12"></div>
                </div>
                <div class="row pt-3 pb-5">
                    <div class="col-lg-1 col-md-1 col-sm-12 col-12"></div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                        <form action="{{ route('employee.password.reset') }}" method="POST">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="label">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="label">
                                            <label for="password_confirmation">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="row mt-3 text-center">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary ps-5 pe-5 rounded-0">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12 col-12"></div>
                </div>
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12 col-12"></div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                        <div class="row text-center ps-4 pe-4">
                            <div class="col ">
                                <p class=" mb-0" >If you encounter a problem, please contact support at <a href="mailto:support@bioseed.com.ph" class=""style="color: var(--header-bg)">support@bioseed.com.ph</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12 col-12"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-12"></div>
    </div>
</div>


@endsection
