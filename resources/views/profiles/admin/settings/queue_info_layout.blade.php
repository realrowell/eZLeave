@extends('profiles.admin.settings.system_settings')
@section('menu_email',' text-dark')
@section('menu_system_info',' text-dark')
@section('menu_queue_info','bg-selected-warning text-light')
@section('sub-content')

<div class="row gap-1">
    <div class="col-lg-1 col-md-4 col-sm-5 col-5 card-menu-primary shadow-sm align-self-stretch @yield('submenu_queue_info')" style="min-height: 1rem" >
        <a href="{{ route('queue.info') }}" class="@yield('submenu_queue_info')">
            <div class="col text-light-hover">
                <div class="card-body">
                    <h6>Queue Info</h6>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row mt-3 p-3 bg-light shadow">
    <div class="col">
        @yield('sub-sub-content')
    </div>
</div>
@endsection

