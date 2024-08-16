@extends('profiles.admin.settings.email_settings_layout')
@section('title','Email Info | Admin')
@section('submenu_email_info','bg-selected-primary text-light')
@section('submenu_test_email',' text-dark')
@section('sub-sub-content')

<div class="row">
    <div class="col">
        <h5>Email Information</h5>
    </div>
</div>
<div class="row">
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        MAIL_MAILER
                    </div>
                    <div class="col">
                        {{ env("MAIL_MAILER", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        MAIL_HOST
                    </div>
                    <div class="col">
                        {{ env("MAIL_HOST", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        MAIL_PORT
                    </div>
                    <div class="col">
                        {{ env("MAIL_PORT", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        MAIL_USERNAME
                    </div>
                    <div class="col">
                        {{ env("MAIL_USERNAME", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        MAIL_ENCRYPTION
                    </div>
                    <div class="col">
                        {{ env("MAIL_ENCRYPTION", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        MAIL_FROM_ADDRESS
                    </div>
                    <div class="col">
                        {{ env("MAIL_FROM_ADDRESS", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        MAIL_FROM_NAME
                    </div>
                    <div class="col">
                        {{ env("MAIL_FROM_NAME", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
