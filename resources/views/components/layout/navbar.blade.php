<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('img/logo.png')}}" alt="foto" width="70" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{(request()->is('users.*'))?'active':''}}"  href="{{ url('users') }}">
                        <i class="bi-person"></i>
                        Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <x-layout.navlink :href="url('afiliados')" :active="Request::is('afiliados*')">
                        <i class="bi bi-people"></i>
                        {{ __('Afiliados') }}
                    </x-layout.navlink>
                </li>
                <li class="nav-item">
                    <x-layout.navlink :href="url('aportes')" :active="Request::is('aportes*')">
                        <i class="bi bi-credit-card-2-front"></i>
                        {{ __('Aportes') }}
                    </x-layout.navlink>
                </li>
                <li class="nav-item">
                    <x-layout.navlink :href="url('obsequios')" :active="Request::is('obsequios*')">
                        <i class="bi bi-gift"></i>
                        {{ __('Obsequios') }}
                    </x-layout.navlink>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{(request()->is('reportes.*'))?'active':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-file-bar-graph"></i>
                        {{ __('Reportes') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <x-layout.navlink :href="url('reportes/afiliados')" :active="Request::is('reportes*')">
                                {{ __('Afiliados') }}
                            </x-layout.navlink>
                        </li>
                    </ul>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="bi bi-person"></i>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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