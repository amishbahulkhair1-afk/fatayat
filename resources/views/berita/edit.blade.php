<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Berita</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi berita kegiatan organisasi.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm p-6 space-y-5">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Berita</h3>
                            <p class="text-sm text-gray-500">
                                Lengkapi data utama berita yang akan dipublikasikan.
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Judul Berita
                            </label>
                            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">

                            @error('judul')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Kategori
                                </label>

                                <select name="kategori"
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">

                                    <option value="">-- Pilih Kategori --</option>

                                    @foreach ($kategoriList as $k)
                                        <option value="{{ $k }}"
                                            {{ old('kategori', $berita->kategori) == $k ? 'selected' : '' }}>
                                            {{ $k }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('kategori')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Penulis
                                </label>

                                <input type="text" name="penulis" value="{{ old('penulis', $berita->penulis) }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">

                                @error('penulis')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Kegiatan
                                </label>

                                <input type="date" name="tanggal_kegiatan"
                                    value="{{ old('tanggal_kegiatan', $berita->tanggal_kegiatan) }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">

                                @error('tanggal_kegiatan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Lokasi
                                </label>

                                <input type="text" name="lokasi" value="{{ old('lokasi', $berita->lokasi) }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Isi Berita
                            </label>

                            <textarea name="isi_berita" rows="10"
                                class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">{{ old('isi_berita', $berita->isi_berita) }}</textarea>

                            @error('isi_berita')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="space-y-6">

                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">

                            <div>
                                <h3 class="text-base font-semibold text-gray-800">
                                    Gambar Utama
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Format JPG atau PNG.
                                </p>
                            </div>

                            @if ($berita->gambar_utama)
                                <img src="{{ Storage::url($berita->gambar_utama) }}" alt="Gambar utama"
                                    class="w-full h-44 object-cover rounded-xl border border-gray-200">
                            @endif

                            <input type="file" name="gambar_utama" accept="image/jpeg,image/png"
                                class="w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-green-700 hover:file:bg-green-100">

                            @error('gambar_utama')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">

                            <div>
                                <h3 class="text-base font-semibold text-gray-800">
                                    Status Publikasi
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Tentukan apakah berita langsung dipublikasikan atau disimpan sebagai draft.
                                </p>
                            </div>

                            <div class="space-y-3">

                                <label
                                    class="flex items-start gap-3 rounded-xl border border-gray-200 p-3 cursor-pointer hover:border-green-300">
                                    <input type="radio" name="status" value="Publik"
                                        {{ old('status', $berita->status) == 'Publik' ? 'checked' : '' }}
                                        class="mt-1 text-green-600 focus:ring-green-500">

                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Publik</p>
                                        <p class="text-xs text-gray-500">
                                            Berita akan tampil di halaman publik.
                                        </p>
                                    </div>
                                </label>

                                <label
                                    class="flex items-start gap-3 rounded-xl border border-gray-200 p-3 cursor-pointer hover:border-yellow-300">
                                    <input type="radio" name="status" value="Draft"
                                        {{ old('status', $berita->status) == 'Draft' ? 'checked' : '' }}
                                        class="mt-1 text-yellow-500 focus:ring-yellow-500">

                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Draft</p>
                                        <p class="text-xs text-gray-500">
                                            Simpan sementara dan edit kembali nanti.
                                        </p>
                                    </div>
                                </label>

                                <label
                                    class="flex items-start gap-3 rounded-xl border border-gray-200 p-3 cursor-pointer hover:border-gray-300">
                                    <input type="radio" name="status" value="Dijadwalkan"
                                        {{ old('status', $berita->status) == 'Dijadwalkan' ? 'checked' : '' }}
                                        class="mt-1 text-gray-600 focus:ring-gray-500">

                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Dijadwalkan</p>
                                        <p class="text-xs text-gray-500">
                                            Tandai sebagai konten yang akan dipublikasikan kemudian.
                                        </p>
                                    </div>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 flex flex-col sm:flex-row justify-end gap-3">

                    <a href="{{ route('berita.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700 transition shadow-sm">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>
    </div>
</x-app-layout>
