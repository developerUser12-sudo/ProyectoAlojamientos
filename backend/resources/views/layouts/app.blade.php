<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ config('app.frontend_url') }}/assets/img/favicon.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HolidaysNow</title>
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox-plus-jquery.min.js"></script>

</head>

<body>
    <div id="app" class="page">
        <header>
            <nav class="navbar navbar-expand-lg bg-primary shadow-sm" id="customNavbar">
                <div class="container-fluid">

                    <a class="navbar-brand d-flex flex-column align-items-center text-light fs-5 fw-semibold"
                        href="{{ config('app.frontend_url') }}">
                        <img src="{{ config('app.frontend_url') }}/assets/img/logo.webp" alt="Logo"
                            style="max-width: 200px;">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse text-center mt-2 mt-sm-0" id="navbarContent">
                        <div
                            class="navbar-nav d-flex flex-column flex-sm-row gap-2 gap-sm-4 w-100 align-items-sm-center w-100">

                            <div class="d-flex flex-column flex-sm-row gap-4 p-3">
                                <a class="nav-link text-light ms-lg-2"
                                    href="{{ config('app.frontend_url') }}/hoteles">Hoteles</a>
                                <a class="nav-link text-light" href="{{ config('app.frontend_url') }}/coches">Coches</a>
                            </div>

                            <div class="ms-sm-auto d-flex flex-column flex-sm-row gap-2 gap-sm-4 align-items-sm-center">

                                @guest
                                    <a class="nav-link text-light" href="{{ route('login') }}">
                                        <i class="bi bi-door-open-fill"></i> Identificarse
                                    </a>
                                @else
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-people-fill me-2"></i>{{ Auth::user()->name }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                            <li>
                                                <a href="{{ config('app.url') }}/cuenta" class="dropdown-item">Mi cuenta</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('reservas') }}" class="dropdown-item">Mis reservas</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endguest

                                <a class="nav-link text-light" href="{{ config('app.frontend_url') }}/soporte">Soporte</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main class="py-4 content ">
            @yield('content')
        </main>

        <footer class="footer bg-primary d-flex flex-column">
            <div class="w-100 d-flex flex-column flex-md-row justify-content-md-around text-center p-4">
                <ul class="list-unstyled ">
                    <li><a class="text-decoration-none text-white" href="{{ config('app.frontend_url') }}/politica-de-cookies">Política de cookies</a></li>
                    <li class="mt-3"><a class="text-decoration-none text-white" href="{{ config('app.frontend_url') }}/terminos-de-servicio">Términos de servicio</a></li>
                </ul>
                <ul class="list-unstyled ">
                    <li><a class="text-decoration-none text-white" href="{{ config('app.frontend_url') }}/politica-de-privacidad">Política de privacidad</a></li>
                    <li class="mt-3"><a class="text-decoration-none text-white" href="{{ config('app.frontend_url') }}/sobre-nosotros">Sobre nosotros</a></li>
                </ul>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none text-white" href="{{ config('app.frontend_url') }}/preguntas-frecuentes">Preguntas frecuentes</a></li>
                    <li class="mt-3"><a class="text-decoration-none text-white" href="{{ config('app.frontend_url') }}/informacion-de-la-empresa">Información de la empresa</a>
                    </li>
                </ul>
            </div>

            <div class="row w-100">
                <p class="col text-center text-light">
                    <i class="bi bi-c-circle-fill "></i> 2025 HolidaysNow
                </p>
            </div>
        </footer>
    </div>
</body>

</html>