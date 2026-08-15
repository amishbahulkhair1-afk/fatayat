<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        // Inisialisasi tema sebelum halaman dirender
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#F4F7F4]" x-data="{
    sidebarOpen: false,
    organisasi: true,
    kaderisasi: true,
    administrasi: true,
    publikasi: true,
    laporan: true,
    zoom: parseInt(localStorage.getItem('app_zoom') || 100)
}" x-init="document.documentElement.style.fontSize = zoom + '%';

$watch('zoom', value => {
    document.documentElement.style.fontSize = value + '%';
    localStorage.setItem('app_zoom', value);
});">

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay Mobile -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/40 lg:hidden"
            @click="sidebarOpen = false"></div>

        @php
            $user = auth()->user();
        @endphp

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#F4F7F4] border-r border-[#F4F7F4] flex flex-col transform transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 lg:flex-shrink-0">

            {{-- Logo --}}
            <div class="h-20 flex items-center justify-between px-6 border-b border-[#F4F7F4] bg-[#F4F7F4]">
                <div class="flex items-center gap-3">
                    <div
                        class="w-11 h-11 rounded-2xl bg-gradient-to-br from-green-600 to-emerald-700 flex items-center justify-center shadow-lg shadow-green-700/20">
                        <span class="text-white font-bold text-sm">NU</span>
                    </div>

                    <div>
                        <h1 class="font-bold text-gray-900 text-sm leading-tight">
                            {{ config('app.name', 'Laravel') }}
                        </h1>
                        <p class="text-xs text-gray-500">Sistem Informasi NU</p>
                    </div>
                </div>

                <button @click="sidebarOpen = false"
                    class="lg:hidden w-9 h-9 rounded-xl hover:bg-gray-100 flex items-center justify-center">
                    ✕
                </button>
            </div>

            {{-- Menu --}}
            <nav class="sidebar-scroll flex-1 overflow-y-auto px-3 py-4 text-sm">

                {{-- ================= ADMIN PAC ================= --}}
                @if ($user->role === 'admin_pac')
                    <a href="{{ route('dashboard.pac') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 font-medium transition {{ request()->routeIs('dashboard.pac') ? 'bg-green-600 text-white shadow-lg shadow-green-600/20' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                        <span class="text-lg">🏠</span>
                        Dashboard
                    </a>

                    {{-- ORGANISASI --}}
                    <div class="mt-6">
                        <button @click="organisasi = !organisasi"
                            class="w-full flex items-center justify-between px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-gray-700">
                            <span>Organisasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform"
                                :class="organisasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="organisasi" x-transition class="mt-2 space-y-1">

                            <a href="{{ route('pac.index') }}"
                                class="{{ request()->routeIs('pac.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🏢</span>
                                <span>PAC</span>
                            </a>

                            <a href="{{ route('pr.index') }}"
                                class="{{ request()->routeIs('pr.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🏘️</span>
                                <span>PR</span>
                            </a>

                            <a href="{{ route('par.index') }}"
                                class="{{ request()->routeIs('par.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🏠</span>
                                <span>PAR</span>
                            </a>

                            <a href="{{ route('pengurus.index') }}"
                                class="{{ request()->routeIs('pengurus.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">👤</span>
                                <span>Pengurus</span>
                            </a>

                            <a href="{{ route('lembaga.index') }}"
                                class="{{ request()->routeIs('lembaga.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🏛️</span>
                                <span>Lembaga</span>
                            </a>

                            <a href="{{ route('jabatan.index') }}"
                                class="{{ request()->routeIs('jabatan.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📌</span>
                                <span>Jabatan</span>
                            </a>

                            @php
                                $profilActive = request()->routeIs('profil-organisasi.*');
                            @endphp

                            <div x-data="{ open: {{ $profilActive ? 'true' : 'false' }} }" class="space-y-1">

                                <button type="button" @click="open = !open"
                                    class="w-full flex items-center justify-between rounded-2xl px-4 py-3 text-sm transition
                            {{ $profilActive ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">

                                    <span class="flex items-center gap-3">
                                        🏛️
                                        Profil Organisasi
                                    </span>

                                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="open" x-collapse class="ml-4 space-y-1">

                                    <a href="{{ route('profil-organisasi.sejarah') }}"
                                        class="block rounded-xl px-4 py-2 text-sm transition
                                {{ request()->routeIs('profil-organisasi.sejarah')
                                    ? 'bg-green-100 text-green-700 font-medium'
                                    : 'text-gray-600 hover:bg-gray-50' }}">
                                        📜 Sejarah
                                    </a>

                                    <a href="{{ route('profil-organisasi.visi-misi') }}"
                                        class="block rounded-xl px-4 py-2 text-sm transition
                                {{ request()->routeIs('profil-organisasi.visi-misi')
                                    ? 'bg-green-100 text-green-700 font-medium'
                                    : 'text-gray-600 hover:bg-gray-50' }}">
                                        🎯 Visi & Misi
                                    </a>

                                    <a href="{{ route('profil-organisasi.struktur') }}"
                                        class="block rounded-xl px-4 py-2 text-sm transition
                                {{ request()->routeIs('profil-organisasi.struktur')
                                    ? 'bg-green-100 text-green-700 font-medium'
                                    : 'text-gray-600 hover:bg-gray-50' }}">
                                        🧩 Struktur Organisasi
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KADERISASI --}}
                    <div class="mt-6">
                        <button @click="kaderisasi = !kaderisasi"
                            class="w-full flex items-center justify-between px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-gray-700">
                            <span>Kaderisasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform"
                                :class="kaderisasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="kaderisasi" x-transition class="mt-2 space-y-1">

                            <a href="{{ route('anggota.index') }}"
                                class="{{ request()->routeIs('anggota.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🧑‍🤝‍🧑</span>
                                <span>Anggota</span>
                            </a>

                            <a href="{{ route('riwayat-kaderisasi.index') }}"
                                class="{{ request()->routeIs('riwayat-kaderisasi.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🎓</span>
                                <span>Riwayat Kaderisasi</span>
                            </a>

                            <a href="{{ route('monitoring.anggota') }}"
                                class="{{ request()->routeIs('monitoring.anggota') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📊</span>
                                <span>Monitoring Anggota</span>
                            </a>

                            <a href="{{ route('monitoring.lembaga') }}"
                                class="{{ request()->routeIs('monitoring.lembaga') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🏢</span>
                                <span>Monitoring Lembaga</span>
                            </a>

                            <a href="{{ route('monitoring.par') }}"
                                class="{{ request()->routeIs('monitoring.par') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📍</span>
                                <span>Monitoring PAR</span>
                            </a>
                        </div>
                    </div>

                    {{-- ADMINISTRASI --}}
                    <div class="mt-6">
                        <button @click="administrasi = !administrasi"
                            class="w-full flex items-center justify-between px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-gray-700">
                            <span>Administrasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform"
                                :class="administrasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="administrasi" x-transition class="mt-2 space-y-1">

                            <a href="{{ route('kegiatan.index') }}"
                                class="{{ request()->routeIs('kegiatan.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📅</span>
                                <span>Kegiatan</span>
                            </a>

                            <a href="{{ route('surat.index') }}"
                                class="{{ request()->routeIs('surat.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📨</span>
                                <span>Surat</span>
                            </a>

                            <a href="{{ route('inventaris.index') }}"
                                class="{{ request()->routeIs('inventaris.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📦</span>
                                <span>Inventaris</span>
                            </a>

                            <a href="{{ route('peminjaman.index') }}"
                                class="{{ request()->routeIs('peminjaman.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">🔄</span>
                                <span>Peminjaman</span>
                            </a>

                            <a href="{{ route('notulen.index') }}"
                                class="{{ request()->routeIs('notulen.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📝</span>
                                <span>Notulen</span>
                            </a>

                            <a href="{{ route('buku-tamu.index') }}"
                                class="{{ request()->routeIs('buku-tamu.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📔</span>
                                <span>Buku Tamu</span>
                            </a>

                            <a href="{{ route('pengaduan.index') }}"
                                class="{{ request()->routeIs('pengaduan.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">⚠️</span>
                                <span>Pengaduan</span>
                            </a>
                        </div>
                    </div>

                    <!-- PUBLIKASI -->
                    <div class="mt-6">
                        <button @click="publikasi = !publikasi"
                            class="w-full flex items-center justify-between px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-gray-700">
                            <span>Publikasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform"
                                :class="publikasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="publikasi" x-transition class="mt-2 space-y-1">

                            <a href="{{ route('berita.index') }}"
                                class="{{ request()->routeIs('berita.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📰</span>
                                <span>Berita</span>
                            </a>

                            <a href="{{ route('dokumentasi.index') }}"
                                class="{{ request()->routeIs('dokumentasi.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                                <span class="sidebar-icon">📸</span>
                                <span>Dokumentasi</span>
                            </a>

                        </div>
                    </div>

                    {{-- ================= ADMIN PR ================= --}}
                @elseif($user->role === 'admin_pr')
                    <a href="{{ route('dashboard.pr') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 font-medium transition {{ request()->routeIs('dashboard.pr') ? 'bg-green-600 text-white shadow-lg shadow-green-600/20' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                        <span class="text-lg">🏠</span>
                        Dashboard
                    </a>

                    <div class="mt-6 space-y-1">

                        <a href="{{ route('par.index') }}"
                            class="{{ request()->routeIs('par.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                            <span class="sidebar-icon">🏘️</span>
                            <span>Data PAR</span>
                        </a>

                        <a href="{{ route('monitoring.anggota') }}"
                            class="{{ request()->routeIs('monitoring.anggota') ? 'sidebar-link-active' : 'sidebar-link' }}">
                            <span class="sidebar-icon">📊</span>
                            <span>Monitoring Anggota</span>
                        </a>

                        <a href="{{ route('laporan.anggota') }}"
                            class="{{ request()->routeIs('laporan.anggota') ? 'sidebar-link-active' : 'sidebar-link' }}">
                            <span class="sidebar-icon">📄</span>
                            <span>Laporan Anggota</span>
                        </a>

                    </div>

                    {{-- ================= ADMIN PAR ================= --}}
                @elseif($user->role === 'admin_par')
                    <a href="{{ route('dashboard.par') }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 font-medium transition {{ request()->routeIs('dashboard.par') ? 'bg-green-600 text-white shadow-lg shadow-green-600/20' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                        <span class="text-lg">🏠</span>
                        Dashboard
                    </a>

                    <div class="mt-6 space-y-1">

                        <a href="{{ route('anggota.index') }}"
                            class="{{ request()->routeIs('anggota.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                            <span class="sidebar-icon">👥</span>
                            <span>Data Anggota</span>
                        </a>

                        <a href="{{ route('laporan.anggota') }}"
                            class="{{ request()->routeIs('laporan.anggota') ? 'sidebar-link-active' : 'sidebar-link' }}">
                            <span class="sidebar-icon">📄</span>
                            <span>Laporan Anggota</span>
                        </a>

                    </div>
                @endif

            </nav>

            {{-- Footer Sidebar --}}
            <div class="p-4 border-t border-[#F4F7F4] bg-[#F4F7F4]" x-data="{ profileOpen: false }">

                <button @click="profileOpen = !profileOpen"
                    class="w-full flex items-center gap-3 rounded-2xl border border-gray-200 bg-white px-3 py-3 hover:shadow-sm transition">

                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-green-600 to-emerald-700 flex items-center justify-center text-sm font-bold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="flex-1 text-left min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator NU</p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 transition-transform"
                        :class="profileOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="profileOpen" x-transition class="mt-3 space-y-1">

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        👤 Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 rounded-xl px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                            🚪 Logout
                        </button>
                    </form>

                </div>
            </div>

        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">

            <!-- Topbar -->
            <!-- Topbar Floating -->
            <header class="sticky top-4 z-30 px-4 sm:px-6 lg:px-8">
                <div
                    class="h-16 bg-white/90 backdrop-blur-xl rounded-3xl border border-white/60 shadow-[0_8px_30px_rgba(15,23,42,0.08)] flex items-center justify-between px-4 sm:px-5 lg:px-6">

                    <div class="flex items-center gap-3 min-w-0">

                        <button @click="sidebarOpen = true"
                            class="lg:hidden w-9 h-9 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div class="min-w-0">
                            <h2 class="text-base sm:text-lg font-semibold text-gray-900 leading-tight truncate">
                                {{ $header ?? 'Dashboard' }}
                            </h2>

                            <p class="hidden md:block text-[11px] text-gray-500 leading-tight mt-0.5">
                                Sistem Informasi Nahdlatul Ulama
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3">

                        <div
                            class="flex items-center gap-3 rounded-2xl bg-gray-50 border border-gray-200 px-2.5 py-2 hover:bg-white transition">
                            <div
                                class="w-9 h-9 rounded-full bg-gradient-to-br from-green-600 to-emerald-700 flex items-center justify-center text-xs font-bold text-white shadow-sm flex-shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="hidden sm:block text-sm min-w-0">
                                <p class="font-semibold text-gray-900 text-xs leading-tight truncate">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-[10px] text-gray-500 leading-tight mt-0.5">
                                    Administrator NU
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 lg:p-6 max-h-screen overflow-y-auto scrollbar-vscode scrollbar-vscode-green">
                {{ $slot }}
            </main>
        </div>
    </div>

    <style>
        .sidebar-link {
            @apply flex items-center gap-3 rounded-xl px-4 py-2.5 text-gray-700 hover:bg-white hover:text-green-700 hover:shadow-sm transition-all duration-200;
        }
    </style>

</body>

</html>

<style>
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 1rem;
        border-radius: 0.875rem;
        color: #374151;
        transition: all 0.2s ease;
    }

    .sidebar-link:hover {
        background: white;
        color: #15803d;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
    }

    .sidebar-icon {
        width: 1.25rem;
        text-align: center;
        flex-shrink: 0;
    }

    .sidebar-scroll {
        scrollbar-width: thin;
        scrollbar-color: transparent transparent;
    }

    .sidebar-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: transparent;
        border-radius: 9999px;
    }

    .sidebar-scroll:hover::-webkit-scrollbar-thumb {
        background: rgba(107, 114, 128, 0.45);
    }

    .sidebar-scroll:hover {
        scrollbar-color: rgba(107, 114, 128, .45) transparent;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 1rem;
        border-radius: 0.875rem;
        color: #374151;
        transition: all 0.2s ease;
    }

    .sidebar-link:hover {
        background: white;
        color: #15803d;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
    }

    .sidebar-link-active {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 1rem;
        border-radius: 0.875rem;
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: white;
        font-weight: 600;
        box-shadow: 0 10px 20px rgba(22, 163, 74, 0.18);
    }
</style>
