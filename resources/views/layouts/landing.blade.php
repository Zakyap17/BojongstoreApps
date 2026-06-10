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

    {{-- Mobile Nav & Drawer (inline to bypass server CSS cache) --}}
    <style>
        .mobile-action-btn,.mobile-search-bar-wrap,.mobile-drawer-overlay,.mobile-drawer{display:none}
        @media(max-width:768px){
            header{height:68px}
            header .container{padding:0 16px}
            .header-left{gap:20px}
            .nav-links,.desktop-search,.desktop-bookmark,.desktop-user-dropdown,.desktop-auth{display:none!important}
            .mobile-action-btn{display:flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:50%;border:none;background:#f1f5f9;color:var(--text-dark);cursor:pointer;transition:all .2s ease}
            .mobile-action-btn:hover{background:#e2e8f0;color:var(--green-primary)}
            .header-actions{gap:8px}
            .mobile-search-bar-wrap{position:absolute;top:68px;left:0;width:100%;background:white;padding:12px 16px;border-bottom:1.5px solid #f1f5f9;box-shadow:0 8px 16px rgba(0,0,0,.04);z-index:999}
            .mobile-drawer-overlay{display:block;position:fixed;top:0;left:0;width:100%;height:100vh;background:rgba(10,77,46,.2);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);z-index:2000}
            .mobile-drawer{display:flex;position:fixed;top:0;right:0;width:85%;max-width:300px;height:100vh;background:white;box-shadow:-10px 0 40px rgba(0,0,0,.15);z-index:2001;flex-direction:column;padding:20px;overflow-y:auto}
            .drawer-header{display:flex;justify-content:space-between;align-items:center;padding-bottom:16px;border-bottom:1px solid #f0f0f0;margin-bottom:20px}
            .drawer-header .logo-text{font-weight:800;font-size:15px;color:var(--green-primary);letter-spacing:1px}
            .drawer-close-btn{width:34px;height:34px;border-radius:50%;background:#f1f5f9;color:var(--text-gray);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s}
            .drawer-close-btn:hover{background:#e2e8f0;color:var(--text-dark)}
            .drawer-user-info-section{display:flex;align-items:center;gap:12px;padding:12px 0 16px;border-bottom:1px solid #f0f0f0;margin-bottom:16px}
            .drawer-nav{display:flex;flex-direction:column;gap:4px}
            .drawer-link{display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:10px;font-size:14px;font-weight:600;color:var(--text-dark);text-decoration:none;transition:all .2s}
            .drawer-link:hover,.drawer-link.active{background:var(--green-bg);color:var(--green-primary)}
            .drawer-footer{margin-top:auto;padding:16px;border-top:1px solid #f0f0f0;display:flex;flex-direction:column;gap:8px}
            .drawer-btn{width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:12px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;transition:all .2s;font-family:inherit;text-decoration:none}
            .drawer-btn-login{background:var(--green-primary);color:white}
            .drawer-btn-signup{background:var(--green-bg);color:var(--green-primary)}
            .drawer-btn-logout{background:rgba(192,57,43,.08);color:#c0392b}
        }
    </style>

    {{-- Page-specific styles --}}
    @stack('styles')

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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