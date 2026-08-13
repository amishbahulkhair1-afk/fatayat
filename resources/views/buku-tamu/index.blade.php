<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Buku Tamu</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('buku-tamu.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Tamu</a>
        </div>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Nama Tamu</th>
                    <th class="p-2">Asal Instansi</th>
                    <th class="p-2">Tujuan</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Jam</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bukuTamu as $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $item->nama_tamu }}</td>
                        <td class="p-2">{{ $item->asal_instansi ?? '-' }}</td>
                        <td class="p-2">{{ $item->tujuan_kunjungan }}</td>
                        <td class="p-2">{{ $item->tanggal_kunjungan }}</td>
                        <td class="p-2">{{ $item->jam_kunjungan ?? '-' }}</td>
                        <td class="p-2">
                            <a href="{{ route('buku-tamu.edit', $item->id) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('buku-tamu.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-2 text-center text-gray-500">Belum ada data tamu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $bukuTamu->links() }}</div>
    </div>
</x-app-layout>
