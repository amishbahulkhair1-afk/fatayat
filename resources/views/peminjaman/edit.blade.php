<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Peminjaman</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf
            @method('PUT')

            {{-- Informasi Barang --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Barang Inventaris</label>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">

                        <div class="font-medium">{{ $peminjaman->inventaris->nama_barang }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            Kode: {{ $peminjaman->inventaris->kode_inventaris ?? '-' }}
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">
                        Barang tidak bisa diubah. Jika salah pilih, hapus transaksi lalu buat peminjaman baru.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Peminjam</label>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">

                        <div class="font-medium">{{ $peminjaman->pengurus->nama_lengkap }}</div>
                    </div>
                </div>
            </div>

            {{-- Jumlah --}}
            <div>
                <x-ui.input type="number" name="jumlah_pinjam" label="Jumlah Pinjam" :value="old('jumlah_pinjam', $peminjaman->jumlah_pinjam)" min="1"
                    required />

                @error('jumlah_pinjam')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <div>
                    <x-ui.date-input name="tanggal_pinjam" label="Tanggal Pinjam" :value="old('tanggal_pinjam', $peminjaman->tanggal_pinjam)" required />

                    @error('tanggal_pinjam')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-ui.date-input name="tanggal_kembali_rencana" label="Rencana Kembali" :value="old('tanggal_kembali_rencana', $peminjaman->tanggal_kembali_rencana)"
                        required />

                    @error('tanggal_kembali_rencana')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Saat Ini</label>

                <div class="flex items-center gap-2">

                    <span
                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                        {{ $peminjaman->status == 'Dikembalikan'
                            ? 'bg-green-50 text-green-700 border-green-100'
                            : 'bg-yellow-50 text-yellow-700 border-yellow-100' }}">

                        {{ $peminjaman->status }}
                    </span>

                    @if ($peminjaman->status == 'Dipinjam')
                        <span class="text-xs text-gray-500">
                            Barang masih berada pada peminjam.
                        </span>
                    @else
                        <span class="text-xs text-gray-500">
                            Barang sudah dikembalikan.
                        </span>
                    @endif
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <x-ui.textarea name="keterangan" label="Keterangan" rows="4"
                    placeholder="Tambahkan catatan perubahan atau informasi tambahan...">{{ old('keterangan', $peminjaman->keterangan) }}</x-ui.textarea>
            </div>

            {{-- Action --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end pt-4">

                <a href="{{ route('peminjaman.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    💾 Update Peminjaman
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
