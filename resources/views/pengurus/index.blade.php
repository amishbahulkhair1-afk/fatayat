<x-app-layout>
    <x-slot name="header">
        Pengurus
    </x-slot>

    <div class="space-y-6">

        <!-- SUCCESS ALERT -->
        @if (session('success'))
            <div class="rounded-3xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm">
                <div class="flex items-start gap-3">
                    <div
                        class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                        ✅
                    </div>

                    <div>
                        <p class="font-semibold text-green-900">Berhasil</p>
                        <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- BANNER -->
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-start gap-3">

                    <div
                        class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                        👥
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-base font-semibold text-green-900 leading-tight">
                            Data Pengurus
                        </h1>

                        <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                            Kelola data <span class="font-semibold text-green-900">pengurus Fatayat NU</span>
                            secara terpusat untuk mendukung administrasi organisasi dan pengelolaan struktur
                            kepengurusan.
                        </p>
                    </div>
                </div>

                <a href="{{ route('pengurus.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20 flex-shrink-0">
                    <span class="mr-2 text-base">+</span>
                    Tambah Pengurus
                </a>
            </div>
        </div>

        <!-- RINGKASAN STATISTIK -->
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pengurus</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pengurus->total() }}</p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                        👥
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Laki-laki</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $pengurus->where('jenis_kelamin', 'Laki-laki')->count() }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 text-xl">
                        👨
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Perempuan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $pengurus->where('jenis_kelamin', 'Perempuan')->count() }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-pink-100 flex items-center justify-center text-pink-700 text-xl">
                        👩
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Halaman Saat Ini</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pengurus->currentPage() }}</p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-700 text-xl">
                        📄
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTER BAR -->
        <form action="{{ route('pengurus.index') }}" method="GET"
            class="rounded-3xl border border-gray-200 bg-white p-4 shadow-sm">

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">

                <!-- SEARCH -->
                <div class="lg:col-span-6">
                    <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-2">
                        Pencarian
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            🔍
                        </div>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama pengurus..."
                            class="w-full rounded-2xl border border-gray-300 bg-white py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                    </div>
                </div>

                <!-- JENIS KELAMIN -->
                <div class="lg:col-span-3">
                    <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-2">
                        Jenis Kelamin
                    </label>

                    <select name="jenis_kelamin"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                        <option value="">Semua</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                            👨 Laki-laki
                        </option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            👩 Perempuan
                        </option>
                    </select>
                </div>

                <!-- STATUS MENIKAH -->
                <div class="lg:col-span-3">
                    <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-2">
                        Status Menikah
                    </label>

                    <select name="status_menikah"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                        <option value="">Semua</option>
                        <option value="Belum Menikah"
                            {{ request('status_menikah') == 'Belum Menikah' ? 'selected' : '' }}>
                            Belum Menikah
                        </option>
                        <option value="Menikah" {{ request('status_menikah') == 'Menikah' ? 'selected' : '' }}>
                            Menikah
                        </option>
                        <option value="Cerai" {{ request('status_menikah') == 'Cerai' ? 'selected' : '' }}>
                            Cerai
                        </option>
                    </select>
                </div>
            </div>

            <div
                class="mt-4 flex flex-col gap-3 border-t border-gray-100 pt-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-xs text-gray-500">
                    Gunakan filter untuk mempersempit daftar pengurus yang ditampilkan.
                </p>

                <div class="flex items-center gap-2">

                    @if (request()->hasAny(['search', 'jenis_kelamin', 'status_menikah']))
                        <a href="{{ route('pengurus.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Reset
                        </a>
                    @endif

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-green-700 px-4 py-2 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- TABEL PENGURUS -->
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Pengurus</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Data pengurus yang telah terdaftar dalam sistem organisasi Fatayat NU.
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-[#F8FBF8]">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Nama Lengkap
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Jenis Kelamin
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Status Menikah
                            </th>

                            <th
                                class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($pengurus as $p)
                            <tr class="hover:bg-[#F8FBF8] transition-colors">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center text-sm font-bold text-green-700 flex-shrink-0">
                                            {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-900 truncate">{{ $p->nama_lengkap }}</p>
                                            <p class="text-xs text-gray-500 truncate">Pengurus Fatayat Nahdlatul Ulama
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($p->jenis_kelamin === 'Perempuan')
                                        <span
                                            class="inline-flex items-center rounded-full bg-pink-100 px-3 py-1 text-xs font-semibold text-pink-700">
                                            👩 Perempuan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            👨 Laki-laki
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                        {{ $p->status_menikah }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2">

                                        <a href="{{ route('pengurus.edit', $p->id) }}"
                                            class="inline-flex items-center justify-center rounded-xl border border-green-200 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-50 transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('pengurus.destroy', $p->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-red-200 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-14 text-center">

                                    <div class="flex flex-col items-center justify-center gap-4 text-gray-400">

                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                            👥
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-500">Belum ada data pengurus</p>
                                            <p class="text-sm text-gray-400 mt-1">
                                                Silakan tambahkan data pengurus pertama untuk mulai mengelola struktur
                                                organisasi.
                                            </p>
                                        </div>

                                        <a href="{{ route('pengurus.create') }}"
                                            class="inline-flex items-center rounded-2xl bg-green-700 px-4 py-2 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                                            + Tambah Pengurus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINATION -->
        @if ($pengurus->hasPages())
            <div class="flex justify-center">
                <div class="rounded-2xl bg-white border border-gray-200 shadow-sm px-4 py-3">
                    {{ $pengurus->links() }}
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
