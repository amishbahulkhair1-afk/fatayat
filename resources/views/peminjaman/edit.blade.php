<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Peminjaman</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST"
            class="bg-white p-6 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Barang</label>
                <input type="text" value="{{ $peminjaman->inventaris->nama_barang }}"
                    class="w-full border rounded p-2 bg-gray-100" disabled>
                <p class="text-xs text-gray-500">Barang tidak bisa diubah, hapus dan buat baru kalau salah pilih barang.
                </p>
            </div>

            <div>
                <label class="block font-medium">Peminjam</label>
                <input type="text" value="{{ $peminjaman->pengurus->nama_lengkap }}"
                    class="w-full border rounded p-2 bg-gray-100" disabled>
            </div>

            <div>
                <label class="block font-medium">Jumlah Pinjam</label>
                <input type="number" name="jumlah_pinjam"
                    value="{{ old('jumlah_pinjam', $peminjaman->jumlah_pinjam) }}" class="w-full border rounded p-2">
                @error('jumlah_pinjam')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam"
                        value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                        class="w-full border rounded p-2">
                    @error('tanggal_pinjam')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium">Rencana Kembali</label>
                    <input type="date" name="tanggal_kembali_rencana"
                        value="{{ old('tanggal_kembali_rencana', $peminjaman->tanggal_kembali_rencana) }}"
                        class="w-full border rounded p-2">
                    @error('tanggal_kembali_rencana')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block font-medium">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded p-2">{{ old('keterangan', $peminjaman->keterangan) }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('peminjaman.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
