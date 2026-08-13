<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Tamu</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('buku-tamu.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Nama Tamu</label>
                <input type="text" name="nama_tamu" value="{{ old('nama_tamu') }}" class="w-full border rounded p-2">
                @error('nama_tamu')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Asal Instansi</label>
                <input type="text" name="asal_instansi" value="{{ old('asal_instansi') }}"
                    class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Tujuan Kunjungan</label>
                <input type="text" name="tujuan_kunjungan" value="{{ old('tujuan_kunjungan') }}"
                    class="w-full border rounded p-2">
                @error('tujuan_kunjungan')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}"
                        class="w-full border rounded p-2">
                    @error('tanggal_kunjungan')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium">Jam Kunjungan</label>
                    <input type="time" name="jam_kunjungan" value="{{ old('jam_kunjungan') }}"
                        class="w-full border rounded p-2">
                </div>
            </div>

            <div>
                <label class="block font-medium">Kontak</label>
                <input type="text" name="kontak" value="{{ old('kontak') }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded p-2">{{ old('keterangan') }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('buku-tamu.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
