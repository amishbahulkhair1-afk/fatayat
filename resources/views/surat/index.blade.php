<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Administrasi Surat</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <p class="text-gray-500 mb-4">Silahkan kelola surat masuk dan surat keluar organisasi PAC Fatayat NU Pragaan</p>

        <div class="flex gap-2 mb-4">
            <a href="{{ route('surat.index', ['jenis' => 'Masuk']) }}"
                class="px-4 py-2 rounded {{ $jenisAktif == 'Masuk' ? 'bg-green-600 text-white' : 'bg-gray-200' }}">Surat
                Masuk</a>
            <a href="{{ route('surat.index', ['jenis' => 'Keluar']) }}"
                class="px-4 py-2 rounded {{ $jenisAktif == 'Keluar' ? 'bg-green-600 text-white' : 'bg-gray-200' }}">Surat
                Keluar</a>
        </div>

        <form method="GET" class="flex gap-2 mb-4 flex-wrap items-center">
            <input type="hidden" name="jenis" value="{{ $jenisAktif }}">
            <select name="jenis_surat" class="border rounded p-2" onchange="this.form.submit()">
                <option value="">Jenis Surat</option>
                @foreach ($jenisSuratList as $j)
                    <option value="{{ $j }}" {{ request('jenis_surat') == $j ? 'selected' : '' }}>
                        {{ $j }}</option>
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
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Surat"
                class="border rounded p-2">
            <button type="submit" class="bg-gray-600 text-white px-3 py-2 rounded">Cari</button>
            <a href="{{ route('surat.index', ['jenis' => $jenisAktif]) }}"
                class="bg-gray-300 px-3 py-2 rounded">Reset</a>

            <a href="{{ route('surat.create', ['jenis' => $jenisAktif]) }}"
                class="bg-green-600 text-white px-4 py-2 rounded ml-auto">
                + Tambah Surat {{ $jenisAktif }}
            </a>
        </form>

        <h3 class="font-semibold mb-2">Daftar Surat {{ $jenisAktif }}</h3>
        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Nomor Surat</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">{{ $jenisAktif == 'Masuk' ? 'Pengirim' : 'Tujuan' }}</th>
                    <th class="p-2">Perihal</th>
                    <th class="p-2">Jenis Surat</th>
                    <th class="p-2">Sifat Surat</th>
                    <th class="p-2">File</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surat as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $surat->firstItem() + $i }}</td>
                        <td class="p-2">{{ $item->nomor_surat }}</td>
                        <td class="p-2">{{ $item->tanggal }}</td>
                        <td class="p-2">{{ $item->pengirim_tujuan }}</td>
                        <td class="p-2">{{ $item->perihal }}</td>
                        <td class="p-2">{{ $item->jenis_surat }}</td>
                        <td class="p-2">{{ $item->sifat_surat }}</td>
                        <td class="p-2">
                            @if ($item->file_surat)
                                <a href="{{ Storage::url($item->file_surat) }}" target="_blank"
                                    class="text-blue-600">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-2">
                            <a href="{{ route('surat.edit', $item->id) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('surat.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus surat ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="p-2 text-center text-gray-500">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $surat->links() }}</div>
    </div>
</x-app-layout>
