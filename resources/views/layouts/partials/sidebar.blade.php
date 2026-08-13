<aside class="w-64 bg-white border-r min-h-screen p-4 hidden md:block">
    <div class="mb-6">
        <p class="font-bold text-green-700">PAC Pragaan</p>
        <p class="text-xs text-gray-500">Fatayat NU</p>
    </div>

    @php $user = auth()->user(); @endphp

    <nav class="space-y-1 text-sm">
        @if ($user->role === 'admin_pac')
            <a href="{{ route('dashboard.pac') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard.pac') ? 'bg-green-100 text-green-700 font-medium' : '' }}">🏠
                Beranda</a>

            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-3">Data Organisasi</p>
            <a href="{{ route('pengurus.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('pengurus.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Data
                Pengurus</a>
            <a href="{{ route('pr.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('pr.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Data
                PR</a>
            <a href="{{ route('par.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('par.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Data
                PAR</a>
            <a href="{{ route('anggota.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('anggota.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Data
                Anggota</a>
            <a href="{{ route('lembaga.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('lembaga.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Data
                Lembaga</a>
            <a href="{{ route('jabatan.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('jabatan.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Data
                Jabatan</a>

            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-3">Kegiatan</p>
            <a href="{{ route('kegiatan.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('kegiatan.*') || request()->routeIs('absensi.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Kegiatan
                & Absensi</a>
            <a href="{{ route('riwayat-kaderisasi.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('riwayat-kaderisasi.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Riwayat
                Kaderisasi</a>
            <a href="{{ route('notulen.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('notulen.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Notulen
                Rapat</a>

            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-3">Administrasi</p>
            <a href="{{ route('surat.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('surat.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Administrasi
                Surat</a>
            <a href="{{ route('inventaris.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('inventaris.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Inventaris</a>
            <a href="{{ route('peminjaman.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('peminjaman.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Peminjaman</a>
            <a href="{{ route('buku-tamu.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('buku-tamu.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Buku
                Tamu</a>

            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-3">Publikasi</p>
            <a href="{{ route('profil-organisasi.sejarah') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('profil-organisasi.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Profil
                Organisasi</a>
            <a href="{{ route('profil-organisasi.struktur') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('profil-organisasi.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Profil
                Organisasi</a>
            <a href="{{ route('profil-organisasi.visi-mis') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('profil-organisasi.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Profil
                Organisasi</a>
            <a href="{{ route('berita.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('berita.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Berita
                Kegiatan</a>
            <a href="{{ route('dokumentasi.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dokumentasi.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Dokumentasi</a>

            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-3">Monitoring & Laporan</p>
            <a href="{{ route('monitoring.anggota') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('monitoring.anggota') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Monitoring
                Anggota</a>
            <a href="{{ route('monitoring.lembaga') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('monitoring.lembaga') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Monitoring
                Lembaga</a>
            <a href="{{ route('laporan.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('laporan.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Laporan</a>

            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-3">Layanan</p>
            <a href="{{ route('pengaduan.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('pengaduan.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Pengaduan
                Masyarakat</a>
        @elseif($user->role === 'admin_pr')
            <a href="{{ route('dashboard.pr') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard.pr') ? 'bg-green-100 text-green-700 font-medium' : '' }}">🏠
                Beranda</a>
            <a href="{{ route('par.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('par.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Kelola
                Data PAR</a>
            <a href="{{ route('monitoring.anggota') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('monitoring.anggota') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Monitoring
                Anggota</a>
            <a href="{{ route('laporan.anggota') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('laporan.anggota') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Laporan</a>
        @elseif($user->role === 'admin_par')
            <a href="{{ route('dashboard.par') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard.par') ? 'bg-green-100 text-green-700 font-medium' : '' }}">🏠
                Beranda</a>
            <a href="{{ route('anggota.index') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('anggota.*') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Kelola
                Data Anggota</a>
            <a href="{{ route('laporan.anggota') }}"
                class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('laporan.anggota') ? 'bg-green-100 text-green-700 font-medium' : '' }}">Laporan
                Anggota</a>
        @endif

        <hr class="my-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-3 py-2 rounded hover:bg-red-50 text-red-600">🚪
                Logout</button>
        </form>
    </nav>
</aside>
