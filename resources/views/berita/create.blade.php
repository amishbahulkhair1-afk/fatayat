<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Berita</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow grid grid-cols-3 gap-6">
            @csrf

            <div class="col-span-2 space-y-4">
                <h3 class="font-semibold">Informasi Berita</h3>

                <div>
                    <label class="block font-medium">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded p-2">
                    @error('judul')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Kategori</label>
                        <select name="kategori" class="w-full border rounded p-2">
                            <option value="">-- Pilih --</option>
                            @foreach ($kategoriList as $k)
                                <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>
                                    {{ $k }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium">Penulis</label>
                        <input type="text" name="penulis" value="{{ old('penulis') }}"
                            class="w-full border rounded p-2">
                        @error('penulis')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                            class="w-full border rounded p-2">
                        @error('tanggal_kegiatan')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                            class="w-full border rounded p-2">
                    </div>
                </div>

                <div>
                    <label class="block font-medium">Isi Berita</label>
                    <textarea name="isi_berita" rows="8" class="w-full border rounded p-2">{{ old('isi_berita') }}</textarea>
                    @error('isi_berita')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">Gambar Utama</label>
                    <input type="file" name="gambar_utama" accept="image/jpeg,image/png"
                        class="w-full border rounded p-2">
                </div>
            </div>

            <div class="space-y-4">
                <div class="border rounded p-4">
                    <h3 class="font-semibold mb-2">Pengaturan Publikasi</h3>
                    <label class="block mb-2"><strong>Status</strong></label>
                    <label class="flex items-center gap-2 mb-1">
                        <input type="radio" name="status" value="Publik"
                            {{ old('status', 'Draft') == 'Publik' ? 'checked' : '' }}> Publik
                    </label>
                    <label class="flex items-center gap-2 mb-1">
                        <input type="radio" name="status" value="Draft"
                            {{ old('status', 'Draft') == 'Draft' ? 'checked' : '' }}> Draft
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" value="Dijadwalkan"
                            {{ old('status') == 'Dijadwalkan' ? 'checked' : '' }}> Dijadwalkan
                    </label>
                </div>
            </div>

            <div class="col-span-3 flex gap-2 justify-end pt-4 border-t">
                <a href="{{ route('berita.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
