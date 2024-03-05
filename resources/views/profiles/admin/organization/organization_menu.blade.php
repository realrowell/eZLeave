@extends('includes.admin_layout')
@section('title','Organization Menu')
@section('sidebar_organization_active','active')
@section('content')

<div class="container-fluid mb-4 pb-5" id="profile_body">
    <div class="row">
        <div class="col mt-2">
          <h3>Organization Menu</h3>
        </div> 
    </div>
    <div class="row">
        <div class="row justify-content-center align-items-start g-4">
            <div class="col-custom col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('admin_departments_grid') }}">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg width="100px" height="100px" viewBox="-1.6 -1.6 19.20 19.20" xmlns="http://www.w3.org/2000/svg">
                                    <g id="" stroke-width="0"></g>
                                    <g id="" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.111 4.663A2 2 0 1 1 6.89 1.337a2 2 0 0 1 2.222 3.326zm-.555-2.494A1 1 0 1 0 7.444 3.83a1 1 0 0 0 1.112-1.66zm2.61.03a1.494 1.494 0 0 1 1.895.188 1.513 1.513 0 0 1-.487 2.46 1.492 1.492 0 0 1-1.635-.326 1.512 1.512 0 0 1 .228-2.321zm.48 1.61a.499.499 0 1 0 .705-.708.509.509 0 0 0-.351-.15.499.499 0 0 0-.5.503.51.51 0 0 0 .146.356zM3.19 12.487H5v1.005H3.19a1.197 1.197 0 0 1-.842-.357 1.21 1.21 0 0 1-.348-.85v-1.81a.997.997 0 0 1-.71-.332A1.007 1.007 0 0 1 1 9.408V7.226c.003-.472.19-.923.52-1.258.329-.331.774-.52 1.24-.523H4.6a2.912 2.912 0 0 0-.55 1.006H2.76a.798.798 0 0 0-.54.232.777.777 0 0 0-.22.543v2.232h1v2.826a.202.202 0 0 0 .05.151.24.24 0 0 0 .14.05zm7.3-6.518a1.765 1.765 0 0 0-1.25-.523H6.76a1.765 1.765 0 0 0-1.24.523c-.33.335-.517.786-.52 1.258v3.178a1.06 1.06 0 0 0 .29.734 1 1 0 0 0 .71.332v2.323a1.202 1.202 0 0 0 .35.855c.18.168.407.277.65.312h2a1.15 1.15 0 0 0 1-1.167V11.47a.997.997 0 0 0 .71-.332 1.006 1.006 0 0 0 .29-.734V7.226a1.8 1.8 0 0 0-.51-1.258zM10 10.454H9v3.34a.202.202 0 0 1-.06.14.17.17 0 0 1-.14.06H7.19a.21.21 0 0 1-.2-.2v-3.34H6V7.226c0-.203.079-.398.22-.543a.798.798 0 0 1 .54-.232h2.48a.778.778 0 0 1 .705.48.748.748 0 0 1 .055.295v3.228zm2.81 3.037H11v-1.005h1.8a.24.24 0 0 0 .14-.05.2.2 0 0 0 .06-.152V9.458h1V7.226a.777.777 0 0 0-.22-.543.798.798 0 0 0-.54-.232h-1.29a2.91 2.91 0 0 0-.55-1.006h1.84a1.77 1.77 0 0 1 1.24.523c.33.335.517.786.52 1.258v2.182c0 .273-.103.535-.289.733-.186.199-.44.318-.711.333v1.81c0 .319-.125.624-.348.85a1.197 1.197 0 0 1-.842.357zM4 1.945a1.494 1.494 0 0 0-1.386.932A1.517 1.517 0 0 0 2.94 4.52 1.497 1.497 0 0 0 5.5 3.454c0-.4-.158-.784-.44-1.067A1.496 1.496 0 0 0 4 1.945zm0 2.012a.499.499 0 0 1-.5-.503.504.504 0 0 1 .5-.503.509.509 0 0 1 .5.503.504.504 0 0 1-.5.503z"></path>
                                    </g>
                                </svg>
                            </i>
                            <h5 class="card-title">Departments</h5>
                            <p class="card-text">
                                {{-- Leave request/s that need your response will be shown here --}}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('admin_subdepartments_grid') }}">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg width="100px" height="100px" viewBox="-2.4 -2.4 28.80 28.80" xmlns="http://www.w3.org/2000/svg" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0H24V24H0z"></path> <path d="M15 3c.552 0 1 .448 1 1v4c0 .552-.448 1-1 1h-2v2h4c.552 0 1 .448 1 1v3h2c.552 0 1 .448 1 1v4c0 .552-.448 1-1 1h-6c-.552 0-1-.448-1-1v-4c0-.552.448-1 1-1h2v-2H8v2h2c.552 0 1 .448 1 1v4c0 .552-.448 1-1 1H4c-.552 0-1-.448-1-1v-4c0-.552.448-1 1-1h2v-3c0-.552.448-1 1-1h4V9H9c-.552 0-1-.448-1-1V4c0-.552.448-1 1-1h6zM9 17H5v2h4v-2zm10 0h-4v2h4v-2zM14 5h-4v2h4V5z"></path> </g> </g></svg>
                            </i>
                        <h5 class="card-title">Sub-departments</h5>
                        <p class="card-text">
                            {{-- Leave request/s that you make will be shown here --}}
                          </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('admin_positions_grid') }}">
                    <div class="card shadow card-menu border-0">
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg height="100px" width="100px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-51.2 -51.2 614.40 614.40" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> </style> <g> <path class="st0" d="M256.008,411.524c54.5,0,91.968-7.079,92.54-13.881c2.373-28.421-34.508-43.262-49.381-48.834 c-7.976-2.984-19.588-11.69-19.588-17.103c0-3.587,0-8.071,0-14.214c4.611-5.119,8.095-15.532,10.183-27.317 c4.857-1.738,7.627-4.524,11.095-16.65c3.69-12.93-5.548-12.5-5.548-12.5c7.468-24.715-2.357-47.944-18.825-46.246 c-11.358-19.857-49.397,4.54-61.31,2.841c0,6.818,2.834,11.92,2.834,11.92c-4.143,7.882-2.548,23.564-1.389,31.485 c-0.667,0-9.016,0.079-5.468,12.5c3.452,12.126,6.23,14.912,11.088,16.65c2.079,11.786,5.571,22.198,10.198,27.317 c0,6.143,0,10.627,0,14.214c0,5.413-12.35,14.548-19.611,17.103c-14.953,5.262-51.746,20.413-49.373,48.834 C164.024,404.444,201.491,411.524,256.008,411.524z"></path> <path class="st0" d="M404.976,56.889h-75.833v16.254c0,31.365-25.524,56.889-56.889,56.889h-32.508 c-31.366,0-56.889-25.524-56.889-56.889V56.889h-75.834c-25.444,0-46.071,20.627-46.071,46.071v362.969 c0,25.444,20.627,46.071,46.071,46.071h297.952c25.445,0,46.072-20.627,46.072-46.071V102.96 C451.048,77.516,430.421,56.889,404.976,56.889z M402.286,463.238H109.714V150.349h292.572V463.238z"></path> <path class="st0" d="M239.746,113.778h32.508c22.405,0,40.635-18.23,40.635-40.635V40.635C312.889,18.23,294.659,0,272.254,0 h-32.508c-22.406,0-40.635,18.23-40.635,40.635v32.508C199.111,95.547,217.341,113.778,239.746,113.778z M231.619,40.635 c0-4.492,3.634-8.127,8.127-8.127h32.508c4.492,0,8.127,3.635,8.127,8.127v16.254c0,4.492-3.635,8.127-8.127,8.127h-32.508 c-4.493,0-8.127-3.635-8.127-8.127V40.635z"></path> </g> </g></svg>
                            </i>
                            <h5 class="card-title">Positions</h5>
                            <p class="card-text">
                                {{-- Your approved leave request will be shown here --}}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <a class="text-dark" href="{{ route('admin_areaofassignemnts_grid') }}">
                    <div class="card shadow card-menu border-0" >
                        <div class="card-body text-center">
                            <i class="row mb-3 mt-2 justify-content-center align-items-center">
                                <svg height="100px" width="100px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-51.2 -51.2 614.41 614.41" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(0 -1)"> <g> <g> <path d="M511.596,487.499L468.93,274.166c-2.005-9.963-10.752-17.152-20.928-17.152h-82.923c1.707-2.645,3.392-5.355,5.077-8 l12.16-19.136c15.061-23.808,23.019-51.307,23.019-79.531c0-42.496-18.176-83.115-49.92-111.445 C323.714,10.592,281.047-2.975,238.551,2.017C172.183,9.569,117.335,63.03,108.162,129.121 c-5.44,39.168,4.352,78.059,27.541,109.547c4.395,5.952,8.341,12.224,12.523,18.347H64.002c-10.155,0-18.901,7.189-20.907,17.152 L0.428,487.499c-1.259,6.272,0.363,12.757,4.416,17.707c4.053,4.928,10.091,7.808,16.491,7.808h469.333 c6.4,0,12.437-2.88,16.512-7.808C511.212,500.257,512.834,493.771,511.596,487.499z M256.002,86.347c35.307,0,64,28.715,64,64 c0,35.285-28.693,64-64,64c-35.285,0-64-28.715-64-64C192.002,115.062,220.716,86.347,256.002,86.347z M47.362,470.347 l34.133-170.667h93.845c0.064,0.107,0.128,0.235,0.192,0.341c13.696,23.232,26.411,47.019,38.016,69.547 c4.907,9.621,9.813,19.2,14.699,28.949l8.683,17.365c3.627,7.232,10.987,11.797,19.072,11.797 c8.085,0,15.467-4.565,19.093-11.797l18.389-36.779c4.928-9.835,10.176-19.584,15.531-29.291 c1.536-2.773,3.072-5.568,4.608-8.299c4.544-8.021,9.195-16.021,13.931-23.936c3.669-6.144,7.296-12.139,10.859-17.899h92.117 l34.133,170.667H47.362z"></path> <path d="M256.008,171.681c11.776,0,21.333-9.557,21.333-21.333s-9.557-21.333-21.333-21.333 c-11.776,0-21.333,9.557-21.333,21.333S244.232,171.681,256.008,171.681z"></path> </g> </g> </g> </g></svg>
                            </i>
                            <h5 class="card-title">Area of Assignments</h5>
                            <p class="card-text">
                                {{-- Your leave requested will be shown here --}}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
    
</div>
@endsection