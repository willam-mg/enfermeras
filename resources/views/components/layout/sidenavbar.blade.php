<ul class="{{$orientation=='vertical'?'nav nav-pills flex-column mb-auto':'navbar-nav me-auto '}}">
    <li class="nav-item">
        <x-layout.navlink :href="url('users')" :active="Request::is('users*')">
            <i class="bi bi-people me-2"></i>
            {{ __('Usuarios') }}
        </x-layout.navlink>
    </li>
    <li class="nav-item">
        <x-layout.navlink :href="url('afiliados')" :active="Request::is('afiliados*')">
            <i class="bi bi-people me-2"></i>
            {{ __('Afiliados') }}
        </x-layout.navlink>
    </li>
    <li class="nav-item">
        <x-layout.navlink :href="url('aportes')" :active="Request::is('aportes*')">
            <i class="bi bi-calendar-check me-2"></i>
            {{ __('Aportes') }}
        </x-layout.navlink>
    </li>
    <li class="nav-item">
        <x-layout.navlink :href="url('obsequios')" :active="Request::is('obsequios*')">
            <i class="bi bi-gift me-2"></i>
            {{ __('Obsequios') }}
        </x-layout.navlink>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link link-dark p-3 dropdown-toggle {{(request()->is('reportes.*'))?'active':''}}" href="#"
            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-file-bar-graph me-2"></i>
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
@if ($orientation == "vertical")
    @auth
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person ms-3 me-3"></i>
                {{-- <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2"> --}}
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="{{ url('users') }}">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @endauth
@endif