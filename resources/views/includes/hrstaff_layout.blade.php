<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/img/logo_icon.png">


    {{-- Bootstrap 5 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}
    {{-- End Bootstrap 5 --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home_style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile_style.css') }}" />
    {{-- Google Fonts --}}
    {{--
    font-family: 'Open Sans', sans-serif;
    font-family: 'Poppins', sans-serif;
    font-family: 'Raleway', sans-serif; 200, 400, 600, 800
    --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@900&family=Raleway:wght@200;400;600;800&display=swap" rel="stylesheet">
    {{-- End Google Fonts --}}

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
      rel="stylesheet"
    />

    {{-- TinyMCE Editor --}}
    <script src="https://cdn.tiny.cloud/1/wwnohmwf93vz1jxygxktfrjqohktqf35ys0gg87dp5rhhy4l/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script type="text/javascript" src="{{ asset('js/tinymce_editor.js') }}"></script>

    {{-- Javescript Navbar --}}
    <script type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/submit_buttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/spinners.js') }}"></script>

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

      :root {
        --header-height: 2rem;
        --nav-width: 70px;
        --first-color: #262626;
        --first-color-light: #00AF46;
        --accent-color:  #f3b200;
        --accent-color-2:  #f3b200;
        --body-font: "Nunito", sans-serif;
        --normal-font-size: 1rem;
        --z-fixed: 100;
      }
      *,
      ::before,
      ::after {
        box-sizing: border-box;
      }

      body {
        position: relative;
        margin: var(--header-height) 0 0 0;
        padding: 0 0rem;
        font-family: var(--body-font);
        font-size: var(--normal-font-size);
        transition: 0.5s;
        background-color: #f1f1f1;
      }

      a {
        text-decoration: none;
      }

      .header {
        width: 100%;
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        background-color: var(--first-color-light);
        z-index: var(--z-fixed);
        transition: 0.5s;
      }

      .header_toggle {
        color: var(--first-color);
        font-size: 1.8rem;
        cursor: pointer;
      }

      .bx-menu{
        color: white;
      }
/*
      .header_img {
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden;
      }

      .header_img img {
        width: 40px;
      } */

      .l-navbar {
        position: fixed;
        top: 0;
        left: -30%;
        width: var(--nav-width);
        height: 100vh;
        background-color: var(--first-color);
        padding: 0.5rem 1rem 0 0;
        transition: 0.5s;
        z-index: var(--z-fixed);
      }

      .nav {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
      }

      .nav_logo,
      .nav_link {
        display:grid;
        grid-template-columns: max-content max-content;
        align-items: center;
        column-gap: 1rem;
        padding: 0.5rem 0 0.5rem 1.5rem;
      }

      .nav_logo {
        margin-bottom: 0.5rem;
      }

      .nav_logo-icon {
        font-size: 1.25rem;
        color: var(--accent-color);
      }

      .nav_logo-name {
        color: white;
        font-weight: 700;
      }

      .nav_link {
        position: relative;
        color: var(--first-color-light);
        margin-bottom: 0.5rem;
        transition: 0.3s;
      }

      .nav_link_custom {
        position: relative;
        color: var(--first-color-light);
      }

      .nav_link:hover {
        color: var(--accent-color);
      }

      .nav_link_custom:hover {
        color: var(--accent-color);
      }

      .nav_icon {
        font-size: 1.25rem;
      }

      .nav_icon_custom{
        font-size: 1.25rem;
      }

      .showSideBar {
        left: 0;
      }

      .body-pd {
        padding-left: calc(var(--nav-width) + 0rem);
      }

      .active {
        color: var(--accent-color);
      }
      .active_custom {
        color: var(--accent-color);
      }

      .active::before {
        content: "";
        position: absolute;
        left: 0;
        width: 2px;
        height: 32px;
        background-color: var(--accent-color);
      }
      .active_custom::before {
        /* content: ""; */
        position: absolute;
        left: 0;
        width: 2px;
        height: 32px;
        background-color: var(--accent-color);
      }

      .height-100 {
        height: 100vh;
      }
      #bioseed_logo{
        width: 1%;
      }

      .custom_icon{
        color: var(--first-color-light);
      }
      .custom_icon:hover{
        color: var(--accent-color);
      }
      .custom_icon::before{
        color: var(--accent-color);
      }

      @media screen and (min-width: 768px) {
        body {
          margin: calc(var(--header-height) + 1rem) 0 0 0;
          padding-left: calc(var(--nav-width) + 0rem);
        }

        .header {
          height: calc(var(--header-height) + 1rem);
          padding: 0 2rem 0 calc(var(--nav-width) + 2rem);
        }
        .l-navbar {
          left: 0;
          padding: 1rem 1rem 0 0;
        }

        .showSideBar {
          width: calc(var(--nav-width) + 180px);
        }

        .body-pd {
          padding-left: calc(var(--nav-width) + 180px);
        }

      }
    </style>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="container-fluid">
            <div class="row  justify-content-start align-items-start">
                <div class="col-1 align-self-center">
                    <div class="header_toggle">
                        <i class="bx bx-menu pt-2" id="header-toggle"></i>
                    </div>
                </div>
                <div class="col-8 align-self-center">
                    <div class="text-start">
                        <a class="text-white" id="header_title">eZLeave | </a>
                        <a class="text-white" id="header_title" target="#blank" href="https://www.bioseed.com.ph">bioseed.com.ph</a>
                    </div>
                </div>
                <div class="col-3 align-self-center text-end align-items-center">
                    <a class="nav_logo-name dropdown-toggle" href="#"  data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->first_name }}
                    </a>
                    <ul class="dropdown-menu shadow" >
                        <li><span class="dropdown-item-text">{{ auth()->user()->first_name." ".auth()->user()->last_name." ".optional(auth()->user()->suffixes)->suffix_title }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            {{-- <div class="align-items-end justify-content-end">
              <span class="nav_logo-name">Admin</span>

              @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
              @endif
              @else
                <span class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav_logo-name dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->first_name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      <a href="/profile/user_profile" class="dropdown-item">Profile</a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                  </span>
              @endguest

            </div> --}}
    </header>
    <div class="l-navbar container-fluid" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="{{ route('index') }}" class="nav_logo">
                    <i class="bx nav_logo-icon" id="bioseed_logo"><img style="width: 30px" src="/img/bioseed_logo_low1.png" alt=""></i>
                    <i class="bx nav_logo-icon" id="bioseed_logo"><img style="width: 100px" src="/img/bioseed_logo_low2.png" alt=""></i>
                </a>
                <div class="nav_list">
                    <a href="{{ route('hrstaff_dashboard') }}" class="nav_link @yield('sidebar_dashboard_active')" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <i class="bx bx-grid-alt nav_icon"></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="/hr/employee_management/employees/grid" class="nav_link @yield('sidebar_employee_management_active')" data-bs-toggle="tooltip" data-bs-placement="right" title="Employee Management">
                        <i class="bx bx-user nav_icon" ></i>
                        <span class="nav_name">Employee Management</span>
                    </a>
                    <a href="{{ route('hrstaff_leave_management') }}" class="nav_link @yield('sidebar_leave_management_active')" data-bs-toggle="tooltip" data-bs-placement="right" title="Leave Management">
                        <i class="bx nav_icon bx-calendar"></i>
                        <span class="nav_name">Leave Management</span>
                    </a>
                    <a href="/admin/policy/menu" class="nav_link @yield('sidebar_policy_active')" data-bs-toggle="tooltip" data-bs-placement="right" title="Policy">
                        <i class="ms-0" style="width: 22px">
                            {{ svg('carbon-policy') }}
                        </i>
                        <span class="nav_name">Policy</span>
                    </a>
                    <a href="#" class="nav_link" data-bs-toggle="tooltip" data-bs-placement="right" title="Report">
                        <i class="ms-0" style="width: 20px">
                            {{ svg('tabler-report') }}
                        </i>
                        <span class="nav_name">Report</span>
                    </a>
                </div>
            </div>
            <a id="logout_submit" class="nav_link pb-5" href="#{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="bx bx-log-out nav_icon"></i>
                <span class="nav_name">SignOut</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>
    <div class="">
        <div class="position-relative z-1000">
            <div class="position-fixed bottom-0 end-0 me-5">
                @if (session('success'))
                    <div class="alert alert-success fade show" role="alert">
                        <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                            {{ svg('heroicon-o-check-circle') }}
                        </svg>
                        {{ session('success') }}
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('info'))
                    <div class="alert alert-info fade show" role="alert">
                        <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                            {{ svg('carbon-information') }}
                        </svg>
                        {{ session('info') }}
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('warning'))
                    <div class="alert alert-warning fade show" role="alert">
                        <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                            {{ svg('carbon-warning-alt') }}
                        </svg>
                        {{ session('warning') }}
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger fade show" role="alert">
                        <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                            {{ svg('carbon-warning-alt') }}
                        </svg>
                        {{ session('error') }}
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger fade show">
                      <div class="row">
                        <div class="col"></div>
                        <div class="col text-end">
                          <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                            <svg class="me-2" style="width: 30px; height: auto;"  viewBox="0 0 200 200">
                              {{ svg('carbon-warning-alt') }}
                            </svg>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                        </div>
                      </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mb-5">
            <div class="container-fluid d-print-none" id="profile_body">
                <div class="row mb-4 p-4 card shadow-sm align-self-stretch">
                    <div class="col ">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 p-2">
                                {{-- <img class="profile-photo-sm" src="/img/dummy_profile.jpg" alt=""> --}}
                                @if (auth()->user()->profile_photos == null)
                                    <img class="profile-photo-sm" src="/img/dummy_profile.jpg" alt="profile photo">
                                @else
                                    <img class="profile-photo-sm" src="{{ asset('storage/images/profile_photos/'.auth()->user()->profile_photos->profile_photo) }}" alt="profile photo">
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                                <div class="row">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ optional(Auth::user()->suffixes)->suffix_title }}
                                </div>
                                <div class="row">
                                    {{ Auth::user()->user_name }}
                                </div>
                                <div class="row">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                                <div class="row">
                                    {{ Auth::user()->email }}
                                </div>
                                <div class="row">
                                    {{ Auth::user()->roles->role_title }}
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-2">
                                <div class="row">
                                    <div class="row">
                                        <a href="{{ route('admin_profile') }}" class="nav_link">
                                          <i class="nav_icon" >@svg('css-profile')</i>
                                          <span class="nav_name">Profile</span>
                                        </a>
                                    </div>
                                    <a id="logout_submit" class="nav_link" href="#{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bx bx-log-out nav_icon"></i>
                                        <span class="nav_name">SignOut</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @yield('content')
    </div>

    <footer class="position-static pt-5">
        <div class="position-absolute bottom-0 start-50 translate-middle-x  w-100">
            <div class="footer-custom">
                <div class="text-light text-center pt-2 pb-2" style="">
                    <div class="">
                    <a >
                        <p>© {{ now()->year }}
                        <a href="https://www.bioseed.com.ph/" target="#blank" class="text-light">
                            Bioseed Research Philippines, Inc.
                        </a> | Powered by Bioseed Information Management Systems
                        </p>
                    </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> --}}
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </footer>

</body>
</html>
