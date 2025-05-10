<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2" defer></script>
</head>

<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-md bg-primary shadow-sm" id="customNavbar">
                <div class="container-fluid d-flex flex-row gap-4">
                    <a class="navbar-brand d-flex flex-column align-items-center text-light fs-5 fw-semibold"
                        href="http://localhost:4200/frontend/">
                        <i class="bi bi-airplane-fill"></i> HolidaysNow
                    </a>
                    <a class="nav-link text-light" href="http://localhost:4200/frontend/vuelos/">Vuelos</a>
                    <a class="nav-link text-light" href="http://localhost:4200/frontend/hoteles/">Hoteles</a>
                    <a class="nav-link text-light" href="http://localhost:4200/frontend/vuelos/alquilercoches">Alquiler
                        de coches</a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarContent">
                        <div class="navbar-nav ms-auto d-flex flex-column flex-sm-row gap-2 gap-sm-4">

                            @if (Route::has('login'))
                                @auth
                                    <div class="dropdown inline-block text-left">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-people-fill"></i>{{ Auth::user()->name }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                            <li>
                                                <!-- <form  action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Mi cuenta</button>
                                                </form> -->
                                                 <a href="http://localhost:8000/dashboard" class="dropdown-item">Mi cuenta</a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endauth
                            @endif
                            <a class="nav-link text-light" href="http://127.0.0.1:8000">Soporte</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>



        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>

</html>