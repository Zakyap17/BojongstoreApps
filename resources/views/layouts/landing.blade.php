<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BojongStore') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Legacy Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Page-specific styles --}}
    @stack('styles')

    {{-- Alpine JS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body x-data x-init="$el.classList.add('opacity-0'); setTimeout(() => $el.classList.remove('opacity-0'), 100)"
    class="transition-opacity duration-700 ease-in-out opacity-0">
    <div>
        {{-- Navbar --}}
        @auth
            @include('layouts.navigation.user')
        @else
            @include('layouts.navigation.landing')
        @endauth

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('a[href]:not([target="_blank"]):not([href^="#"])');
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const href = this.href;
                    document.body.classList.add('opacity-0');
                    setTimeout(() => {
                        window.location.href = href;
                    }, 150);
                });
            });
        });
    </script>
</body>

</html>