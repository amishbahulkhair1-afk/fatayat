<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard Admin PAR</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <p class="text-gray-500 mb-4">Selamat datang, {{ auth()->user()->name }}</p>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white border rounded p-4 text-center">
                <p class="text-3xl font-bold">{{ $ringkasan['total_anggota'] }}</p>
                <p class="text-sm text-gray-500">Total Anggota</p>
            </div>
            <div class="bg-white border rounded p-4 text-center">
                <p class="text-3xl font-bold text-green-600">{{ $ringkasan['anggota_aktif'] }}</p>
                <p class="text-sm text-gray-500">Anggota Aktif</p>
            </div>
            <div class="bg-white border rounded p-4 text-center">
                <p class="text-3xl font-bold text-red-600">{{ $ringkasan['anggota_tidak_aktif'] }}</p>
                <p class="text-sm text-gray-500">Anggota Tidak Aktif</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('anggota.index') }}" class="bg-green-600 text-white px-4 py-2 rounded">Kelola Data
                Anggota</a>
        </div>
    </div>
</x-app-layout>
