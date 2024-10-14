@extends('profiles.admin.account_management.accounts')
@section('grid_active','bg-selected-warning')
@section('menu_admin_dashboard','text-dark')
@section('menu_user_management','bg-selected-warning text-light')
@section('menu_login_logs','text-dark')
@section('submenu_all', 'text-light bg-selected-primary')
@section('submenu_admin', 'text-dark')
@section('submenu_employee', 'text-dark')
@section('sub-sub-content')

{{-- GRID PROFILE --}}
<div class="container-fluid">
    <div class="row">
        @foreach ($users as $user)
            <div class="col-lg-4 col-md-6 col-sm-10 align-self-stretch p-1  ">
                <x-admin.admin-account-card
                    :userId="$user->id"
                >
                </x-admin.admin-account-card>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="mt-5">
            <ul class="pagination justify-content-center align-items-center">
                {!! $users->links('pagination::bootstrap-5') !!}
            </ul>
        </div>
    </div>
</div>



@endsection
