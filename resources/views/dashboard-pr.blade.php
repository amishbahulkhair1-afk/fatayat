<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Dashboard Admin PR</h2>
            </div>

            <div
                class="inline-flex items-center gap-2 rounded-xl bg-green-50 px-4 py-2 text-sm font-medium text-green-700 border border-green-100">
                <span>📍</span>
                Area Pengelolaan PR
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto space-y-6">

        {{-- Statistik Utama --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jumlah PAR</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_par'] }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-2">
                            Total PAR di wilayah Anda
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-xl">
                        🏠
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Anggota</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_anggota'] }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-2">
                            Seluruh anggota di wilayah PR Anda
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">
                        👥
                    </div>
                </div>
            </div>

        </div>

        {{-- Menu Cepat --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Menu Cepat</h3>
                    <p class="text-sm text-gray-500">
                        Akses fitur utama yang sering digunakan
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <a href="{{ route('par.index') }}"
                    class="group flex items-center gap-4 rounded-2xl border border-gray-200 p-4 hover:border-green-300 hover:bg-green-50 transition">

                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-xl">
                        🏠
                    </div>

                    <div class="flex-1">
                        <p class="font-semibold text-gray-900 group-hover:text-green-700 transition">
                            Kelola Data PAR
                        </p>
                        <p class="text-sm text-gray-500">
                            Tambah, edit, dan kelola data PAR
                        </p>
                    </div>

                </a>

                <a href="{{ route('monitoring.anggota') }}"
                    class="group flex items-center gap-4 rounded-2xl border border-gray-200 p-4 hover:border-blue-300 hover:bg-blue-50 transition">

                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">
                        📊
                    </div>

                    <div class="flex-1">
                        <p class="font-semibold text-gray-900 group-hover:text-blue-700 transition">
                            Monitoring Anggota
                        </p>
                        <p class="text-sm text-gray-500">
                            Pantau perkembangan anggota dan aktivitas
                        </p>
                    </div>

                </a>

            </div>
        </div>

    </div>
</x-app-layout>
