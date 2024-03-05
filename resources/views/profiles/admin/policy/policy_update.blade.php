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
            <h3><a href="/admin/policy/menu" class="text-dark">Policy</a> / Update</h3>
        </div>
        <div class="col text-end">
            <a href="#apply" class="btn btn-success float-right">Apply Changes</a>
            <a href="#delete" class="btn btn-danger float-right">Delete</a>
        </div>
    </div>
    <div class="row m-4 p-2">
        <label for="policy_title">Policy Title</label>
        <input type="text" id="policy_title" class="form-control" value="Leave Policy">
    </div>
    <div class="row m-3">
        <label for="policy_body" class="m-2">Policy Body</label>
        <div class="col">
            <textarea name="policy_body" class="full-editor" id="policy_body" cols="30" rows="10" style="height: 100px" placeholder="Lorem Ipsum">Lorem Ipsumss</textarea>
        </div>
    </div>
</div>

@endsection