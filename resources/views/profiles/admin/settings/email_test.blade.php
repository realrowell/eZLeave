@extends('profiles.admin.settings.email_settings_layout')
@section('title','Test Email | Admin')
@section('submenu_email_info','text-dark')
@section('submenu_test_email','bg-selected-primary text-light')
@section('sub-sub-content')

<div class="row">
    <div class="col">
        <h5>Email Test</h5>
    </div>
</div>
<div class="row pb-5">
    <div class="col">
        <form action="{{ route('email.test') }}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col">
                        Email from address
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <input type="email" name="send_to" id="send_to" class="form-control form-control-sm" value="{{ env("MAIL_FROM_ADDRESS", "No Data Available") }}" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        Email from name
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <input type="email" name="send_to" id="send_to" class="form-control form-control-sm" value="{{ env("MAIL_FROM_NAME", "No Data Available") }}" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="send_to">Send to</label>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <input type="email" name="send_to" id="send_to" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="body_msg">Message (optional)</label>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <textarea name="body_msg" id="" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
                <div class="row mt-3 text-end">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ps-5 pe-5">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
