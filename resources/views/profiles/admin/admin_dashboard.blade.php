@extends('includes.admin_layout')
@section('title','Dashboard')
@section('sidebar_dashboard_active','active')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
  <div class="row">
    <div class="col mt-2">
      <h3>Dashboard</h3>
    </div>
  </div>
  <div class="row">
    <div class="row justify-content-center align-items-start g-2">
      <div class="col-md bg-light border pt-2 ps-2 pb-5 me-2 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
        <div class="row ">
          <div class="col"><h5>Leave Management</h5></div>
          <div class="col d-flex justify-content-end pe-4">
            <a href="/" class="btn-sm btn-primary">see all</a>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row justify-content-center align-items-center text-center g-2 mt-3">
            <a href="/profile/leave_management/for_approval" class="col-md text-dark">
              <span id="approval_numbers" class="col">4</span>
                <div class="row">
                  <span class="col">For Approval</span>
                </div>
            </a>
            <a href="#" class="col-md text-dark">
              <span id="approval_numbers" class="col">4</span>
                <div class="row">
                  <span class="col">Pending Approval</span>
                </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md bg-light border pt-2 ps-2 pb-5 ms-2 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
        <div class="row ">
          <div class="col"><h5>Login Logs</h5></div>
          <div class="col d-flex justify-content-end pe-4">
            <a href="#" class="btn-sm btn-primary">see all</a>
          </div>
        </div>
        @foreach ($login_logs as $login_log)
          <div class="row m-2">
            <div class="col"><i>{{ $login_log->users->first_name." ".$login_log->users->middle_name." ".$login_log->users->last_name }}</i></div>
            <div class="col">{{ $login_log->date_time }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<footer>
@endsection
