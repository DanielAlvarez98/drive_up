<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('extra_resource')
</head>

<body>
    @include('layouts.structure.sweet')

    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="" href="{{ url('/') }}">
                    <img src="{{ asset('storage/logos/logodrive.png') }}" alt="" width="240" height="70px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        @include('layouts.structure.sidebar')

        <div id="main">
            {{-- <header class="">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> --}}
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                        @php($noti = userNotifications())

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column flex-md-row" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-bell fs-4"></i>

                                        @if ($noti['total'] > 0)
                                            <span class="badge bg-danger">
                                                {{ $noti['total'] }}
                                            </span>
                                        @endif
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end p-2">

                                        <li class="dropdown-header fw-bold">
                                            Notificaciones
                                            <small class="text-danger">{{ $noti['expired'] }} vencidas</small>,
                                            <small class="text-warning">{{ $noti['warning'] }} por vencer</small>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        @forelse($noti['items'] as $alert)
                                            <li>
                                                <div class="dropdown-item small">
                                                    <i class="bi {{ $alert['icon'] }} text-{{ $alert['type'] }}"></i>
                                                    <strong>{{ $alert['title'] }}</strong><br>
                                                    {{ $alert['text'] }} {{ $alert['days'] }} días<br>
                                                    <small class="text-muted">{{ $alert['car'] }}</small>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="dropdown-item text-center text-muted">
                                                Sin notificaciones
                                            </li>
                                        @endforelse
                                    </ul>



                                </li>
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">
                                                {{ Auth::user()->name }}
                                            </h6>
                                            <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->email }}
                                            </p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('assets/logos/default.png') }}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">

                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="icon-mid bi bi-box-arrow-left me-2">
                                            </i>
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            @yield('content')
        </div>
        {{-- <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="http://ahmadsaugi.com">A. Saugi</a></p>
                </div>
            </div>
        </footer> --}}
    </div>
    <!-- Botón burbuja -->
    <div id="chat-bubble">
        <i class="bi bi-chat-dots-fill"></i>
    </div>

    <!-- Chatbox -->
    <div id="chat-box" class="chat-hidden">
        <div class="col-md-12">
            <div class="card chat-card">
                <div class="card-header">
                    <div class="media d-flex align-items-center">

                        <button class="btn btn-sm" id="close-chat">
                            ✕
                        </button>
                    </div>
                </div>

                <div class="card-body pt-4 bg-light chat-body-scroll">
                    <div class="chat-content" id="chatContent">
                        <div class="mt-3" id="questionsBox">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
