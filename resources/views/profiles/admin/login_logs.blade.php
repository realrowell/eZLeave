@extends('profiles.admin.admin_dashboard_layout')
@section('title','Login Logs')
@section('sidebar_employee_management_active','active')
@section('list_active','bg-selected-warning')
@section('menu_admin_dashboard','text-dark')
@section('menu_user_management','text-dark')
@section('menu_login_logs','bg-selected-warning text-light')
@section('sub-content')

<div class="row">
    <div class="container-fluid mt-3 bg-light shadow">
        <div class="row p-3">
            <div class="col ">
                <table id="data_table" class="css-serial table table-sm table-bordered table-hover bg-light" style="width:100%; ">
                    <thead class="bg-success text-light border-light" style="font-size:0.9rem; ">
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Device Info</th>
                            <th>Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($login_logs as $login_log)
                        <tr>
                            <td></td>
                            <td>{{ $login_log->users?->last_name }}, {{ $login_log->users?->first_name }} {{ optional($login_log->users?->suffixes)->suffix_title }}</td>
                            <td>{{ $login_log->ip_address }}</td>
                            {{-- <td><a href="http://ip-api.com/php/{{ $login_log->ip_address }}" data-toggle="tooltip" title="{{ $login_log->ip_address }}">Show IP Details</a></td> --}}
                            <td>{{ $login_log->device }}</td>
                            <td>{{ $login_log->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-success text-light border-light" style="font-size:0.9rem; ">
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Device Info</th>
                            <th>Date Time</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
