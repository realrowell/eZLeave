@extends('includes.home_layout')
@section('title','HOME')
@section('content')
{{-- <aside>
    hello world
</aside> --}}
<section id="main">
    <div id="home_content" class="" style="">
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
                                <img id="logo" class="" src="/img/bioseed_logo.png" alt="bioseed_logo" style="width: 100px">
                                <h2 class="card-title">Welcome Back! </h2>
                            </div>
                            <div class="row mt-4 card-body">
                                <form method="POST" action="{{ route('login') }}" onsubmit="changeClass();" id="login_form">
                                    @csrf
                                    <div class="row">
                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="form-label text-start">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control readonly @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password" class="form-label text-start">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
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
                                        <button id="login_submit" type="submit" class="btn btn-success" onclick="onClickSubmit()">
                                            {{ __('Login') }}
                                        </button>
        
                                        <div class="row mt-3">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="container-fluid text-center">
                                <img id="logo" class="" src="img/bioseed_logo.png" alt="" style="width: 75px">
                                <h2 class="card-title">Welcome Back! </h2>
                            </div>
                            <br>   
                            <label for="email" class="card-text text-start">Email</label>
                            <input type="email" id="email" class="form-control">
                            <br>
                            <label for="email" class="card-text text-start">Password</label>
                            <input type="password" id="password" class="form-control">
                            <br>
                            <div class="d-grid gap-2">
                                <a href="/profile/dashboard" type="submit" class="btn btn-success">Login</a>
                                <button type="submit" class="form-submit btn btn-success">Login</button>
                                @error('error')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <br>
                        </form> --}}
                        
                        {{-- <div class="d-grid gap-2 text-center">
                            <a class="align-text-center" href="#">forgot your password?</a>
                        </div> --}}
                        
                        <br>
                    </div>
                </div>
            </div>
    </div>
</section>

@endsection