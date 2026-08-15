<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Tambah Dokumentasi</h2>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf

            {{-- HEADER --}}
            <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Dokumentasi</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Lengkapi data dokumentasi kegiatan sebelum disimpan.
                    </p>
                </div>

                <a href="{{ route('dokumentasi.index') }}"
                    class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    Kembali
                </a>
            </div>

            {{-- JUDUL --}}
            <div class="space-y-2">

                <label class="text-sm font-medium text-gray-700">
                    Judul Dokumentasi
                </label>

                <x-ui.input name="judul_dokumentasi" :value="old('judul_dokumentasi')" placeholder="Masukkan judul dokumentasi" />

                @error('judul_dokumentasi')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- KATEGORI & TANGGAL --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- KATEGORI --}}
                <div x-data="{
                    openKategori: false,
                    labelKategori: '{{ old('kategori') ?: 'Pilih kategori kegiatan' }}'
                }" class="space-y-2">

                    <label class="text-sm font-medium text-gray-700">
                        Kategori Kegiatan
                    </label>

                    <input type="hidden" name="kategori" value="{{ old('kategori') }}">

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

                {{-- TANGGAL --}}
                <div class="space-y-2">

                    <label class="text-sm font-medium text-gray-700">
                        Tanggal Kegiatan
                    </label>

                    <x-ui.input type="date" name="tanggal_kegiatan" :value="old('tanggal_kegiatan')" />

                    @error('tanggal_kegiatan')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="space-y-2">

                <label class="text-sm font-medium text-gray-700">
                    Deskripsi Singkat
                </label>

                <textarea name="deskripsi_singkat" rows="4"
                    class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:bg-white transition resize-none"
                    placeholder="Tulis deskripsi singkat dokumentasi kegiatan...">{{ old('deskripsi_singkat') }}</textarea>
            </div>

            {{-- FOTO --}}
            <div class="space-y-4 rounded-2xl border border-gray-100 bg-gray-50/70 p-5">

                <div>
                    <h4 class="text-sm font-semibold text-gray-900">Upload Foto</h4>
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG dan PNG.
                    </p>
                </div>

                <input type="file" name="foto" accept="image/jpeg,image/png"
                    class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 file:mr-4 file:rounded-xl file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-green-700 hover:file:bg-green-100 transition">

                <p class="text-xs text-gray-500">
                    Pilih satu foto dokumentasi kegiatan untuk diunggah.
                </p>
            </div>

            {{-- STATUS --}}
            <div class="space-y-3 rounded-2xl border border-gray-100 bg-gray-50/70 p-5">

                <div>
                    <h4 class="text-sm font-semibold text-gray-900">Status Dokumentasi</h4>
                    <p class="text-xs text-gray-500 mt-1">
                        Tentukan apakah dokumentasi langsung dipublikasikan atau disimpan sebagai draft.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">

                    <label
                        class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-4 cursor-pointer transition hover:border-green-200 hover:bg-green-50/60">

                        <input type="radio" name="status" value="Publikasi"
                            class="mt-1 text-green-600 focus:ring-green-500"
                            {{ old('status', 'Draft') == 'Publikasi' ? 'checked' : '' }}>

                        <div>
                            <p class="text-sm font-medium text-gray-900">Publikasi</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Dokumentasi akan tampil pada halaman publikasi.
                            </p>
                        </div>
                    </label>

                    <label
                        class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-4 cursor-pointer transition hover:border-yellow-200 hover:bg-yellow-50/60">

                        <input type="radio" name="status" value="Draft"
                            class="mt-1 text-yellow-600 focus:ring-yellow-500"
                            {{ old('status', 'Draft') == 'Draft' ? 'checked' : '' }}>

                        <div>
                            <p class="text-sm font-medium text-gray-900">Draft</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Dokumentasi hanya disimpan dan belum dipublikasikan.
                            </p>
                        </div>
                    </label>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">

                <a href="{{ route('dokumentasi.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    Simpan Dokumentasi
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
