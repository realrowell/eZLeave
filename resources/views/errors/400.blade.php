<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>400 Bad request</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
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

    <style>
        body{
            background-color: #f4f4f4;
            background-image: radial-gradient(#01143136 1px, #f4f4f4 1px);
            background-size: 20px 20px;
             font: 20px Helvetica, sans-serif; color: #333;
        }
        h1 { font-size: 50px; margin: 0; }
            article { text-align: left; max-width: 650px; margin: 0 auto; }
            a { color: #dc8100; text-decoration: none; }
            a:hover { color: #333; text-decoration: none; }
            @media only screen and (max-width : 480px) {
                h1 { font-size: 40px; }
            }

    </style>
</head>

<body>
    <header>
        <nav class="navbar" id="header_main">
            <div class="container ">
                <div class="d-flex bd-highlight">
                    <a class="navbar-brand text-white">Bioseed Leave Management System |</a>
                    <a class="navbar-brand text-white" target="#blank" href="https://www.bioseed.com.ph">bioseed.com.ph</a>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="container-fluid justify-centent-center align-items-center">
            <div class="row">
                <div class="col">
                    <article class="text-center" style=" padding-top: 5%">
                        <h1 class="text-start" style="font-family: 'Poppins', sans-serif; font-size: 10rem">400</h1>
                        <p class="text-start " style="margin-top: -10px; font-size: 3rem">Bad Request</p>
                        <p class="text-start " style="margin-top: 50px; font-size: 2rem">Oops! Something went wrong. Please check your request and try again.</p>
                        <p class="text-start" id="signature" style=" font-size: 2rem"><a href="{{ route('index') }}">go back to home </a></p>
                    </article>
                </div>
            </div>
            <div class="row text-center " style="margin-top: 20vh">
                <div class="col">
                    <h2>GO TO <a href="http://www.bioseed.com.ph">www.bioseed.com.ph</a></h2>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

