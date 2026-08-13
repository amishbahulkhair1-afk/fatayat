<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Transaksi Peminjaman Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <form method="GET" class="flex gap-2">
                <select name="status" class="border rounded p-2" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>
                        Dikembalikan</option>
                </select>
            </form>
            <a href="{{ route('peminjaman.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Catat
                Peminjaman</a>
        </div>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Barang</th>
                    <th class="p-2">Peminjam</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Tgl Pinjam</th>
                    <th class="p-2">Rencana Kembali</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $item->inventaris->nama_barang ?? '-' }}</td>
                        <td class="p-2">{{ $item->pengurus->nama_lengkap ?? '-' }}</td>
                        <td class="p-2">{{ $item->jumlah_pinjam }}</td>
                        <td class="p-2">{{ $item->tanggal_pinjam }}</td>
                        <td class="p-2">{{ $item->tanggal_kembali_rencana }}</td>
                        <td class="p-2">
                            <span
                                class="px-2 py-1 rounded text-sm {{ $item->status == 'Dikembalikan' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="p-2 space-x-1">
                            @if ($item->status == 'Dipinjam')
                                <form action="{{ route('peminjaman.kembalikan', $item->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-2 py-1 rounded text-sm">Kembalikan</button>
                                </form>
                            @endif
                            <a href="{{ route('peminjaman.edit', $item->id) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-2 text-center text-gray-500">Belum ada data peminjaman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $peminjaman->links() }}</div>
    </div>
</x-app-layout>
