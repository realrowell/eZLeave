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
                                <h2 class="card-title">Welcome Back Admin!</h2>
                            </div>
                            <div class="row mt-4 card-body">
                                <form method="POST" action="/admin_login" onsubmit="changeClass()">
                                    @csrf
                                    <div class="row">
                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="form-label text-start">{{ __('Email Address') }}</label>
            
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
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
            
                                    <div class="row mb-2 mt-5">
                                        <button id="login_submit" type="submit" class="btn btn-success">
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
                        <br>
                    </div>
                </div>
            </div>
    </div>
</section>

@endsection