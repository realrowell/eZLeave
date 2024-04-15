@extends('includes.hrstaff_layout')
@section('title','Dashboard')
@section('sidebar_dashboard_active','active')
@section('content')

<div class="banner-gradient p-5 text-center text-light ">
  <h2 class="banner-title text-shadow">
    Bioseed Leave Management System
  </h2>
</div>
<div class="container-fluid mb-4 pb-5" id="profile_body">
  {{-- <div class="row">
    <img src="/img/dashboard_banner_01.jpg" alt="">
  </div> --}}
  <div class="row">
    <div class="col mt-2">
      <h3>Dashboard</h3>
    </div>
  </div>
  <div class="row d-flex gap-3">
    <div class="row justify-content-center align-items-start d-flex gap-3">
        <div class="col-md bg-light border pt-2 ps-2 pb-5 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
            <div class="row ">
                <div class="col"><h5>Leave Management</h5></div>
                <div class="col d-flex justify-content-end pe-4">
                    <a href="/" class="btn-sm btn-primary">see all</a>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center text-center g-2 mt-3">
                    <a href="#" class="col-md text-dark">
                    <span id="approval_numbers" class="col">10</span>
                        <div class="row">
                        <span class="col">In Progress</span>
                        </div>
                    </a>
                    <a href="#" class="col-md text-dark">
                    <span id="approval_numbers" class="col">22</span>
                        <div class="row">
                        <span class="col">Approved</span>
                        </div>
                    </a>
                    <a href="#" class="col-md text-dark">
                        <span id="approval_numbers" class="col">12</span>
                        <div class="row">
                            <span class="col">Rejected</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md bg-light border pt-2 ps-2 pb-5 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
            <div class="row ">
            <div class="col"><h5>Employee Management</h5></div>
            <div class="col d-flex justify-content-end pe-4">
                <a href="/" class="btn-sm btn-primary">see all</a>
            </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center text-center g-2 mt-3">
                <a href="#" class="col-md text-dark">
                    <span id="approval_numbers" class="col">130</span>
                    <div class="row">
                        <span class="col">Total Employees</span>
                    </div>
                </a>
                <a href="#" class="col-md text-dark">
                    <span id="approval_numbers" class="col">98</span>
                    <div class="row">
                        <span class="col">Regular</span>
                    </div>
                </a>
                <a href="#" class="col-md text-dark">
                    <span id="approval_numbers" class="col">32</span>
                        <div class="row">
                        <span class="col">Probationary</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex gap-3">
        <div class="col-md-6 bg-light border pt-2 ps-2 pb-5 shadow border-bottom-0 border-end-0 border-top-0 border-warning border-5">
            <div class="row ">
            <div class="col"><h5>Policy Management</h5></div>
            <div class="col d-flex justify-content-end pe-4">
                <a href="/" class="btn-sm btn-primary">see all</a>
            </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center text-center g-2 mt-3">
                <a href="#" class="col-md text-dark">
                    <span id="approval_numbers" class="col">
                        <i>
                            <svg fill="#000000" width="100px" height="100px" viewBox="-1.9 -1.9 22.80 22.80" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M14.443 4.445a1.615 1.615 0 0 1-1.613 1.614h-.506v8.396a1.615 1.615 0 0 1-1.613 1.613H2.17a1.613 1.613 0 1 1 0-3.227h.505V4.445A1.615 1.615 0 0 1 4.289 2.83h8.54a1.615 1.615 0 0 1 1.614 1.614zM2.17 14.96h7.007a1.612 1.612 0 0 1 0-1.01H2.172a.505.505 0 0 0 0 1.01zm9.045-10.515a1.62 1.62 0 0 1 .08-.505H4.29a.5.5 0 0 0-.31.107l-.002.001a.5.5 0 0 0-.193.397v8.396h6.337a.61.61 0 0 1 .6.467.632.632 0 0 1-.251.702.505.505 0 1 0 .746.445zm-.86 1.438h-5.76V6.99h5.76zm0 2.26h-5.76V9.25h5.76zm0 2.26h-5.76v1.108h5.76zm2.979-5.958a.506.506 0 0 0-.505-.505.496.496 0 0 0-.31.107h-.002a.501.501 0 0 0-.194.398v.505h.506a.506.506 0 0 0 .505-.505z"></path></g></svg>
                        </i>
                    </span>
                    <div class="row">
                        <span class="col">Leave Policy</span>
                    </div>
                </a>
                <a href="#" class="col-md text-dark">
                    <span id="approval_numbers" class="col">
                        <i>
                            <svg width="100px" height="100px" viewBox="-102.4 -102.4 1228.80 1228.80" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M457.728 692.48a21.824 21.824 0 0 1-12.928-9.728 21.952 21.952 0 0 1-2.24-15.936l100.864-401.408a20.928 20.928 0 0 1 20.544-15.936c16.512 3.584 23.232 14.656 20.544 26.112L483.648 675.2a20.928 20.928 0 0 1-20.544 16l-5.376 1.28z m-101.76-47.36a21.504 21.504 0 0 1-15.168-6.208L190.72 485.824a20.672 20.672 0 0 1 0-29.184l150.016-153.152a21.12 21.12 0 0 1 30.784 0 21.568 21.568 0 0 1 0 30.976L261.76 445.12a38.336 38.336 0 0 0 0 53.12l111.168 110.144a21.568 21.568 0 0 1 0 28.8 24.64 24.64 0 0 1-16.96 7.936z m315.136 0a21.504 21.504 0 0 1-16-7.04 21.568 21.568 0 0 1 0-30.976l109.76-108.864a35.2 35.2 0 0 0 0-51.392l-110.72-111.488a20.672 20.672 0 0 1 0-28.8 23.68 23.68 0 0 1 17.92-9.28c5.632 0 11.072 2.24 15.104 6.208l150.016 153.152a21.12 21.12 0 0 1 0 29.184l-149.568 153.088a21.504 21.504 0 0 1-16.512 6.208zM64 128h896v704H64V128z m64 64v576h768V192H128z m64 704h640v64H192v-64z" fill="#000000"></path></g></svg>
                        </i>
                    </span>
                    <div class="row">
                        <span class="col">System Policy</span>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<footer>
@endsection
