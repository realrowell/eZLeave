@extends('includes.admin_layout')
@section('title','Login Logs')
@section('sidebar_dashboard_active','active')
@section('profile_bar_display','')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col p-5">
            <table id="loginlogs_table" class="table table-bordered table-hover bg-light shadow" style="width:100%">
                <thead class="bg-success text-light border-light">
                    <tr>
                        <th>User</th>
                        <th>Date Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($login_logs as $login_log)
                    <tr>
                        <td>{{ $login_log->users->last_name }}, {{ $login_log->users->first_name }} {{ optional($login_log->users->suffixes)->suffix_title }}</td>
                        <td>{{ $login_log->date_time }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-success text-light border-light">
                    <tr>
                        <th>User</th>
                        <th>Date Time</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
