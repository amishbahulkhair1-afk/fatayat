<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Monitoring Data PAR
        </h2>
    </x-slot>

    <div class="space-y-6 max-w-7xl mx-auto py-6">

        {{-- BANNER --}}
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex items-start gap-3">

                <div
                    class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                    📍
                </div>

                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Monitoring Data PAR
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Pantau perkembangan <span class="font-semibold text-green-900">Pimpinan Anak Ranting (PAR)</span>
                        di wilayah PAC Pragaan untuk mendukung pemetaan kader, pengelolaan wilayah, dan evaluasi
                        aktivitas organisasi secara menyeluruh.
                    </p>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <form method="GET" class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 space-y-4">

            <div class="flex items-center gap-2 mb-1">
                <div class="h-8 w-8 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                    🔎
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Filter Monitoring</h3>
                    <p class="text-xs text-gray-500 mt-0.5">
                        Cari PAR berdasarkan nama dan status untuk memudahkan pemantauan wilayah dan jumlah anggota.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status PAR</label>

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span class="flex items-center gap-2">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    @if (request('status') === 'Aktif')
                                        Aktif
                                    @elseif (request('status') === 'Tidak Aktif')
                                        Tidak Aktif
                                    @else
                                        Semua Status
                                    @endif
                                </span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <a href="{{ request()->url() }}?{{ http_build_query(array_merge(request()->except('status', 'page'), ['status' => 'Aktif'])) }}"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                Aktif
                            </a>

                            <a href="{{ request()->url() }}?{{ http_build_query(array_merge(request()->except('status', 'page'), ['status' => 'Tidak Aktif'])) }}"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition">
                                <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                                Tidak Aktif
                            </a>

                            <a href="{{ request()->url() }}?{{ http_build_query(request()->except('status', 'page')) }}"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Status
                            </a>
                        </x-slot>
                    </x-ui.dropdown>
                </div>

                <div class="xl:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>

                    <div class="flex gap-3">

                        <input type="text" name="cari" value="{{ request('cari') }}"
                            placeholder="Cari nama PAR, PR, atau ketua..."
                            class="flex-1 rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                            🔍 Cari
                        </button>
                    </div>
                </div>

                <div class="flex items-end">
                    <a href="{{ url()->current() }}"
                        class="w-full inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                        ↺ Reset Filter
                    </a>
                </div>

            </div>
        </form>

        {{-- RINGKASAN --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total PAR</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                        📍
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">PAR Aktif</p>
                        <p class="text-3xl font-bold text-green-700 mt-2">
                            {{ $ringkasan['aktif'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                        ✅
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">PAR Tidak Aktif</p>
                        <p class="text-3xl font-bold text-red-700 mt-2">
                            {{ $ringkasan['tidak_aktif'] }}
                        </p>
                    </div>

                    <div class="h-12 w-12 rounded-2xl bg-red-100 flex items-center justify-center text-red-700 text-xl">
                        ⏳
                    </div>
                </div>
            </div>

        </div>

        {{-- TABEL --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Monitoring PAR</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Ringkasan data PAR, ketua wilayah, dan jumlah anggota di setiap ranting.
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-[#F8FBF8]">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                No
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Nama PAR
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                PR Asal
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Ketua
                            </th>

                            <th
                                class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Jumlah Anggota
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Status
                            </th>

                            <th
                                class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($par as $i => $item)
                            <tr class="hover:bg-[#F8FBF8] transition-colors">

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $par->firstItem() + $i }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center text-sm font-bold text-green-700 flex-shrink-0">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-900 truncate">
                                                {{ $item->nama }}
                                            </p>

                                            <p class="text-xs text-gray-500 truncate">
                                                Pimpinan Anak Ranting Fatayat NU
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->pr->nama ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->ketua->nama_lengkap ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ $item->jumlah_anggota }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if (($item->status ?? '') === 'Aktif')
                                        <span
                                            class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Aktif
                                        </span>
                                    @elseif(($item->status ?? '') === 'Tidak Aktif')
                                        <span
                                            class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Tidak Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                            {{ $item->status ?? 'Belum Diatur' }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('par.edit', $item->id) }}"
                                        class="inline-flex items-center justify-center rounded-xl border border-green-200 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-50 transition">
                                        👁 Lihat/Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-14 text-center">

                                    <div class="flex flex-col items-center justify-center gap-4 text-gray-400">

                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                            📍
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-500">
                                                Belum ada data PAR
                                            </p>

                                            <p class="text-sm text-gray-400 mt-1">
                                                Data PAR belum tersedia untuk ditampilkan pada halaman monitoring.
                                            </p>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if ($par->hasPages())
            <div class="flex justify-center">
                <div class="rounded-2xl bg-white border border-gray-200 shadow-sm px-4 py-3">
                    {{ $par->links() }}
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
