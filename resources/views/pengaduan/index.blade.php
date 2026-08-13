<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Pengaduan</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-3 gap-3 mb-4">
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-xl font-bold text-yellow-600">{{ $ringkasan['diproses'] }}</p>
                <p class="text-xs text-gray-500">Diproses</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-xl font-bold text-green-600">{{ $ringkasan['selesai'] }}</p>
                <p class="text-xs text-gray-500">Selesai</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-xl font-bold text-red-600">{{ $ringkasan['ditolak'] }}</p>
                <p class="text-xs text-gray-500">Ditolak</p>
            </div>
        </div>

        <form method="GET" class="flex gap-2 mb-4 flex-wrap items-center">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Pengaduan"
                class="border rounded p-2">
            <select name="kategori" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Kategori</option>
                @foreach ($kategoriList as $k)
                    <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>
                        {{ $k }}</option>
                @endforeach
            </select>
            <select name="bulan" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Bulan</option>
                @for ($b = 1; $b <= 12; $b++)
                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}</option>
                @endfor
            </select>
            <select name="tahun" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Tahun</option>
                @for ($t = date('Y'); $t >= date('Y') - 5; $t--)
                    <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                        {{ $t }}</option>
                @endfor
            </select>
            <select name="status" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Status</option>
                <option value="Baru" {{ request('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
                <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">No. Pengaduan</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Nama Pelapor</th>
                    <th class="p-2">Jenis Kekerasan</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduan as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $pengaduan->firstItem() + $i }}</td>
                        <td class="p-2">{{ $item->no_pengaduan }}</td>
                        <td class="p-2">{{ $item->kategori }}</td>
                        <td class="p-2">{{ $item->tanggal_pengaduan }}</td>
                        <td class="p-2">{{ $item->nama_pelapor }}</td>
                        <td class="p-2">{{ $item->jenis_kekerasan ?? '-' }}</td>
                        <td class="p-2">
                            <span
                                class="px-2 py-1 rounded text-sm
                            {{ $item->status == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $item->status == 'Diproses' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $item->status == 'Ditolak' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $item->status == 'Baru' ? 'bg-gray-100 text-gray-700' : '' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="p-2 space-x-1">
                            <a href="{{ route('pengaduan.show', $item->id) }}">👁</a>
                            <a href="{{ route('pengaduan.edit', $item->id) }}">✏️</a>
                            <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit">🗑</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-2 text-center text-gray-500">Belum ada pengaduan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $pengaduan->links() }}</div>
    </div>
</x-app-layout>
