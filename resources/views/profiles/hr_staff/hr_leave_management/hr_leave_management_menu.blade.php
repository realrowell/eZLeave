@extends('includes.hrstaff_layout')
@section('title','Leave Menu')
@section('sidebar_leave_management_active','active')
@section('sidebar_leave_management_active_custom','active_custom')
@section('custom_active_leave_icon','var(--accent-color)')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <div class="col mt-2">
          <h3>Leave Management HR Staff Menu</h3>
        </div> 
    </div>
    <div class="row">
        <div class="row justify-content-center align-items-start g-4">
            <div class="col-custom col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('hrstaff_leave_management') }}">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg height="100px" width="100px" version="1.1" id="Capa_1" >@svg('carbon-user-certification')</svg>
                            </i>
                            <h5 class="card-title">HR Staff Leave Management</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 flex">
                <a class="text-dark" href="/profile/leave_management/pending_approval/grid">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg width="100px" height="100px" viewBox="0 0 24 24">@svg('carbon-user-identification')</svg>
                            </i>
                        <h5 class="card-title">Employee Leave Management</h5>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
        
    </div>
    
</div>
@endsection