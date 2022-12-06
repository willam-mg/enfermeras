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
    @livewireStyles
</head>

<body>
    <div id="app">
        @auth
        <x-layout.navbar />
        @endauth
        <div class="d-none d-sm-block">
            <div
                class="d-flex flex-column flex-shrink-0 bg-light float-start shadow min-vh-100 d-inline-block content-left fixed-top">
                <x-layout.sidenavbar />
            </div>
        </div>
        <main class="container content-right float-end">
            <div class="container-luid pt-3 bg-light">
                @include('layouts.flash-message')
                <h3 class="text-uppercase">@yield('title')</h3>
                @yield('breadcrumbs')
                @yield('content')
            </div>
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>