<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Fatayat NU PAC Pragaan')
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">

    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite('resources/css/app.css')

    <style>
        :root {
            --green-dark: #075b38;
            --green: #087f4f;
            --green-light: #e9f7ef;
            --gold: #d7a928;
            --gold-light: #fff7dc;
            --dark: #17231d;
            --muted: #68746d;
            --white: #ffffff;
            --border: #e8eee9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8faf9;
            color: var(--dark);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
        }

        /* =========================================================
           NAVBAR
        ========================================================= */

        .main-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            background: rgba(255, 255, 255, 0.97);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(15px);
        }

        .navbar-container {
            max-width: 1400px;
            margin: auto;
            min-height: 78px;
            padding: 0 28px;

            display: flex;
            align-items: center;
            gap: 25px;
        }

        /* LOGO */

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 14px;

            background: linear-gradient(145deg,
                    var(--green),
                    var(--green-dark));

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
            font-size: 21px;

            box-shadow: 0 8px 20px rgba(7, 91, 56, .18);
        }

        .brand-text {
            line-height: 1.15;
        }

        .brand-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--green-dark);
        }

        .brand-subtitle {
            margin-top: 4px;
            font-size: 11px;
            color: #7c8780;
            font-weight: 500;
        }

        /* MENU */

        .navbar-menu {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;

            flex: 1;
        }

        .nav-link {
            position: relative;

            display: flex;
            align-items: center;
            gap: 7px;

            padding: 10px 13px;
            border-radius: 10px;

            color: #46524b;
            font-size: 13px;
            font-weight: 600;

            transition: .25s ease;
            white-space: nowrap;
        }

        .nav-link i {
            font-size: 12px;
            opacity: .8;
        }

        .nav-link:hover {
            color: var(--green);
            background: var(--green-light);
        }

        .nav-link.active {
            color: var(--green);
            background: var(--green-light);
        }

        .nav-link.active::after {
            content: "";

            position: absolute;
            left: 13px;
            right: 13px;
            bottom: 4px;

            height: 2px;
            border-radius: 10px;

            background: var(--gold);
        }

        /* =========================================================
           RIGHT ACTIONS
        ========================================================= */

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        /* NOTIFICATION */

        .notification-button {
            position: relative;

            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--border);
            background: white;
            border-radius: 12px;

            color: #536058;
            cursor: pointer;

            transition: .25s ease;
        }

        .notification-button:hover {
            background: var(--green-light);
            color: var(--green);
            border-color: #cde7d8;
        }

        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;

            min-width: 15px;
            height: 15px;

            padding: 0 4px;

            border-radius: 999px;

            background: #d93636;
            color: white;

            font-size: 8px;
            font-weight: 800;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 2px solid white;
        }

        /* LOGIN */

        .login-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 42px;
            padding: 0 16px;

            border-radius: 12px;

            background: var(--green);
            color: white;

            font-size: 13px;
            font-weight: 700;

            box-shadow: 0 7px 18px rgba(8, 127, 79, .18);

            transition: .25s ease;
        }

        .login-button:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(8, 127, 79, .25);
        }

        /* USER */

        .user-button {
            display: flex;
            align-items: center;
            gap: 9px;

            padding: 5px 10px 5px 5px;

            border: 1px solid var(--border);
            border-radius: 12px;

            background: white;

            cursor: pointer;
        }

        .user-avatar {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: var(--green-light);
            color: var(--green);

            font-size: 13px;
        }

        .user-name {
            font-size: 12px;
            font-weight: 700;
            color: #36413b;
        }

        /* =========================================================
           MOBILE BUTTON
        ========================================================= */

        .mobile-menu-button {
            display: none;

            width: 42px;
            height: 42px;

            border: 1px solid var(--border);
            border-radius: 12px;

            background: white;
            color: var(--green-dark);

            cursor: pointer;
            font-size: 17px;
        }

        /* =========================================================
           MOBILE MENU
        ========================================================= */

        .mobile-menu {
            display: none;

            padding: 10px 20px 20px;

            background: white;
            border-top: 1px solid var(--border);
        }

        .mobile-menu.open {
            display: block;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 13px 14px;
            margin-top: 4px;

            border-radius: 11px;

            color: #46524b;
            font-size: 14px;
            font-weight: 600;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            color: var(--green);
            background: var(--green-light);
        }

        .mobile-actions {
            display: flex;
            align-items: center;
            gap: 8px;

            padding-top: 12px;
            margin-top: 8px;

            border-top: 1px solid var(--border);
        }

        .mobile-login {
            flex: 1;
        }

        /* =========================================================
           PAGE
        ========================================================= */

        .page-content {
            min-height: calc(100vh - 78px);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1150px) {

            .navbar-container {
                gap: 15px;
            }

            .navbar-menu {
                gap: 0;
            }

            .nav-link {
                padding: 9px 9px;
                font-size: 12px;
            }

            .nav-link i {
                display: none;
            }

            .brand-subtitle {
                display: none;
            }
        }

        @media (max-width: 900px) {

            .navbar-menu {
                display: none;
            }

            .mobile-menu-button {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .navbar-actions {
                margin-left: auto;
            }

            .navbar-container {
                min-height: 70px;
                padding: 0 18px;
            }
        }

        @media (max-width: 520px) {

            .navbar-container {
                padding: 0 13px;
                gap: 8px;
            }

            .brand-logo {
                width: 40px;
                height: 40px;
                border-radius: 11px;
                font-size: 17px;
            }

            .brand-title {
                font-size: 12px;
            }

            .brand-subtitle {
                display: none;
            }

            .notification-button,
            .mobile-menu-button {
                width: 38px;
                height: 38px;
                border-radius: 10px;
            }

            .login-button {
                width: 38px;
                height: 38px;

                padding: 0;

                border-radius: 10px;
            }

            .login-button span {
                display: none;
            }

            .login-button i {
                margin: 0;
            }

            .user-button {
                padding: 4px;
            }

            .user-name {
                display: none;
            }

            .user-button i {
                display: none;
            }
        }

        @media (max-width: 360px) {

            .brand-title {
                font-size: 11px;
            }

            .brand-logo {
                width: 37px;
                height: 37px;
            }

            .navbar-actions {
                gap: 4px;
            }

            .notification-button,
            .mobile-menu-button,
            .login-button {
                width: 35px;
                height: 35px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- =========================================================
         NAVBAR
    ========================================================== --}}
    <header class="main-navbar">

        <div class="navbar-container">

            {{-- LOGO --}}
            <a href="{{ url('/') }}" class="navbar-brand">

                <div class="brand-logo">
                    <i class="fa-solid fa-seedling"></i>
                </div>

                <div class="brand-text">
                    <div class="brand-title">
                        Fatayat NU
                    </div>

                    <div class="brand-subtitle">
                        PAC Pragaan
                    </div>
                </div>

            </a>


            {{-- =================================================
                 DESKTOP MENU
            ================================================== --}}
            <nav class="navbar-menu">

                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    Beranda
                </a>

                <a href="{{ route('profil.publik') }}"
                    class="nav-link {{ request()->routeIs('profil.publik') ? 'active' : '' }}">
                    <i class="fa-solid fa-building"></i>
                    Profil
                </a>

                <a href="{{ route('berita.publik.index') }}"
                    class="nav-link {{ request()->routeIs('berita.publik.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i>
                    Berita
                </a>

                <a href="{{ route('dokumentasi.publik.index') }}"
                    class="nav-link {{ request()->routeIs('dokumentasi.publik.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-images"></i>
                    Dokumentasi
                </a>

                <a href="{{ route('pengaduan.publik.create') }}"
                    class="nav-link {{ request()->routeIs('pengaduan.publik.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-pen"></i>
                    Ajukan Laporan
                </a>

                <a href="{{ route('pengaduan.publik.cek') }}"
                    class="nav-link {{ request()->routeIs('pengaduan.publik.cek') ? 'active' : '' }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Cek Laporan
                </a>

                <a href="#kontak" class="nav-link">
                    <i class="fa-solid fa-phone"></i>
                    Kontak
                </a>

            </nav>


            {{-- =================================================
                 LOGIN + NOTIFIKASI
                 SEKARANG SATU BARIS DENGAN NAVBAR
            ================================================== --}}
            <div class="navbar-actions">

                {{-- NOTIFIKASI --}}
                @auth
                    <a href="{{ route('notifikasi.index') }}" class="notification-button" title="Notifikasi"
                        aria-label="Notifikasi">
                        <i class="fa-regular fa-bell"></i>
                        @if (auth()->user()->unreadNotifications()->count())
                            <span class="notification-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('login') }}" class="notification-button" title="Login untuk melihat notifikasi"
                        aria-label="Login untuk melihat notifikasi"><i class="fa-regular fa-bell"></i></a>
                @endauth


                {{-- LOGIN / USER --}}
                @auth

                    <a href="{{ url('/dashboard') }}" class="user-button">

                        <div class="user-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <span class="user-name">
                            {{ auth()->user()->name }}
                        </span>

                        <i class="fa-solid fa-chevron-down" style="font-size: 9px; color:#89938d;"></i>

                    </a>
                @else
                    <a href="{{ route('login') }}" class="login-button">

                        <i class="fa-solid fa-right-to-bracket"></i>

                        <span>
                            Login
                        </span>

                    </a>

                @endauth


                {{-- MOBILE TOGGLE --}}
                <button type="button" class="mobile-menu-button" id="mobileMenuButton" aria-label="Buka menu">

                    <i class="fa-solid fa-bars"></i>

                </button>

            </div>

        </div>


        {{-- =====================================================
             MOBILE MENU
        ====================================================== --}}
        <div class="mobile-menu" id="mobileMenu">

            <a href="{{ url('/') }}" class="mobile-nav-link {{ request()->is('/') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>
                Beranda

            </a>


            <a href="{{ route('profil.publik') }}"
                class="mobile-nav-link {{ request()->routeIs('profil.publik') ? 'active' : '' }}">

                <i class="fa-solid fa-building"></i>
                Profil

            </a>


            <a href="{{ route('berita.publik.index') }}"
                class="mobile-nav-link {{ request()->routeIs('berita.publik.*') ? 'active' : '' }}">

                <i class="fa-solid fa-newspaper"></i>
                Berita

            </a>


            <a href="{{ route('dokumentasi.publik.index') }}"
                class="mobile-nav-link {{ request()->routeIs('dokumentasi.publik.*') ? 'active' : '' }}">

                <i class="fa-solid fa-images"></i>
                Dokumentasi

            </a>


            <a href="{{ route('pengaduan.publik.create') }}"
                class="mobile-nav-link {{ request()->routeIs('pengaduan.publik.create') ? 'active' : '' }}">

                <i class="fa-solid fa-file-pen"></i>
                Ajukan Laporan

            </a>


            <a href="{{ route('pengaduan.publik.cek') }}"
                class="mobile-nav-link {{ request()->routeIs('pengaduan.publik.cek') ? 'active' : '' }}">

                <i class="fa-solid fa-magnifying-glass"></i>
                Cek Laporan

            </a>


            <a href="#kontak" class="mobile-nav-link">

                <i class="fa-solid fa-phone"></i>
                Kontak

            </a>


            {{-- ACTION MOBILE --}}
            <div class="mobile-actions">

                {{-- Notifikasi --}}
                @auth
                    <a href="{{ route('notifikasi.index') }}" class="notification-button" title="Notifikasi"
                        aria-label="Notifikasi">
                        <i class="fa-regular fa-bell"></i>
                        @if (auth()->user()->unreadNotifications()->count())
                            <span class="notification-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('login') }}" class="notification-button" title="Login untuk melihat notifikasi"
                        aria-label="Login untuk melihat notifikasi"><i class="fa-regular fa-bell"></i></a>
                @endauth


                @auth

                    <a href="{{ url('/dashboard') }}" class="login-button mobile-login">

                        <i class="fa-solid fa-gauge-high"></i>

                        <span>
                            Dashboard
                        </span>

                    </a>
                @else
                    <a href="{{ route('login') }}" class="login-button mobile-login">

                        <i class="fa-solid fa-right-to-bracket"></i>

                        <span>
                            Login
                        </span>

                    </a>

                @endauth

            </div>

        </div>

    </header>


    {{-- =========================================================
         CONTENT
    ========================================================== --}}
    <main class="page-content">

        @yield('content')

    </main>


    {{-- =========================================================
         SCRIPT
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const menuButton =
                document.getElementById('mobileMenuButton');

            const mobileMenu =
                document.getElementById('mobileMenu');


            if (menuButton && mobileMenu) {

                menuButton.addEventListener('click', function() {

                    mobileMenu.classList.toggle('open');

                    const icon =
                        menuButton.querySelector('i');

                    if (mobileMenu.classList.contains('open')) {

                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-xmark');

                    } else {

                        icon.classList.remove('fa-xmark');
                        icon.classList.add('fa-bars');

                    }

                });


                /*
                 * Tutup menu setelah memilih link
                 */
                mobileMenu
                    .querySelectorAll('a')
                    .forEach(function(link) {

                        link.addEventListener('click', function() {

                            mobileMenu.classList.remove('open');

                            const icon =
                                menuButton.querySelector('i');

                            icon.classList.remove('fa-xmark');
                            icon.classList.add('fa-bars');

                        });

                    });

            }

        });
    </script>

    @stack('scripts')

</body>

</html>
