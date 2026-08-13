<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('inventaris.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Kode Inventaris</label>
                    <input type="text" name="kode_inventaris" value="{{ old('kode_inventaris') }}"
                        class="w-full border rounded p-2">
                    @error('kode_inventaris')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium">Nama Barang</label>
                    <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                        class="w-full border rounded p-2">
                    @error('nama_barang')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
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
                    <label class="block font-medium">Merk/Tipe</label>
                    <input type="text" name="merk_tipe" value="{{ old('merk_tipe') }}"
                        class="w-full border rounded p-2">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Tahun Perolehan</label>
                    <input type="number" name="tahun_perolehan" value="{{ old('tahun_perolehan') }}"
                        class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block font-medium">Kondisi</label>
                    <select name="kondisi" class="w-full border rounded p-2">
                        <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak
                            Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat
                        </option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium">Lokasi Penyimpanan</label>
                    <select name="lokasi_penyimpanan" class="w-full border rounded p-2">
                        <option value="">-- Pilih --</option>
                        @foreach ($lokasiList as $l)
                            <option value="{{ $l }}"
                                {{ old('lokasi_penyimpanan') == $l ? 'selected' : '' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium">Jumlah Barang</label>
                    <input type="number" name="jumlah" value="{{ old('jumlah', 1) }}"
                        class="w-full border rounded p-2">
                    @error('jumlah')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium">Satuan</label>
                    <input type="text" name="satuan" value="{{ old('satuan') }}" class="w-full border rounded p-2"
                        placeholder="misal: Unit, Buah">
                </div>
            </div>

            <div>
                <label class="block font-medium">Deskripsi/Keterangan</label>
                <textarea name="deskripsi" class="w-full border rounded p-2">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Inventaris</button>
                <a href="{{ route('inventaris.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
