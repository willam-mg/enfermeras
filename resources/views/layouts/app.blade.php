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
            <x-layout.navbar/>
        @endauth
        
        @include('layouts.flash-message')
        <main class="container">
            <div class="container-luid pt-3">
                <h3 class="text-uppercase">@yield('title')</h3>
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts

    <script>
        function printInWindow(url) {
            $.get( url, function( data ) {
                var w = window.open("", "Imprimir", "width=800,scrollbars=yes,resizable=yes,status=yes");
                w.document.write(data);
                setTimeout(() => {
                    w.print();
                    w.close();
                }, 1000);
            });
        }
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
            window.addEventListener('browserPrint', event => {
                printInWindow(event.detail.url);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
