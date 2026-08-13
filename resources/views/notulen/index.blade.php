<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Notulen Rapat</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="flex justify-between mb-4">
            <input type="text" form="cariForm" name="cari" value="{{ request('cari') }}" placeholder="Cari notulen"
                class="border rounded p-2">
            <a href="{{ route('notulen.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah
                Notulen</a>
        </div>
        <form id="cariForm" method="GET"></form>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Judul</th>
                    <th class="p-2">Kegiatan Terkait</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Notulis</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notulen as $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $item->judul }}</td>
                        <td class="p-2">{{ $item->kegiatan->nama_kegiatan ?? '-' }}</td>
                        <td class="p-2">{{ $item->tanggal }}</td>
                        <td class="p-2">{{ $item->notulis ?? '-' }}</td>
                        <td class="p-2">
                            <a href="{{ route('notulen.edit', $item->id) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('notulen.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus notulen ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center text-gray-500">Belum ada notulen</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $notulen->links() }}</div>
    </div>
</x-app-layout>
