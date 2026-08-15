<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Notulen Rapat</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto space-y-6">

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
                    <h3 class="text-lg font-semibold text-gray-900">Manajemen Notulen Rapat</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola seluruh notulen rapat dan dokumentasi hasil kegiatan organisasi PAC Fatayat NU Pragaan.
                    </p>
                </div>

                <a href="{{ route('notulen.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    📝 + Tambah Notulen
                </a>
            </div>
        </div>

        {{-- Filter --}}
        <form id="cariForm" method="GET" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm space-y-4">

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian Notulen</label>

                    <x-ui.input name="cari" :value="request('cari')"
                        placeholder="Cari judul, kegiatan, atau nama notulis..." />
                </div>

                <div class="flex items-end gap-2">

                    <button type="submit"
                        class="inline-flex flex-1 items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        🔍 Cari
                    </button>

                    <a href="{{ route('notulen.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                        ↺ Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Table Card --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">

                <div>
                    <h3 class="font-semibold text-gray-900">Daftar Notulen</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $notulen->total() }} notulen
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Judul Notulen</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kegiatan Terkait</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Notulis</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($notulen as $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4">

                                    <div class="font-medium text-gray-900">
                                        {{ $item->judul }}
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-gray-700">

                                    {{ $item->kegiatan->nama_kegiatan ?? '-' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">

                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">

                                    {{ $item->notulis ?? '-' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('notulen.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('notulen.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus notulen ini?')">

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
                                <td colspan="5" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📋</div>
                                        <p class="font-medium">Belum ada notulen rapat.</p>
                                        <p class="text-sm text-gray-400">
                                            Tambahkan notulen pertama untuk mulai mendokumentasikan hasil rapat
                                            organisasi.
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
            {{ $notulen->links() }}
        </div>
    </div>
</x-app-layout>
