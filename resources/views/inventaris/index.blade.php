<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Administrasi Inventaris</h2>
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
                    <h3 class="text-lg font-semibold text-gray-900">Administrasi Inventaris</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola seluruh data inventaris dan aset organisasi PAC Fatayat NU Pragaan.
                    </p>
                </div>

                <a href="{{ route('inventaris.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                    📦 + Tambah Inventaris
                </a>
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Total Inventaris</p>
                <p class="mt-3 text-3xl font-bold text-gray-900">{{ $ringkasan['total'] }}</p>
            </div>

            <div class="rounded-3xl border border-green-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Kondisi Baik</p>
                <p class="mt-3 text-3xl font-bold text-green-600">{{ $ringkasan['baik'] }}</p>
            </div>

            <div class="rounded-3xl border border-yellow-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Rusak Ringan</p>
                <p class="mt-3 text-3xl font-bold text-yellow-600">{{ $ringkasan['rusak_ringan'] }}</p>
            </div>

            <div class="rounded-3xl border border-red-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Rusak Berat</p>
                <p class="mt-3 text-3xl font-bold text-red-600">{{ $ringkasan['rusak_berat'] }}</p>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm space-y-4">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                {{-- Kategori --}}
                <div x-data="{
                    openKategori: false,
                    labelKategori: '{{ request('kategori') ?: 'Semua Kategori' }}'
                }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>

                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openKategori = !openKategori"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelKategori"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=kategori]').value = ''; labelKategori = 'Semua Kategori'; openKategori = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Kategori
                            </button>

                            @foreach ($kategoriList as $k)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=kategori]').value = '{{ $k }}'; labelKategori = '{{ $k }}'; openKategori = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $k }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Kondisi --}}
                <div x-data="{
                    openKondisi: false,
                    labelKondisi: '{{ request('kondisi') ?: 'Semua Kondisi' }}'
                }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>

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

                            @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $kondisi)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=kondisi]').value = '{{ $kondisi }}'; labelKondisi = '{{ $kondisi }}'; openKondisi = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $kondisi }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Lokasi --}}
                <div x-data="{
                    openLokasi: false,
                    labelLokasi: '{{ request('lokasi') ?: 'Semua Lokasi' }}'
                }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>

                    <input type="hidden" name="lokasi" value="{{ request('lokasi') }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openLokasi = !openLokasi"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelLokasi"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=lokasi]').value = ''; labelLokasi = 'Semua Lokasi'; openLokasi = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Lokasi
                            </button>

                            @foreach ($lokasiList as $l)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=lokasi]').value = '{{ $l }}'; labelLokasi = '{{ $l }}'; openLokasi = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $l }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Pencarian --}}
                <div class="md:col-span-2 xl:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>

                    <x-ui.input name="cari" :value="request('cari')"
                        placeholder="Cari nama barang, kode inventaris, atau merk/tipe..." />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
                <p class="text-xs text-gray-500">
                    Gunakan filter untuk mempersempit data inventaris yang ditampilkan.
                </p>

                <div class="flex gap-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        🔍 Cari
                    </button>

                    <a href="{{ route('inventaris.index') }}"
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
                    <h3 class="font-semibold text-gray-900">Daftar Inventaris</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $inventaris->total() }} item inventaris
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kode</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Barang</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Merk / Tipe</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tahun</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jumlah</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Satuan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Lokasi</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kondisi</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($inventaris as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $inventaris->firstItem() + $i }}
                                </td>

                                <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $item->kode_inventaris }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->nama_barang }}
                                </td>

                                <td class="px-4 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 border border-green-100">
                                        {{ $item->kategori }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->merk_tipe ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $item->tahun_perolehan ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 font-semibold">
                                    {{ $item->jumlah }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $item->satuan ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->lokasi_penyimpanan ?? '-' }}
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

                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('inventaris.show', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-200 transition">
                                            👁️ Lihat
                                        </a>

                                        <a href="{{ route('inventaris.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">
                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Yakin hapus data inventaris ini?')">

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
                                <td colspan="11" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📦</div>
                                        <p class="font-medium">Belum ada data inventaris.</p>
                                        <p class="text-sm text-gray-400">Data inventaris akan muncul setelah
                                            ditambahkan.</p>
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
            {{ $inventaris->links() }}
        </div>
    </div>
</x-app-layout>
