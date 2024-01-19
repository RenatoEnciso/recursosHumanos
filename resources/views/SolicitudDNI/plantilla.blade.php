<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('titulo')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar bg " data-bs-theme="dark" style="background: #004370;">
        <div class="container-fluid d-inline">
            <a class="navbar-brand">
                <div class="row " >
                    <div class="col-auto ">
                        <img src="{{ asset('images/Logo-Login.png') }}" alt="Logo" width="170" height="80"
                            class="d-inline-block align-text-top mx-5">
                    </div>
                    <div class="col-auto my-0" style="font-size: 20px;">
                        <p style="margin-top: 15px; margin-bottom: 0;color: white"> <b>@yield('subtitulo') </b></p>
                        <hr style="margin-top: 10px; margin-bottom: 0; border-width:3px; color: white"> 
                        <p style="margin-top: 0; margin-bottom: 0; font-style:italic; font-size:15px; color: white"> <b>Servicios en Linea</b> </p>
                    </div>
                </div>
            </a>
        </div>
    </nav>

    <div class="container border mx-auto my-4" style="width:700px;">
        @yield('cuerpo')
        @if (session('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ 'success' }}
            </div>
        @else
            @if (session('alert'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session('alert') }}
                </div>
            @endif
        @endif
    </div>

    <footer class="text-white text-center" style="background-color: #7E0047;">
        <div class="container p-3"></div>
        <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.2);">
            <P>Ingeniería de Software II © 2024 - Geronimo Dionicio Percy </P>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
