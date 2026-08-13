<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Monitoring Anggota
        </h2>
    </x-slot>

    <div class="space-y-6 max-w-7xl mx-auto py-6">

        {{-- BANNER --}}
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-start gap-3">

                    <div
                        class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                        📊
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-base font-semibold text-green-900 leading-tight">
                            Monitoring Data Anggota PAC
                        </h1>

                        <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                            Pantau jumlah <span class="font-semibold text-green-900">PR, PAR, anggota, dan kader
                                aktif</span>
                            di seluruh wilayah PAC secara terpusat untuk mendukung pengelolaan organisasi dan evaluasi
                            kaderisasi.
                        </p>
                    </div>
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
                        Cari data PR berdasarkan nama untuk melihat ringkasan anggota dan kader.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-4">

                <div class="xl:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pencarian
                    </label>

                    <div class="flex gap-3">

                        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama PR..."
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
        <div class="grid grid-cols-2 xl:grid-cols-5 gap-4">

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jumlah PR</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['jumlah_pr'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                        🏢
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jumlah PAR</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['jumlah_par'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 text-xl">
                        🏘️
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Kader</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_kader'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-700 text-xl">
                        👥
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kader Aktif</p>
                        <p class="text-3xl font-bold text-green-700 mt-2">
                            {{ $ringkasan['kader_aktif'] }}
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
                        <p class="text-sm font-medium text-gray-500">Total Anggota</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_anggota'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-700 text-xl">
                        🪪
                    </div>
                </div>
            </div>

        </div>

        {{-- TABEL --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Monitoring Wilayah PR</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Ringkasan jumlah PAR, anggota, dan status kader di setiap PR wilayah PAC.
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
                                Nama PR
                            </th>

                            <th
                                class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                                PAR
                            </th>

                            <th
                                class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Anggota
                            </th>

                            <th
                                class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Total Kader
                            </th>

                            <th
                                class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Aktif
                            </th>

                            <th
                                class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Tidak Aktif
                            </th>

                            <th
                                class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($prList as $i => $pr)
                            <tr class="hover:bg-[#F8FBF8] transition-colors">

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $i + 1 }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center text-sm font-bold text-green-700 flex-shrink-0">
                                            {{ strtoupper(substr($pr->nama, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-900 truncate">
                                                {{ $pr->nama }}
                                            </p>

                                            <p class="text-xs text-gray-500 truncate">
                                                Pimpinan Ranting Fatayat NU
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ $pr->jumlah_par }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center font-medium text-gray-900">
                                    {{ $pr->total_anggota }}
                                </td>

                                <td class="px-6 py-4 text-center font-semibold text-gray-900">
                                    {{ $pr->total_kader }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        {{ $pr->kader_aktif }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        {{ $pr->kader_tidak_aktif }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('anggota.index') }}"
                                        class="inline-flex items-center justify-center rounded-xl border border-green-200 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-50 transition">
                                        👁 Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-14 text-center">

                                    <div class="flex flex-col items-center justify-center gap-4 text-gray-400">

                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                            📊
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-500">
                                                Belum ada data monitoring
                                            </p>

                                            <p class="text-sm text-gray-400 mt-1">
                                                Data PR dan anggota belum tersedia untuk ditampilkan pada monitoring
                                                PAC.
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

    </div>
</x-app-layout>
