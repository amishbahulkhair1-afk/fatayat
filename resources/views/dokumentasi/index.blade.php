<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Dokumentasi Kegiatan</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('dokumentasi.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah
                Dokumentasi</a>
        </div>

        <form method="GET" class="flex gap-2 mb-4 flex-wrap items-center">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Dokumentasi"
                class="border rounded p-2">
            <select name="kategori" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Kategori</option>
                @foreach ($kategoriList as $k)
                    <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>
                        {{ $k }}</option>
                @endforeach
            </select>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border rounded p-2"
                onchange="this.form.submit()">
        </form>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Foto</th>
                    <th class="p-2">Judul Dokumentasi</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Tgl. Dokumentasi</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokumentasi as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $dokumentasi->firstItem() + $i }}</td>
                        <td class="p-2">
                            @if ($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" class="w-14 h-14 object-cover rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-2">{{ $item->judul_dokumentasi }}</td>
                        <td class="p-2">{{ $item->kategori }}</td>
                        <td class="p-2">{{ $item->tanggal_kegiatan }}</td>
                        <td class="p-2">
                            <span
                                class="px-2 py-1 rounded text-sm {{ $item->status == 'Publikasi' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="p-2 space-x-1">
                            @if ($item->foto)
                                <a href="{{ Storage::url($item->foto) }}" target="_blank">👁</a>
                            @endif
                            <a href="{{ route('dokumentasi.edit', $item->id) }}">✏️</a>
                            <form action="{{ route('dokumentasi.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit">🗑</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-2 text-center text-gray-500">Belum ada dokumentasi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $dokumentasi->links() }}</div>
    </div>
</x-app-layout>
