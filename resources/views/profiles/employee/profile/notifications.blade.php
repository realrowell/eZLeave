@extends('includes.employee_profile_layout')
@section('title','Notifications')
@section('content')

<div class="container-fluid" id="profile_body">
    <div class="row">
        <h5>Menu</h5>
    </div>
    <div class="row mb-4 d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('employee_dashboard') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('employee_profile') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Profile</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('profile_leave_management_pending_approval_grid') }}" class="text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Management</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid mb-5" id="profile_body">
    <div class="row">
        <div class="col mt-2">
            <h3>Notifications</h3>
        </div>
    </div>
    <div class="row gap-3 p-5 bg-light shadow" id="CollapseMenu">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="row mt-3">
                <button class="btn btn-primary justify-content-center position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#LMNCollapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
                    <h6 style="margin-bottom: 0px">Leave Management Notification</h6>
                    @if ($leave_notifications->where('is_open',false)->count() != 0)
                        <span class="position-absolute top-0 start-100 translate-middle ">
                            <span class="badge rounded-pill bg-danger" style="font-size: 10px">{{ $leave_notifications->where('is_open',false)->count() }}</span>
                        </span>
                    @endif
                </button>
            </div>
            <div class="row mt-3">
                <button class="btn btn-primary position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#SNCollapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
                    <h6 style="margin-bottom: 0px">System Notification</h6>
                    @if ($system_notifications->where('is_open',false)->count() != 0)
                        <span class="position-absolute top-0 start-100 translate-middle ">
                            <span class="badge rounded-pill bg-danger" style="font-size: 10px">{{ $system_notifications->where('is_open',false)->count() }}</span>
                        </span>
                    @endif
                </button>
            </div>
        </div>
        <div class="col-lg-7 col-md-8 col-sm-12  border-start border-1 border-secondary">
            <div class="collapse show multi-collapse" id="LMNCollapse" data-bs-parent="#CollapseMenu">
                <h4>Leave Management Notification</h4>
                <ul class="list-group">
                    @forelse ($leave_notifications as $notification)
                        <li class="list-group-item list-group-item-action mt-2">
                            <a class="text-dark position-relative" href="{{ route('leave_details_page',['leave_application_rn'=>$notification->body]) }}">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                                        @if ($notification->is_open == false)
                                            <h4><b>{{ $notification->title }}</b></h4>
                                            <h6 class="text-secondary"><b>{{ $notification->subject }}</b></h6>
                                        @elseif ($notification->is_open == true)
                                            <h4>{{ $notification->title }}</h4>
                                            <h6 class="text-secondary">{{ $notification->subject }}</h6>
                                        @endif
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-end ">
                                        <p class="text-secondary">
                                            <i class='bx bx-time me-1'></i>
                                            {{ timestamp_leadtime($notification->created_at) }}
                                        </p>
                                    </div>
                                </div>
                                @if ($notification->is_open == false)
                                    <span class="position-absolute top-0 start-100 translate-middle ">
                                        <span class="badge rounded-pill bg-danger text-danger" style="font-size: 7px">.</span>
                                    </span>
                                @endif
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item list-group-item-action mt-2">
                            No Notification Available
                        </li>
                    @endforelse
                </ul>
            </div>
            <div class="collapse multi-collapse" id="SNCollapse" data-bs-parent="#CollapseMenu">
                <h4>System Notification</h4>
                <ul class="list-group dropend">
                    @forelse ($system_notifications as $notification)
                        <li class="list-group-item list-group-item-action mt-2" id="notif_dropdown_btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <a class="text-dark position-relative" href="#">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                                        @if ($notification->is_open == false)
                                            <h4><b>{{ $notification->title }}</b></h4>
                                            <h6 class="text-secondary"><b>{{ $notification->subject }}</b></h6>
                                        @elseif ($notification->is_open == true)
                                            <h4>{{ $notification->title }}</h4>
                                            <h6 class="text-secondary">{{ $notification->subject }}</h6>
                                        @endif
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-end ">
                                        <p class="text-secondary">
                                            <i class='bx bx-time me-1'></i>
                                            {{ timestamp_leadtime($notification->created_at) }}
                                        </p>
                                    </div>
                                </div>
                                @if ($notification->is_open == false)
                                    <span class="position-absolute top-0 start-100 translate-middle ">
                                        <span class="badge rounded-pill bg-danger text-danger" style="font-size: 7px">.</span>
                                    </span>
                                @endif
                            </a>
                        </li>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="notif_dropdown_menu">
                            @if ($notification->is_open == false)
                                <li><a class="dropdown-item" href="{{ route('user.notification.mark_read',$notification->id) }}">Mark as read</a></li>
                            @elseif ($notification->is_open == true)
                                <li><a class="dropdown-item" href="{{ route('user.notification.mark_unread',$notification->id) }}">Mark as unread</a></li>
                            @endif
                        </ul>
                    @empty
                        <li class="list-group-item list-group-item-action mt-2">
                            No Notification Available
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mt-2 mb-5">
                    <ul class="pagination justify-content-center align-items-center">
                        {!! $leave_notifications->links('pagination::bootstrap-5') !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>



</div>


@endsection
