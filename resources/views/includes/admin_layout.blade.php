<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo_icon.png') }}">

    {{-- Bootstrap 5 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}
    {{-- End Bootstrap 5 --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home_style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile_style.css?version=1.1.0') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2_style.css?version=1.0.2') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatable_style.css?version=1.0.1') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css?version=1.0.1') }}" />
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">

    {{-- Google Fonts --}}
    {{--
    font-family: 'Open Sans', sans-serif;
    font-family: 'Poppins', sans-serif;
    font-family: 'Raleway', sans-serif; 200, 400, 600, 800
    font-family: 'Roboto', sans-serif; 100, 300, 400, 500, 700, 900,
    --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300
    &family=Poppins:wght@900&family=Raleway:wght@200;400;600;800
    &family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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

    {{-- <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script> --}}

    {{-- TinyMCE Editor --}}
    {{-- <script src="https://cdn.tiny.cloud/1/wwnohmwf93vz1jxygxktfrjqohktqf35ys0gg87dp5rhhy4l/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript" src="{{ asset('js/tinymce_editor.js') }}"></script> --}}

    {{-- Javescript Navbar --}}
    <script defer type="text/javascript" src="{{ asset('js/navbar.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('js/submit_buttons_v=1.1.js?version=1.0.2') }}"></script>
    <script defer type="text/javascript" src="{{ asset('js/spinners.js?version=1.0.1') }}"></script>
    <script defer type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
    <link   href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

      :root {
        --header-height: 2rem;
        --nav-width: 70px;
        --first-color: #262626;
        --header-bg: #0a7e48;
        --first-color-light: #00AF46;
        --accent-color:  #f3b200;
        --accent-color-2:  #f3b200;
        --body-font: "Open Sans", sans-serif;
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
        color: rgb(44, 44, 44);
        transition: 0.5s;
        background-color: #f1f1f1;
        /* background-image: radial-gradient(#01143136 1px, #f4f4f4 1px);
        background-size: 20px 20px;
        background-attachment: fixed; */
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
        background-color: var(--header-bg);
        z-index: var(--z-fixed);
        transition: 0.5s;
      }

      .header_toggle {
        color: var(--first-color);
        font-size: 1.5rem;
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
  {{-- <body id="body-pd" oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;"> --}}
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
              <i class="nav_logo">
                  <i class="bx nav_logo-icon" id="bioseed_logo"><img style="width: 30px" src="/img/bioseed_logo_low1.png" alt=""></i>
                  <i class="bx nav_logo-icon" id="bioseed_logo"><img style="width: 100px" src="/img/bioseed_logo_low2.png" alt=""></i>
              </i>
            <div class="nav_list">
                <a href="{{ route('admin_dashboard') }}" class="nav_link @yield('sidebar_dashboard_active')">
                    <i class="bx bx-grid-alt nav_icon"></i>
                    <span class="nav_name">Dashboard</span>
                </a>
                <a href="{{ route('admin_accounts_grid') }}" class="nav_link @yield('sidebar_employee_management_active')">
                    <i class="bx bx-user nav_icon"></i>
                    <span class="nav_name">Account Management</span>
                </a>
                <a href="{{ route('admin.leave.types') }}" class="nav_link @yield('sidebar_leave_management_active')">
                    <i class="bx nav_icon bx-message-square-detail"></i>
                    <span class="nav_name">Leave Management</span>
                </a>
                <a href="{{ route('admin_org_menu') }}" class="nav_link @yield('sidebar_organization_active')">
                    <i class='bx nav_icon bx-buildings' ></i>
                    <span class="nav_name">Organization</span>
                </a>
                <a href="{{ env('LOG_VIEWER_ROUTE') }}" class="nav_link @yield('sidebar_policy_active')">
                    <i class='bx nav_icon bx-file-find' ></i>
                    <span class="nav_name">Log Viewer</span>
                </a>
                <a href="{{ route('admin_policy_menu') }}" class="nav_link @yield('sidebar_policy_active')">
                    <i class="ms-0" style="width: 25px">
                      {{ svg('carbon-policy') }}
                    </i>
                    <span class="nav_name">Policy</span>
                </a>
                <a href="#" class="nav_link">
                    <i class="bx x-tabler-report nav_icon">{{ svg('tabler-report-analytics') }}</i>
                    <span class="nav_name">Report</span>
                </a>
                <a href="{{ route('admin_system_settings') }}" class="nav_link @yield('sidebar_settings_active')">
                  <i class="bx x-tabler-report nav_icon" style="width: 25px">
                    {{ svg('carbon-settings') }}
                  </i>
                  <span class="nav_name">Settings</span>
              </a>
            </div>
          </div>
          <a class="nav_link" href="{{ route('logout') }}"
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

        @yield('content')

    </div>

    <footer class="position-static mt-5 pt-5" >
        <div class="position-absolute bottom-0 start-50 translate-middle-x  w-100">
            <div class="text-secondary text-center pt-2 pb-2" style="">
                <p class="mb-0">© {{ now()->year }}
                    <a href="https://www.bioseed.com.ph/" target="#blank" class="text-secondary">
                        Bioseed Research Philippines, Inc.
                    </a> | All Rights Reserved | {{ env('APP_VERSION') }}
                </p>
                <p>Powered by Bioseed Information Management Systems</p>
            </div>
        </div>
        <script type="text/javascript">
            $(".alert").delay(4000).slideUp(200, function() {
                  $(this).alert('close');
              });

            $(document).ready(function () {
                $('.js-basic-single').select2({
                    placeholder: "select here",
                    selectOnClose: false,
                    width: 'resolve',
                });

                $('#data_table').dataTable({
                    order: [],
                    pagingType: 'simple',
                    renderer: {
                        pagingButton: 'bootstrap',
                        pagingContainer: 'bootstrap5'
                    },
                    autoFill: {
                        columns: ':not(:first-child)'
                    },
                    language: {
                        lengthMenu: 'Change the number of records to show _MENU_ ',
                        paginate: {
                            // next: 'Next >',
                            // previous: '< Previous',
                        }
                    },
                    // layout: {
                    //     topStart: 'buttons'
                    // },
                    layout: {
                        topEnd: {
                            search: {
                                placeholder: 'Type here to filter the table',
                                text: 'Search'
                            }
                        }
                    }
                }).css({ 'margin-top': '0em' });
            });
            // new DataTable('#data_table',{
            //     pagingType: 'first_last_numbers'
            // });
        </script>
        <script
          src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
          crossorigin="anonymous">
        </script>
    </footer>

  </body>
</html>
