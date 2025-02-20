@extends('profiles.admin.settings.system_settings_layout')
@section('title','System Info | Admin')
@section('submenu_app_info','text-dark')
@section('submenu_system_info','bg-selected-primary text-light')
@section('submenu_database_info',' text-dark')
@section('submenu_other_info',' text-dark')
@section('sub-sub-content')

<div class="row">
    <div class="col">
        <h5>System Information</h5>
    </div>
</div>
<div class="row">
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        Laravel Version
                    </div>
                    <div class="col">
                        {{ app()->version() }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        PHP Version
                    </div>
                    <div class="col">
                        {{ phpversion() }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        SESSION_DRIVER
                    </div>
                    <div class="col">
                        {{ env("SESSION_DRIVER", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        SESSION_LIFETIME
                    </div>
                    <div class="col">
                        {{ env("SESSION_LIFETIME", "No Data Available") }}m
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
