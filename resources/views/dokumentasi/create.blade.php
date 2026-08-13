<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Dokumentasi</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <h3 class="font-semibold">Informasi Dokumentasi</h3>

            <div>
                <label class="block font-medium">Judul Dokumentasi</label>
                <input type="text" name="judul_dokumentasi" value="{{ old('judul_dokumentasi') }}"
                    class="w-full border rounded p-2">
                @error('judul_dokumentasi')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Kategori Kegiatan</label>
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
                    <label class="block font-medium">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                        class="w-full border rounded p-2">
                    @error('tanggal_kegiatan')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block font-medium">Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" class="w-full border rounded p-2">{{ old('deskripsi_singkat') }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Upload Foto</label>
                <input type="file" name="foto" accept="image/jpeg,image/png" class="w-full border rounded p-2">
            </div>

            <div class="border rounded p-4">
                <label class="block mb-2 font-semibold">Status Dokumentasi</label>
                <label class="flex items-center gap-2 mb-1">
                    <input type="radio" name="status" value="Publikasi"
                        {{ old('status', 'Draft') == 'Publikasi' ? 'checked' : '' }}> Publikasikan
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="status" value="Draft"
                        {{ old('status', 'Draft') == 'Draft' ? 'checked' : '' }}> Draft
                </label>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('dokumentasi.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Dokumentasi</button>
            </div>
        </form>
    </div>
</x-app-layout>
