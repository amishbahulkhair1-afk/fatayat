<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <p class="text-gray-500 mb-4">Kelola dan cetak laporan data organisasi PAC Pragaan</p>

        <h3 class="font-semibold mb-2">Ringkasan Data</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold">{{ $ringkasan['total_anggota'] }}</p>
                <p class="text-xs text-gray-500">Total Anggota</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold">{{ $ringkasan['total_notulen'] }}</p>
                <p class="text-xs text-gray-500">Total Notulen</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold">{{ $ringkasan['total_buku_tamu'] }}</p>
                <p class="text-xs text-gray-500">Total Buku Tamu</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold">{{ $ringkasan['total_inventaris'] }}</p>
                <p class="text-xs text-gray-500">Total Inventaris</p>
            </div>
        </div>

        <h3 class="font-semibold mb-2">Daftar Laporan</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white border rounded p-4 text-center">
                <p class="font-medium mb-3">Laporan Anggota</p>
                <a href="{{ route('laporan.anggota') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded inline-block">Buat Laporan</a>
            </div>
            <div class="bg-white border rounded p-4 text-center">
                <p class="font-medium mb-3">Laporan Notulen</p>
                <a href="{{ route('laporan.notulen') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded inline-block">Buat Laporan</a>
            </div>
            <div class="bg-white border rounded p-4 text-center">
                <p class="font-medium mb-3">Laporan Buku Tamu</p>
                <a href="{{ route('laporan.buku-tamu') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded inline-block">Buat Laporan</a>
            </div>
            <div class="bg-white border rounded p-4 text-center">
                <p class="font-medium mb-3">Laporan Inventaris</p>
                <a href="{{ route('laporan.inventaris') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded inline-block">Buat Laporan</a>
            </div>
        </div>
    </div>
</x-app-layout>
