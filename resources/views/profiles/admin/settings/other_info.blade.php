@extends('profiles.admin.settings.system_settings_layout')
@section('title','Other Info | Admin')
@section('submenu_app_info','text-dark')
@section('submenu_system_info',' text-dark')
@section('submenu_database_info',' text-dark')
@section('submenu_other_info','bg-selected-primary text-light')
@section('sub-sub-content')

<div class="row">
    <div class="col">
        <h5>Other Information</h5>
    </div>
</div>
<div class="row">
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        LOG_CHANNEL
                    </div>
                    <div class="col">
                        {{ env("LOG_CHANNEL", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        LOG_LEVEL
                    </div>
                    <div class="col">
                        {{ env("LOG_LEVEL", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        BROADCAST_DRIVER
                    </div>
                    <div class="col">
                        {{ env("BROADCAST_DRIVER", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        FILESYSTEM_DISK
                    </div>
                    <div class="col">
                        {{ env("FILESYSTEM_DISK", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        QUEUE_CONNECTION
                    </div>
                    <div class="col">
                        {{ env("QUEUE_CONNECTION", "No Data Available") }}
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
