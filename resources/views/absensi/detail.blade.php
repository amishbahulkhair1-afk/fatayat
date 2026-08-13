<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Absensi</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
            <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal_kegiatan }} &nbsp; <strong>Waktu:</strong>
                {{ $kegiatan->jam_mulai }}@if ($kegiatan->jam_selesai)
                    - {{ $kegiatan->jam_selesai }}
                @endif
            </p>
            <p><strong>Lokasi:</strong> {{ $kegiatan->lokasi_kegiatan ?? '-' }}</p>
        </div>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-green-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Nama Anggota</th>
                    <th class="p-2">Jabatan</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Ket</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $i => $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $i + 1 }}</td>
                        <td class="p-2">{{ $item->pengurus->nama_lengkap ?? '-' }}</td>
                        <td class="p-2">{{ $item->pengurus->jabatan ?? '-' }}</td>
                        <td class="p-2">
                            <span
                                class="px-2 py-1 rounded text-sm {{ $item->status_kehadiran == 'Hadir' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->status_kehadiran }}
                            </span>
                        </td>
                        <td class="p-2">{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center text-gray-500">Belum ada data absensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('kegiatan.index') }}" class="bg-gray-300 px-4 py-2 rounded inline-block">Kembali</a>
        </div>
    </div>
</x-app-layout>
