<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white p-4 rounded shadow mb-4">
            <h3 class="font-semibold mb-2">Filter Laporan</h3>
            <form method="GET" class="flex gap-2 flex-wrap items-center">
                <input type="text" name="nama_barang" value="{{ request('nama_barang') }}" placeholder="Nama Barang"
                    class="border rounded p-2">
                <input type="text" name="kategori" value="{{ request('kategori') }}" placeholder="Kategori"
                    class="border rounded p-2">
                <select name="kondisi" class="border rounded p-2">
                    <option value="">Kondisi</option>
                    <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak
                        Ringan</option>
                    <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat
                    </option>
                </select>
                <input type="text" name="satuan" value="{{ request('satuan') }}" placeholder="Satuan"
                    class="border rounded p-2">
                <button type="submit" class="bg-gray-700 text-white px-3 py-2 rounded">Terapkan Filter</button>
            </form>
        </div>

        <div class="flex justify-between items-center mb-2">
            <h3 class="font-semibold">Data Laporan Inventaris</h3>
            <div class="flex gap-2">
                <a href="{{ route('laporan.inventaris.pdf', request()->query()) }}"
                    class="bg-green-600 text-white px-3 py-2 rounded">Export PDF</a>
                <button onclick="window.print()" class="bg-green-600 text-white px-3 py-2 rounded">Cetak</button>
            </div>
        </div>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Kode Barang</th>
                    <th class="p-2">Nama Barang</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Satuan</th>
                    <th class="p-2">Kondisi</th>
                    <th class="p-2">Lokasi</th>
                    <th class="p-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $data->firstItem() + $i }}</td>
                        <td class="p-2">{{ $item->kode_inventaris }}</td>
                        <td class="p-2">{{ $item->nama_barang }}</td>
                        <td class="p-2">{{ $item->kategori }}</td>
                        <td class="p-2">{{ $item->jumlah }}</td>
                        <td class="p-2">{{ $item->satuan ?? '-' }}</td>
                        <td class="p-2">{{ $item->kondisi }}</td>
                        <td class="p-2">{{ $item->lokasi_penyimpanan ?? '-' }}</td>
                        <td class="p-2">{{ $item->deskripsi ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="p-2 text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $data->links() }}</div>
        <a href="{{ route('laporan.index') }}" class="text-gray-600 mt-4 inline-block">&larr; Kembali ke Laporan</a>
    </div>
</x-app-layout>
