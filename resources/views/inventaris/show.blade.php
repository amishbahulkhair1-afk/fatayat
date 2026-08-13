<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded shadow mb-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-semibold">{{ $inventaris->nama_barang }}</h3>
                    <p class="text-gray-500">{{ $inventaris->kode_inventaris }}</p>
                </div>
                <span class="px-3 py-1 rounded text-sm
                    {{ $inventaris->kondisi == 'Baik' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $inventaris->kondisi == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $inventaris->kondisi == 'Rusak Berat' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ $inventaris->kondisi }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Kategori</p>
                    <p class="font-medium">{{ $inventaris->kategori }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Merk/Tipe</p>
                    <p class="font-medium">{{ $inventaris->merk_tipe ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tahun Perolehan</p>
                    <p class="font-medium">{{ $inventaris->tahun_perolehan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Lokasi Penyimpanan</p>
                    <p class="font-medium">{{ $inventaris->lokasi_penyimpanan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Stok Tersedia</p>
                    <p class="font-medium">{{ $inventaris->jumlah }} {{ $inventaris->satuan }}</p>
                </div>
            </div>

            @if($inventaris->deskripsi)
            <div class="mt-4">
                <p class="text-gray-500 text-sm">Deskripsi/Keterangan</p>
                <p>{{ $inventaris->deskripsi }}</p>
            </div>
            @endif

            <div class="flex gap-2 mt-6">
                <a href="{{ route('inventaris.edit', $inventaris->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit</a>
                <a href="{{ route('inventaris.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
            </div>
        </div>

        <h3 class="font-semibold mb-2">Riwayat Peminjaman</h3>
        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Peminjam</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Tgl Pinjam</th>
                    <th class="p-2">Tgl Kembali</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayatPeminjaman as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $item->pengurus->nama_lengkap ?? '-' }}</td>
                    <td class="p-2">{{ $item->jumlah_pinjam }}</td>
                    <td class="p-2">{{ $item->tanggal_pinjam }}</td>
                    <td class="p-2">{{ $item->tanggal_kembali_aktual ?? '-' }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded text-sm {{ $item->status == 'Dikembalikan' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-2 text-center text-gray-500">Belum pernah dipinjam</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $riwayatPeminjaman->links() }}</div>
    </div>
</x-app-layout>