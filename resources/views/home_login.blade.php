@extends('includes.home_layout')
@section('title','HOME | Login')
@section('content')

<section id="main">
    <div id="home_content" class="" style="background-image: url({{ asset('img/bg_home.jpg') }}) ">
        <div class="container text-start">
            <div class="row align-items-start">
                <div class="col-md-6 col-lg-6" style="">

                </div>
                {{-- <div class="col-md-4 col-lg-4 col-sm-3" style="">

                </div> --}}
                <div id="card_login_form" class="col-md-6 col-lg-6 card_login_form" style=" padding-top:10vh;">
                    <div class="card-body" style="">
                        <div class="container-fluid text-center">
                            <div class="row justify-content-center">
                                <img id="logo" class="" src="{{ asset('img/bioseed_logo.png') }}" alt="bioseed_logo" style="width: 100px">
                                <h2 class="card-title">Welcome Back! </h2>
                            </div>
                            <div class="row mt-4 card-body">
                                <form method="POST" action="{{ route('login') }}" onsubmit="changeClass();onClickSubmit()" id="login_form">
                                    @csrf
                                    <div class="row">
                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="form-label text-start">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control rounded-0 readonly @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password" class="form-label text-start">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="spinner-border text-primary" id="loading_spinner" role="status" style="display: none;">
                                        <span class="visually-hidden" >Loading...</span>
                                    </div>

                                    <div class="row mb-2 mt-5">
                                        <button id="login_submit" type="submit" class="btn btn-success rounded-0" >
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                    <div class="row mt-3">
                                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                            Forgot Your Password?
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="container-fluid text-center">
                            <div class="row mt-3">
                                <div class="col-5">
                                    <hr class="hr" />
                                </div>
                                <div class="col-2 text-center">
                                    OR
                                </div>
                                <div class="col-5">
                                    <hr class="hr" />
                                </div>
                            </div>
                            <div class="row">
                                {{-- @production --}}
                                    <a href="{{ route('google.redirect') }}" class="btn mt-2 rounded-0 text-light" style="background-color: #4C8BF5">
                                        <img class="bg-light rounded-pill me-2" src="{{ asset('img/google_g_logo.svg') }}" alt="">
                                        Continue with Google Workspace
                                    </a>
                                {{-- @endproduction --}}
                            </div>
                        </div>
                        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content rounded-0 p-3 border border-end-0 border-top-0 border-bottom-0 border-warning border-5">
                                    <div class="modal-body p-4">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h3 class="modal-title" id="exampleModalLabel">Forgot Password?</h3>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <p>If you’ve forgotten your password or need to reset it, please follow these steps:</p>
                                                <ol>
                                                    <li><b>Contact the System Administrator:</b> Reach out to our system administrator directly. They will assist you in resetting your password.</li>
                                                    <li><b>Provide Necessary Details:</b> Be ready to provide your username, email, or any other relevant information to verify your identity.</li>
                                                </ol>
                                                <p><b>Remember</b>, your account security is our priority. Thank you for keeping your credentials safe!</p>
                                                <p>Contact Support at: <a href="mailto:support@bioseed.com.ph&subject=EZLEAVE%20Login%20Credential%20Issue" target="_top">support@bioseed.com.ph</a> </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                          </div>
                        <br>
                    </div>
                </div>
            </div>
    </div>
</section>

@endsection
