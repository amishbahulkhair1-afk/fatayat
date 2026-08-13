<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Berita Kegiatan</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="flex justify-between items-start mb-4">
            <p class="text-gray-500">Kelola berita dan informasi kegiatan organisasi mu</p>
            <a href="{{ route('berita.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Berita</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold">{{ $ringkasan['total'] }}</p>
                <p class="text-xs text-gray-500">Total Berita</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold text-green-600">{{ $ringkasan['publik'] }}</p>
                <p class="text-xs text-gray-500">Dipublikasikan</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold text-yellow-600">{{ $ringkasan['draft'] }}</p>
                <p class="text-xs text-gray-500">Draft</p>
            </div>
            <div class="bg-white border rounded p-3 text-center">
                <p class="text-2xl font-bold text-gray-600">{{ $ringkasan['dijadwalkan'] }}</p>
                <p class="text-xs text-gray-500">Dijadwalkan</p>
            </div>
        </div>

        <form method="GET" class="flex gap-2 mb-4 flex-wrap items-center">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Berita"
                class="border rounded p-2">
            <select name="kategori" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Kategori</option>
                @foreach ($kategoriList as $k)
                    <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>
                        {{ $k }}</option>
                @endforeach
            </select>
            <select name="status" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Status</option>
                <option value="Publik" {{ request('status') == 'Publik' ? 'selected' : '' }}>Publik</option>
                <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                <option value="Dijadwalkan" {{ request('status') == 'Dijadwalkan' ? 'selected' : '' }}>Dijadwalkan
                </option>
            </select>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border rounded p-2"
                onchange="this.form.submit()">
        </form>

        <h3 class="font-semibold mb-2">Daftar Berita</h3>
        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Judul Berita</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Penulis</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($berita as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $berita->firstItem() + $i }}</td>
                        <td class="p-2">{{ $item->judul }}</td>
                        <td class="p-2">{{ $item->kategori }}</td>
                        <td class="p-2">{{ $item->penulis }}</td>
                        <td class="p-2">{{ $item->tanggal_kegiatan }}</td>
                        <td class="p-2">
                            <span
                                class="px-2 py-1 rounded text-sm
                            {{ $item->status == 'Publik' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $item->status == 'Draft' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $item->status == 'Dijadwalkan' ? 'bg-gray-100 text-gray-700' : '' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="p-2">
                            <a href="{{ route('berita.edit', $item->id) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('berita.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-2 text-center text-gray-500">Belum ada berita</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $berita->links() }}</div>
    </div>
</x-app-layout>
