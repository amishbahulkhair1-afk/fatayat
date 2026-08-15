<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Tambah Berita</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @csrf

            {{-- FORM UTAMA --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Informasi berita --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                            <span class="text-green-700 text-lg">📰</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Informasi Berita</h3>
                            <p class="text-sm text-gray-500">Isi informasi utama berita yang akan ditampilkan.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                            placeholder="Masukkan judul berita"
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:bg-white transition">
                        @error('judul')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="kategori"
                                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:bg-white transition">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoriList as $k)
                                    <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>
                                        {{ $k }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                            <input type="text" name="penulis" value="{{ old('penulis') }}" placeholder="Nama penulis"
                                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:bg-white transition">
                            @error('penulis')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:bg-white transition">
                            @error('tanggal_kegiatan')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                placeholder="Lokasi kegiatan"
                                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:bg-white transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Berita</label>
                        <textarea name="isi_berita" rows="10" placeholder="Tulis isi berita di sini..."
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:bg-white transition">{{ old('isi_berita') }}</textarea>
                        @error('isi_berita')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Gambar --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-700 text-lg">🖼️</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Gambar Utama</h3>
                            <p class="text-sm text-gray-500">Gunakan gambar dengan rasio landscape agar tampil optimal.
                            </p>
                        </div>
                    </div>

                    <input type="file" name="gambar_utama" accept="image/jpeg,image/png,image/jpg"
                        class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-green-700 hover:file:bg-green-100 transition">
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-6">

                {{-- Status publikasi --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4 sticky top-6">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                            <span class="text-amber-700 text-lg">⚙️</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Publikasi</h3>
                            <p class="text-sm text-gray-500">Atur status berita sebelum disimpan.</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="flex items-start gap-3 rounded-xl border border-gray-200 p-3 cursor-pointer hover:border-green-300 hover:bg-green-50/50 transition">
                            <input type="radio" name="status" value="Publik"
                                {{ old('status', 'Draft') == 'Publik' ? 'checked' : '' }}
                                class="mt-1 text-green-600 focus:ring-green-500">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Publik</p>
                                <p class="text-xs text-gray-500">Berita langsung tampil di halaman publik.</p>
                            </div>
                        </label>

                        <label
                            class="flex items-start gap-3 rounded-xl border border-gray-200 p-3 cursor-pointer hover:border-yellow-300 hover:bg-yellow-50/50 transition">
                            <input type="radio" name="status" value="Draft"
                                {{ old('status', 'Draft') == 'Draft' ? 'checked' : '' }}
                                class="mt-1 text-yellow-600 focus:ring-yellow-500">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Draft</p>
                                <p class="text-xs text-gray-500">Simpan sebagai konsep dan publikasikan nanti.</p>
                            </div>
                        </label>

                        <label
                            class="flex items-start gap-3 rounded-xl border border-gray-200 p-3 cursor-pointer hover:border-gray-300 hover:bg-gray-50 transition">
                            <input type="radio" name="status" value="Dijadwalkan"
                                {{ old('status') == 'Dijadwalkan' ? 'checked' : '' }}
                                class="mt-1 text-gray-600 focus:ring-gray-500">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Dijadwalkan</p>
                                <p class="text-xs text-gray-500">Siapkan berita untuk dipublikasikan pada waktu
                                    tertentu.</p>
                            </div>
                        </label>
                    </div>

                    <div class="border-t border-gray-100 pt-4 flex flex-col gap-3">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center rounded-xl bg-green-600 px-4 py-3 text-sm font-medium text-white hover:bg-green-700 shadow-sm transition">
                            Simpan Berita
                        </button>

                        <a href="{{ route('berita.index') }}"
                            class="w-full inline-flex items-center justify-center rounded-xl border border-gray-300 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
