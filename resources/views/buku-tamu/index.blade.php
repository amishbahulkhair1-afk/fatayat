<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Buku Tamu</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6">

        {{-- Alert --}}
        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header Card --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Buku Tamu Organisasi</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data kunjungan tamu, instansi, dan keperluan kunjungan ke PAC Fatayat NU Pragaan.
                    </p>
                </div>

                <a href="{{ route('buku-tamu.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    👥 + Tambah Tamu
                </a>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm space-y-4">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                {{-- Nama Tamu --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tamu</label>

                    <x-ui.input name="nama_tamu" :value="request('nama_tamu')" placeholder="Cari nama tamu..." />
                </div>

                {{-- Asal Instansi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Asal Instansi</label>

                    <x-ui.input name="asal_instansi" :value="request('asal_instansi')" placeholder="Cari instansi..." />
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kunjungan</label>

                    <x-ui.date-input name="tanggal_kunjungan" :value="request('tanggal_kunjungan')" />
                </div>

                {{-- Pencarian Tujuan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Kunjungan</label>

                    <x-ui.input name="tujuan_kunjungan" :value="request('tujuan_kunjungan')" placeholder="Cari tujuan..." />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">

                <p class="text-xs text-gray-500">
                    Gunakan filter untuk menemukan data kunjungan dengan cepat.
                </p>

                <div class="flex gap-2">

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        🔍 Cari
                    </button>

                    <a href="{{ route('buku-tamu.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                        ↺ Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">

                <div>
                    <h3 class="font-semibold text-gray-900">Daftar Buku Tamu</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $bukuTamu->total() }} kunjungan
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Tamu</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Asal Instansi</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tujuan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jam</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($bukuTamu as $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-700 font-semibold">

                                            {{ strtoupper(substr($item->nama_tamu, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-900">{{ $item->nama_tamu }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->asal_instansi ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 max-w-xs truncate">
                                    {{ $item->tujuan_kunjungan }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ $item->jam_kunjungan ?? '-' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('buku-tamu.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('buku-tamu.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus data tamu ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100 transition">

                                                🗑 Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">

                                        <div class="text-4xl">📖</div>

                                        <p class="font-medium">Belum ada data buku tamu.</p>

                                        <p class="text-sm text-gray-400">
                                            Data kunjungan tamu akan muncul setelah ditambahkan.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="flex justify-end">
            {{ $bukuTamu->links() }}
        </div>
    </div>
</x-app-layout>
