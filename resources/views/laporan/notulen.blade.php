<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Notulen</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white p-4 rounded shadow mb-4">
            <h3 class="font-semibold mb-2">Filter Laporan</h3>
            <form method="GET" class="flex gap-2 flex-wrap items-center">
                <select name="tahun" class="border rounded p-2">
                    <option value="">Tahun</option>
                    @for ($t = date('Y'); $t >= date('Y') - 5; $t--)
                        <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                            {{ $t }}</option>
                    @endfor
                </select>
                <button type="submit" class="bg-gray-700 text-white px-3 py-2 rounded">Terapkan Filter</button>
            </form>
        </div>

        <div class="flex justify-between items-center mb-2">
            <h3 class="font-semibold">Data Laporan Notulen</h3>
            <div class="flex gap-2">
                <a href="{{ route('laporan.notulen.pdf', request()->query()) }}"
                    class="bg-green-600 text-white px-3 py-2 rounded">Export PDF</a>
                <button onclick="window.print()" class="bg-green-600 text-white px-3 py-2 rounded">Cetak</button>
            </div>
        </div>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Judul</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Pemimpin Rapat</th>
                    <th class="p-2">Notulis</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $data->firstItem() + $i }}</td>
                        <td class="p-2">{{ $item->judul }}</td>
                        <td class="p-2">{{ $item->tanggal }}</td>
                        <td class="p-2">{{ $item->pemimpin_rapat ?? '-' }}</td>
                        <td class="p-2">{{ $item->notulis ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $data->links() }}</div>
        <a href="{{ route('laporan.index') }}" class="text-gray-600 mt-4 inline-block">&larr; Kembali ke Laporan</a>
    </div>
</x-app-layout>
