<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard Admin PR</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <p class="text-gray-500 mb-4">Selamat datang, {{ auth()->user()->name }}</p>

        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white border rounded p-4 text-center">
                <p class="text-3xl font-bold">{{ $ringkasan['total_par'] }}</p>
                <p class="text-sm text-gray-500">Jumlah PAR di Wilayah Anda</p>
            </div>
            <div class="bg-white border rounded p-4 text-center">
                <p class="text-3xl font-bold">{{ $ringkasan['total_anggota'] }}</p>
                <p class="text-sm text-gray-500">Total Anggota di Wilayah Anda</p>
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <a href="{{ route('par.index') }}" class="bg-green-600 text-white px-4 py-2 rounded">Kelola Data PAR</a>
            <a href="{{ route('monitoring.anggota') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Monitoring
                Anggota</a>
        </div>
    </div>
</x-app-layout>
