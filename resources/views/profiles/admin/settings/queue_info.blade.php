@extends('profiles.admin.settings.queue_info_layout')
@section('title','App Info | Admin')
@section('submenu_queue_info','bg-selected-primary text-light')
@section('sub-sub-content')

<div class="row">
    <div class="col">
        <h5>Queue Information</h5>
    </div>
</div>
<div class="row">
    <div class="col">
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
<div class="row mt-3">
    <div class="col">
        <h5>Failed Jobs</h5>
    </div>
</div>
<div class="row">
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action mt-1">
                <div class="row">
                    <div class="col">
                        Failed jobs
                    </div>
                    <div class="col">
                        {{ $failed_jobs_count }}
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
