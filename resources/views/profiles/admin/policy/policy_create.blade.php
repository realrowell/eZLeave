@extends('includes.admin_layout')
@section('title','Area of Assignments')
@section('sidebar_organization_active','active')
@section('content')

<div class="banner-gradient p-5 text-center text-light ">
    <h2 class="banner-title">
        Bioseed Leave Management System
    </h2>
</div>
<div class="container-fluid">
    <div class="row m-3 mt-4">
        <div class="col">
            <h3><a href="/admin/policy/menu" class="text-dark">Policy</a> / Create</h3>
        </div>
        <div class="col text-end">
            <a href="#create" class="btn btn-success float-right">Create</a>
            <a href="#cancel" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#cancel_modal">Cancel</a>
            {{-- Cancel Modal --}}
            <div class="modal fade" id="cancel_modal" tabindex="-1" aria-labelledby="cancel_modal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row text-center">
                        <p>Are you sure you want to cancel?</p>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/admin/policy/menu" class="btn btn-danger">Confirm</a>
                        <button type="button" class="btn bg-transparent" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>
            {{-- End Cancel Modal --}}
        </div>
    </div>
    <div class="row m-4 p-2">
        <label for="policy_title">Policy Title</label>
        <input type="text" id="policy_title" class="form-control" placeholder="Title">
    </div>
    <div class="row m-3">
        <label for="policy_body" class="m-2">Policy Body</label>
        <div class="col">
            <textarea name="policy_body" class="full-editor" id="policy_body" cols="30" rows="10" style="height: 100px" placeholder="Body"></textarea>
        </div>
    </div>
</div>

@endsection