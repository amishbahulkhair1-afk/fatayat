<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('inventaris.update', $inventaris->id) }}" method="POST"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf
            @method('PUT')

            <div class="border-b border-gray-100 pb-4">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Inventaris</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui data inventaris dan aset organisasi sesuai kondisi terbaru.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Kode Inventaris --}}
                <x-ui.input name="kode_inventaris" label="Kode Inventaris" :value="old('kode_inventaris', $inventaris->kode_inventaris)" placeholder="INV-001"
                    required />

                {{-- Nama Barang --}}
                <x-ui.input name="nama_barang" label="Nama Barang" :value="old('nama_barang', $inventaris->nama_barang)" placeholder="Contoh: Laptop ASUS"
                    required />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Kategori --}}
                <div x-data="{
                    openKategori: false,
                    labelKategori: '{{ old('kategori', $inventaris->kategori) ?: 'Pilih Kategori' }}'
                }" class="relative space-y-2">

                    <label class="block text-sm font-medium text-gray-700">Kategori</label>

                    <input type="hidden" name="kategori" value="{{ old('kategori', $inventaris->kategori) }}">

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

                    @error('kategori')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Merk/Tipe --}}
                <x-ui.input name="merk_tipe" label="Merk / Tipe" :value="old('merk_tipe', $inventaris->merk_tipe)"
                    placeholder="Contoh: ASUS VivoBook 14" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Tahun Perolehan --}}
                <x-ui.input name="tahun_perolehan" label="Tahun Perolehan" inputType="number" :value="old('tahun_perolehan', $inventaris->tahun_perolehan)"
                    placeholder="2026" />

                {{-- Kondisi --}}
                <div x-data="{
                    openKondisi: false,
                    labelKondisi: '{{ old('kondisi', $inventaris->kondisi) ?: 'Pilih Kondisi' }}'
                }" class="relative space-y-2">

                    <label class="block text-sm font-medium text-gray-700">Kondisi</label>

                    <input type="hidden" name="kondisi" value="{{ old('kondisi', $inventaris->kondisi) }}">

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
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- Lokasi Penyimpanan --}}
                <div x-data="{
                    openLokasi: false,
                    labelLokasi: '{{ old('lokasi_penyimpanan', $inventaris->lokasi_penyimpanan) ?: 'Pilih Lokasi' }}'
                }" class="relative space-y-2">

                    <label class="block text-sm font-medium text-gray-700">Lokasi Penyimpanan</label>

                    <input type="hidden" name="lokasi_penyimpanan"
                        value="{{ old('lokasi_penyimpanan', $inventaris->lokasi_penyimpanan) }}">

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
                            @foreach ($lokasiList as $l)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=lokasi_penyimpanan]').value = '{{ $l }}'; labelLokasi = '{{ $l }}'; openLokasi = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $l }}
                                </button>
                            @endforeach
                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Jumlah --}}
                <x-ui.input name="jumlah" label="Jumlah Barang" inputType="number" :value="old('jumlah', $inventaris->jumlah)" required />

                {{-- Satuan --}}
                <x-ui.input name="satuan" label="Satuan" :value="old('satuan', $inventaris->satuan)" placeholder="Unit / Buah / Set" />
            </div>

            {{-- Deskripsi --}}
            <x-ui.textarea name="deskripsi" label="Deskripsi / Keterangan"
                placeholder="Tambahkan keterangan tambahan jika diperlukan...">{{ old('deskripsi', $inventaris->deskripsi) }}</x-ui.textarea>

            {{-- Tombol --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end pt-4 border-t border-gray-100">

                <a href="{{ route('inventaris.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    ← Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">
                    💾 Update Inventaris
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
