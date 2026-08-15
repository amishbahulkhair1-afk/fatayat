<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Admin PAR
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto space-y-6">

        {{-- Sambutan --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900">
                Selamat datang 👋
            </h3>
            <p class="text-gray-500 mt-1">
                Halo, <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>.
                Berikut ringkasan data anggota PAR Anda.
            </p>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- Total Anggota --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Anggota</p>
                        <p class="text-4xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_anggota'] }}
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            Seluruh anggota yang terdaftar
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                        👥
                    </div>
                </div>
            </div>

            {{-- Anggota Aktif --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Anggota Aktif</p>
                        <p class="text-4xl font-bold text-green-600 mt-2">
                            {{ $ringkasan['anggota_aktif'] }}
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            Anggota dengan status aktif
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">
                        ✅
                    </div>
                </div>
            </div>

            {{-- Tidak Aktif --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tidak Aktif</p>
                        <p class="text-4xl font-bold text-red-600 mt-2">
                            {{ $ringkasan['anggota_tidak_aktif'] }}
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            Anggota yang belum aktif
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-2xl">
                        ⚠️
                    </div>
                </div>
            </div>

        </div>

        {{-- Aksi Cepat --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="font-semibold text-gray-900">Aksi Cepat</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data anggota PAR dan lihat laporan dengan cepat.
                    </p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('anggota.index') }}"
                        class="inline-flex items-center gap-2 rounded-2xl bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 transition">
                        👥 Kelola Anggota
                    </a>

                    <a href="{{ route('laporan.anggota') }}"
                        class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        📄 Lihat Laporan
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
