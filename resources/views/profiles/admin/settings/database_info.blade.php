@extends('profiles.admin.settings.system_settings_layout')
@section('title','Database Info | Admin')
@section('submenu_app_info','text-dark')
@section('submenu_system_info',' text-dark')
@section('submenu_database_info','bg-selected-primary text-light')
@section('submenu_other_info',' text-dark')
@section('sub-sub-content')

<div class="row">
    <div class="col">
        <h5>Database Information</h5>
    </div>
</div>
<div class="row">
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        DB_CONNECTION
                    </div>
                    <div class="col">
                        {{ env("DB_CONNECTION", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        DB_HOST
                    </div>
                    <div class="col">
                        {{ env("DB_HOST", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        DB_PORT
                    </div>
                    <div class="col">
                        {{ env("DB_PORT", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        DB_DATABASE
                    </div>
                    <div class="col">
                        {{ env("DB_DATABASE", "No Data Available") }}m
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
