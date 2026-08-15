<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6">

        {{-- Filter --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="flex items-center gap-3 mb-5">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-100 text-green-700">
                    🔍
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Filter Laporan</h3>
                    <p class="text-sm text-gray-500">
                        Gunakan filter untuk mempersempit data inventaris yang ditampilkan.
                    </p>
                </div>
            </div>

            <form method="GET" class="space-y-4">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                    <x-ui.input name="nama_barang" label="Nama Barang" :value="request('nama_barang')"
                        placeholder="Cari nama barang..." />

                    <x-ui.input name="kategori" label="Kategori" :value="request('kategori')" placeholder="Cari kategori..." />

                    {{-- Dropdown Kondisi --}}
                    <div x-data="{
                        openKondisi: false,
                        labelKondisi: '{{ request('kondisi') ?: 'Semua Kondisi' }}'
                    }" class="relative space-y-2">

                        <label class="block text-sm font-medium text-gray-700">
                            Kondisi
                        </label>

                        <input type="hidden" name="kondisi" value="{{ request('kondisi') }}">

                        <x-ui.dropdown width="64" align="left">
                            <x-slot name="trigger">
                                <button type="button" @click="openKondisi = !openKondisi"
                                    class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                    <span x-text="labelKondisi"></span>

                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=kondisi]').value = ''; labelKondisi = 'Semua Kondisi'; openKondisi = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                    Semua Kondisi
                                </button>

                                @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
                                    <button type="button"
                                        @click="$el.closest('[x-data]').querySelector('input[name=kondisi]').value = '{{ $k }}'; labelKondisi = '{{ $k }}'; openKondisi = false"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        {{ $k }}
                                    </button>
                                @endforeach

                            </x-slot>
                        </x-ui.dropdown>
                    </div>

                    <x-ui.input name="satuan" label="Satuan" :value="request('satuan')"
                        placeholder="Contoh: Unit, Buah, Set..." />
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">

                    <p class="text-xs text-gray-500">
                        Filter akan diterapkan setelah tombol ditekan.
                    </p>

                    <div class="flex gap-2">

                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                            🔍 Terapkan Filter
                        </button>

                        <a href="{{ route('laporan.inventaris') }}"
                            class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                            ↺ Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Header Tabel --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Data Laporan Inventaris</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $data->total() }} barang inventaris
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">

                    <a href="{{ route('laporan.inventaris.pdf', request()->query()) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        📄 Export PDF
                    </a>

                    <button onclick="window.print()"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                        🖨️ Cetak
                    </button>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kode Barang</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Barang</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jumlah</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Satuan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kondisi</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Lokasi</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($data as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $data->firstItem() + $i }}
                                </td>

                                <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $item->kode_inventaris }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->nama_barang }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->kategori }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700 font-medium">
                                    {{ $item->jumlah }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $item->satuan ?? '-' }}
                                </td>

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->kondisi == 'Baik'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : ($item->kondisi == 'Rusak Ringan'
                                                ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                                                : 'bg-red-50 text-red-700 border-red-100') }}">

                                        {{ $item->kondisi }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->lokasi_penyimpanan ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 max-w-xs">
                                    {{ $item->deskripsi ?? '-' }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📦</div>
                                        <p class="font-medium">Tidak ada data inventaris.</p>
                                        <p class="text-sm text-gray-400">
                                            Data akan muncul setelah inventaris ditambahkan.
                                        </p>
                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <a href="{{ route('laporan.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-green-700 transition">

                ← Kembali ke Laporan
            </a>

            {{ $data->links() }}
        </div>
    </div>
</x-app-layout>
