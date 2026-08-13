<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Administrasi Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="flex justify-between items-start mb-4">
            <p class="text-gray-500">Kelola data inventaris dari aset organisasi anda</p>
            <a href="{{ route('inventaris.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah
                Inventaris</a>
        </div>

        <h3 class="font-semibold mb-2">Data Inventaris</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold">{{ $ringkasan['total'] }}</p>
                <p class="text-xs text-gray-500">Total Inventaris</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold text-green-600">{{ $ringkasan['baik'] }}</p>
                <p class="text-xs text-gray-500">Baik</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold text-yellow-600">{{ $ringkasan['rusak_ringan'] }}</p>
                <p class="text-xs text-gray-500">Rusak Ringan</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold text-red-600">{{ $ringkasan['rusak_berat'] }}</p>
                <p class="text-xs text-gray-500">Rusak Berat</p>
            </div>
        </div>

        <form method="GET" class="flex gap-2 mb-4 flex-wrap items-center">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari inventaris"
                class="border rounded p-2">
            <select name="kategori" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Kategori</option>
                @foreach ($kategoriList as $k)
                    <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>
                        {{ $k }}</option>
                @endforeach
            </select>
            <select name="kondisi" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Kondisi</option>
                <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                </option>
                <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat
                </option>
            </select>
            <select name="lokasi" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Lokasi</option>
                @foreach ($lokasiList as $l)
                    <option value="{{ $l }}" {{ request('lokasi') == $l ? 'selected' : '' }}>
                        {{ $l }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-600 text-white px-3 py-2 rounded">Cari</button>
        </form>

        <h3 class="font-semibold mb-2">Daftar Inventaris</h3>
        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Kode</th>
                    <th class="p-2">Nama Barang</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Merk/Tipe</th>
                    <th class="p-2">Tahun</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Satuan</th>
                    <th class="p-2">Lokasi</th>
                    <th class="p-2">Kondisi</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventaris as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $inventaris->firstItem() + $i }}</td>
                        <td class="p-2">{{ $item->kode_inventaris }}</td>
                        <td class="p-2">{{ $item->nama_barang }}</td>
                        <td class="p-2">{{ $item->kategori }}</td>
                        <td class="p-2">{{ $item->merk_tipe ?? '-' }}</td>
                        <td class="p-2">{{ $item->tahun_perolehan ?? '-' }}</td>
                        <td class="p-2">{{ $item->jumlah }}</td>
                        <td class="p-2">{{ $item->satuan ?? '-' }}</td>
                        <td class="p-2">{{ $item->lokasi_penyimpanan ?? '-' }}</td>
                        <td class="p-2">{{ $item->kondisi }}</td>
                        <td class="p-2">
                            <a href="{{ route('inventaris.show', $item->id) }}" class="text-gray-600">Lihat</a>
                            <a href="{{ route('inventaris.edit', $item->id) }}" class="text-blue-600 ml-2">Edit</a>
                            <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="p-2 text-center text-gray-500">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $inventaris->links() }}</div>
    </div>
</x-app-layout>
