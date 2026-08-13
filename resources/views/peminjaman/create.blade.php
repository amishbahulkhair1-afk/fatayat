<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Catat Peminjaman</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('peminjaman.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Barang</label>
                <select name="inventaris_id" class="w-full border rounded p-2">
                    <option value="">-- Pilih --</option>
                    @foreach ($inventaris as $item)
                        <option value="{{ $item->id }}" {{ old('inventaris_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_barang }} (Stok tersedia: {{ $item->jumlah }} {{ $item->satuan }})
                        </option>
                    @endforeach
                </select>
                @error('inventaris_id')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Peminjam</label>
                <select name="pengurus_id" class="w-full border rounded p-2">
                    <option value="">-- Pilih --</option>
                    @foreach ($pengurus as $p)
                        <option value="{{ $p->id }}" {{ old('pengurus_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('pengurus_id')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Jumlah Pinjam</label>
                <input type="number" name="jumlah_pinjam" value="{{ old('jumlah_pinjam', 1) }}"
                    class="w-full border rounded p-2">
                @error('jumlah_pinjam')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}"
                        class="w-full border rounded p-2">
                    @error('tanggal_pinjam')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium">Rencana Kembali</label>
                    <input type="date" name="tanggal_kembali_rencana" value="{{ old('tanggal_kembali_rencana') }}"
                        class="w-full border rounded p-2">
                    @error('tanggal_kembali_rencana')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block font-medium">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded p-2">{{ old('keterangan') }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('peminjaman.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
