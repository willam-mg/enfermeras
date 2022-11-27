<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- @livewireStyles --}}
</head>
<body>
    <div id="app">
        @auth
            <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('img/logo.png')}}" alt="foto" width="70" height="auto">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="{{ url('users') }}">
                                    Usuarios
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="{{ url('afiliados') }}">
                                    Afiliados
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="{{ url('aportes') }}">
                                    Aportes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="{{ url('obsequios') }}">
                                    Obsequios
                                </a>
                            </li>
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
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="bi bi-person"></i>
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
            </nav>
        @endauth
        
        @include('layouts.flash-message')
        <main class="container">
            <div class="container-luid pt-3">
                <h3 class="text-uppercase">@yield('title')</h3>
                @yield('content')
                {{-- {{ $slot }} --}}
            </div>
        </main>
    </div>

    

    @livewireScripts

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('modal', (event) => {
                $(`#modal-${event.detail.component}`).modal(event.detail.event);
            });
            window.addEventListener('switalert', (event) => {
                let data = event.detail;
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    text: data.message
                })
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
