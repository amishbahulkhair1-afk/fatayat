<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Anggota</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white p-4 rounded shadow mb-4">
            <h3 class="font-semibold mb-2">Filter Laporan</h3>
            <form method="GET" class="flex gap-2 flex-wrap items-center">
                <select name="status_anggota" class="border rounded p-2">
                    <option value="">Status Anggota</option>
                    <option value="Aktif" {{ request('status_anggota') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ request('status_anggota') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                        Aktif</option>
                </select>
                <button type="submit" class="bg-gray-700 text-white px-3 py-2 rounded">Terapkan Filter</button>
            </form>
        </div>

        <div class="flex justify-between items-center mb-2">
            <h3 class="font-semibold">Data Laporan Anggota</h3>
            <div class="flex gap-2">
                <a href="{{ route('laporan.anggota.pdf', request()->query()) }}"
                    class="bg-green-600 text-white px-3 py-2 rounded">Export PDF</a>
                <button onclick="window.print()" class="bg-green-600 text-white px-3 py-2 rounded">Cetak</button>
            </div>
        </div>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Nama Lengkap</th>
                    <th class="p-2">No KTA</th>
                    <th class="p-2">PR</th>
                    <th class="p-2">PAR</th>
                    <th class="p-2">Tanggal Bergabung</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $data->firstItem() + $i }}</td>
                        <td class="p-2">{{ $item->nama_lengkap }}</td>
                        <td class="p-2">{{ $item->no_kta ?? '-' }}</td>
                        <td class="p-2">{{ $item->pr->nama ?? '-' }}</td>
                        <td class="p-2">{{ $item->par->nama ?? '-' }}</td>
                        <td class="p-2">{{ $item->tanggal_bergabung }}</td>
                        <td class="p-2">{{ $item->status_anggota }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-2 text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $data->links() }}</div>
        <a href="{{ route('laporan.index') }}" class="text-gray-600 mt-4 inline-block">&larr; Kembali ke Laporan</a>
    </div>
</x-app-layout>
