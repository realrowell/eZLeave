@extends('includes.employee_profile_layout')
@section('title','Leave Menu')
@section('sidebar_leave_management_active','active')
@section('sidebar_leave_management_active_custom','active_custom')
@section('custom_active_leave_icon','var(--accent-color)')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <div class="col mt-2">
          <h3>Leave Management Menu</h3>
        </div>
    </div>
    <div class="row">
        <div class="row justify-content-center align-items-start g-4">
            <div class="col-lg-5 col-md-5 col-sm-12 flex">
                <a class="text-dark" href="{{ route('profile_leave_management_pending_approval_grid') }}">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg width="100px" height="100px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#00AF46"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --> <title>ic_fluent_shifts_pending_24_filled</title> <desc>Created with Sketch.</desc> <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill-rule="evenodd"> <g id="ic_fluent_shifts_pending_24_filled" fill-rule="nonzero"> <path d="M6.5,12 C9.53756612,12 12,14.4624339 12,17.5 C12,20.5375661 9.53756612,23 6.5,23 C3.46243388,23 1,20.5375661 1,17.5 C1,14.4624339 3.46243388,12 6.5,12 Z M6.5,19.88 C6.15509206,19.88 5.87548893,20.1596031 5.87548893,20.5045111 C5.87548893,20.849419 6.15509206,21.1290221 6.5,21.1290221 C6.84490794,21.1290221 7.12451107,20.849419 7.12451107,20.5045111 C7.12451107,20.1596031 6.84490794,19.88 6.5,19.88 Z M17.75,3 C19.5449254,3 21,4.45507456 21,6.25 L21,17.75 C21,19.5449254 19.5449254,21 17.75,21 L11.9774077,21.0012092 C12.6247042,19.9906579 13,18.7891565 13,17.5 C13,15.9846422 12.4814474,14.5903989 11.6108398,13.4871142 L11.6794988,13.4967299 L11.75,13.5 L16.2482627,13.5 L16.3500333,13.4931534 C16.7161089,13.443491 16.9982627,13.1296958 16.9982627,12.75 C16.9982627,12.3703042 16.7161089,12.056509 16.3500333,12.0068466 L16.2482627,12 L12.5,12 L12.5,6.75 L12.4931534,6.64822944 C12.443491,6.28215388 12.1296958,6 11.75,6 C11.3703042,6 11.056509,6.28215388 11.0068466,6.64822944 L11,6.75 L11,12.75 L11.0048315,12.8142135 C9.83648038,11.690706 8.24890171,11 6.5,11 C5.21084353,11 4.00934208,11.3752958 2.99879075,12.0225923 L3,6.25 C3,4.45507456 4.45507456,3 6.25,3 L17.75,3 Z M6.5000438,14.0030924 C5.45209485,14.0030924 4.63575024,14.8204841 4.64666418,15.9573825 C4.64931495,16.2335122 4.87531114,16.4552106 5.15144079,16.4525598 C5.42757044,16.449909 5.64926888,16.2239129 5.6466181,15.9477832 C5.64105975,15.3687734 6.00627225,15.0030924 6.5000438,15.0030924 C6.97241724,15.0030924 7.35344646,15.3949794 7.35344646,15.9525829 C7.35344646,16.1768805 7.27815856,16.343747 7.03551615,16.6299729 L6.93650069,16.7432479 L6.67112833,17.0333231 C6.18682267,17.5748716 6.0000438,17.9254825 6.0000438,18.5006005 C6.0000438,18.7767429 6.22390142,19.0006005 6.5000438,19.0006005 C6.77618617,19.0006005 7.0000438,18.7767429 7.0000438,18.5006005 C7.0000438,18.268353 7.07645293,18.0980788 7.32379001,17.8062547 L7.42473827,17.6907646 L7.69048308,17.400276 C8.16815154,16.8660369 8.35344646,16.5185919 8.35344646,15.9525829 C8.35344646,14.8488849 7.5310877,14.0030924 6.5000438,14.0030924 Z" id="🎨-Color"> </path> </g> </g> </g></svg>
                            </i>
                        <h5 class="card-title">Pending Approval</h5>
                        <p class="card-text">
                            Leave request/s that you make will be shown here
                          </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-custom col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('profile_leave_management_for_approval_grid') }}">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg height="100px" width="100px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 25.772 25.772" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M25.646,13.74l-1.519-2.396l0.901-2.689c0.122-0.367-0.03-0.77-0.365-0.962l-2.458-1.417l-0.452-2.8 c-0.063-0.382-0.385-0.667-0.771-0.683l-2.835-0.111l-1.701-2.27c-0.232-0.31-0.652-0.413-0.999-0.246l-2.561,1.218l-2.562-1.219 C9.976,0,9.558,0.103,9.325,0.412l-1.701,2.27L4.789,2.793c-0.385,0.015-0.708,0.3-0.77,0.682l-0.452,2.8L1.109,7.692 C0.774,7.884,0.621,8.287,0.743,8.654l0.901,2.689L0.126,13.74c-0.207,0.327-0.154,0.754,0.125,1.022l2.047,1.963l-0.23,2.826 c-0.031,0.387,0.213,0.74,0.584,0.848l2.725,0.785l1.109,2.611c0.152,0.355,0.533,0.561,0.911,0.479l2.78-0.57l2.194,1.797 c0.149,0.121,0.332,0.184,0.515,0.184s0.365-0.063,0.515-0.184l2.194-1.797l2.78,0.57c0.377,0.08,0.76-0.123,0.911-0.479 l1.109-2.611l2.725-0.785c0.371-0.107,0.615-0.461,0.584-0.848l-0.23-2.826l2.047-1.963C25.8,14.494,25.853,14.067,25.646,13.74z M18.763,9.829l-5.691,8.526c-0.215,0.318-0.548,0.531-0.879,0.531c-0.33,0-0.699-0.185-0.934-0.421L7.081,14.22 c-0.285-0.29-0.285-0.76,0-1.05l1.031-1.05c0.285-0.286,0.748-0.286,1.031,0l2.719,2.762l4.484-6.718 c0.225-0.339,0.682-0.425,1.014-0.196l1.209,0.831C18.902,9.029,18.988,9.492,18.763,9.829z"></path> </g> </g></svg>
                            </i>
                            <h5 class="card-title">For Your Approval</h5>
                            <p class="card-text">
                                Leave request/s that need your response will be shown here
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('profile_leave_management_pending_availment_grid') }}">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-51.2 -51.2 614.40 614.40" xml:space="preserve" width="100px" height="100px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <rect x="187.733" y="281.6" width="51.2" height="51.2"></rect> <rect x="68.267" y="401.067" width="51.2" height="51.2"></rect> <rect x="187.733" y="401.067" width="51.2" height="51.2"></rect> <rect x="68.267" y="162.133" width="51.2" height="51.2"></rect> <path d="M426.667,59.733c0-14.114-11.486-25.6-25.6-25.6h-34.133v-25.6c0-4.719-3.814-8.533-8.533-8.533h-34.133 c-4.719,0-8.533,3.814-8.533,8.533v25.6h-204.8v-25.6c0-4.719-3.814-8.533-8.533-8.533H68.267c-4.719,0-8.533,3.814-8.533,8.533 v25.6H25.6c-14.114,0-25.6,11.486-25.6,25.6V102.4h426.667V59.733z"></path> <rect x="187.733" y="162.133" width="51.2" height="51.2"></rect> <path d="M307.2,418.133c0-61.167,49.766-110.933,110.933-110.933c2.884,0,5.709,0.213,8.533,0.435V119.467H0V486.4 C0,500.514,11.486,512,25.6,512h333.688C328.064,492.348,307.2,457.668,307.2,418.133z M136.533,460.8 c0,4.719-3.814,8.533-8.533,8.533H59.733c-4.719,0-8.533-3.814-8.533-8.533v-68.267c0-4.719,3.814-8.533,8.533-8.533H128 c4.719,0,8.533,3.814,8.533,8.533V460.8z M136.533,341.333c0,4.719-3.814,8.533-8.533,8.533H59.733 c-4.719,0-8.533-3.814-8.533-8.533v-68.267c0-4.719,3.814-8.533,8.533-8.533H128c4.719,0,8.533,3.814,8.533,8.533V341.333z M136.533,221.867c0,4.719-3.814,8.533-8.533,8.533H59.733c-4.719,0-8.533-3.814-8.533-8.533V153.6 c0-4.719,3.814-8.533,8.533-8.533H128c4.719,0,8.533,3.814,8.533,8.533V221.867z M256,460.8c0,4.719-3.814,8.533-8.533,8.533 H179.2c-4.719,0-8.533-3.814-8.533-8.533v-68.267c0-4.719,3.814-8.533,8.533-8.533h68.267c4.719,0,8.533,3.814,8.533,8.533V460.8 z M256,341.333c0,4.719-3.814,8.533-8.533,8.533H179.2c-4.719,0-8.533-3.814-8.533-8.533v-68.267 c0-4.719,3.814-8.533,8.533-8.533h68.267c4.719,0,8.533,3.814,8.533,8.533V341.333z M256,221.867 c0,4.719-3.814,8.533-8.533,8.533H179.2c-4.719,0-8.533-3.814-8.533-8.533V153.6c0-4.719,3.814-8.533,8.533-8.533h68.267 c4.719,0,8.533,3.814,8.533,8.533V221.867z M290.133,221.867V153.6c0-4.719,3.814-8.533,8.533-8.533h68.267 c4.719,0,8.533,3.814,8.533,8.533v68.267c0,4.719-3.814,8.533-8.533,8.533h-68.267 C293.948,230.4,290.133,226.586,290.133,221.867z"></path> <rect x="307.2" y="162.133" width="51.2" height="51.2"></rect> <rect x="68.267" y="281.6" width="51.2" height="51.2"></rect> <path d="M418.133,324.267c-51.755,0-93.867,42.112-93.867,93.867S366.379,512,418.133,512S512,469.888,512,418.133 S469.888,324.267,418.133,324.267z M443.733,426.667h-25.6c-4.719,0-8.533-3.814-8.533-8.533v-51.2 c0-4.719,3.814-8.533,8.533-8.533s8.533,3.814,8.533,8.533V409.6h17.067c4.719,0,8.533,3.814,8.533,8.533 S448.452,426.667,443.733,426.667z"></path> </g> </g> </g> </g></svg>
                            </i>
                            <h5 class="card-title">Pending Availment</h5>
                            <p class="card-text">
                                Your approved leave request will be shown here
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('profile_leave_management_history_grid') }}">
                    <div class="card shadow card-menu border-0" >
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg width="100px" height="100px" viewBox="-25.6 -25.6 563.20 563.20" id="_x30_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M366.364,366.309 c-60.922,60.921-159.695,60.921-220.617,0c-30.342-30.342-45.572-70.073-45.691-109.841c-0.04-13.453,10.696-24.72,24.149-24.841 c13.565-0.123,24.601,10.837,24.601,24.374h0.05c0,27.464,10.454,54.929,31.363,75.837c41.817,41.817,109.857,41.817,151.674,0 c41.986-41.985,41.986-109.69,0-151.675c-41.817-41.817-109.857-41.816-151.674,0l0,0c7.367,7.367,3.551,19.973-6.666,22.016 l-43.089,8.618c-9.128,1.826-17.176-6.222-15.35-15.35l8.618-43.089c2.043-10.217,14.649-14.033,22.016-6.666v0 c60.922-60.922,159.695-60.922,220.617,0C427.137,206.463,427.137,305.537,366.364,366.309z M305.26,263.299 c8.744,5.048,11.74,16.229,6.691,24.973v0c-5.048,8.744-16.229,11.74-24.973,6.691l-40.064-23.131l0.001-0.002 c-5.463-3.161-9.142-9.064-9.142-15.83v-64.543c0-10.096,8.185-18.281,18.281-18.281h0c10.096,0,18.281,8.185,18.281,18.281v53.989 L305.26,263.299z"></path></g></svg>
                            </i>
                            <h5 class="card-title">History</h5>
                            <p class="card-text">
                                Your leave requested will be shown here
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
