<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/img/logo_icon.png">
    
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    {{-- End Bootstrap 5 --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/home_style.css') }}" />


    {{-- Google Fonts --}}
    {{-- 
    font-family: 'Open Sans', sans-serif;
    font-family: 'Poppins', sans-serif;
    font-family: 'Raleway', sans-serif; 
    --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@900&family=Raleway&display=swap" rel="stylesheet">
    {{-- End Google Fonts --}}
    
</head>

<body>
    <header>
        <nav class="navbar" id="header_main">
            <div class="container ">
                <div class="d-flex bd-highlight">
                    <a class="navbar-brand text-white">Bioseed Leave Management System |</a>
                    <a class="navbar-brand  text-white" target="#blank" href="https://www.bioseed.com.ph">bioseed.com.ph</a>
                </div>
            </div>
        </nav>
    </header>
    <section>
        @yield('content')
    </section>
    <footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

        <script type="text/javascript" src="{{ asset('js/submit_buttons.js') }}"></script>
        
    </footer>
</body>
</html>