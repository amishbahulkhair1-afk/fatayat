<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Absensi</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto space-y-6">

        {{-- Informasi Kegiatan --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                <div>
                    <p class="text-sm text-gray-500">Kegiatan</p>
                    <h3 class="text-xl font-semibold text-gray-900 mt-1">
                        {{ $kegiatan->nama_kegiatan }}
                    </h3>
                </div>

                <span
                    class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 border border-green-100">
                    📅 {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}
                </span>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3 mt-6 text-sm">

                <div>
                    <p class="text-gray-500 mb-1">Waktu</p>
                    <p class="font-medium text-gray-900">
                        {{ $kegiatan->jam_mulai }}
                        @if ($kegiatan->jam_selesai)
                            - {{ $kegiatan->jam_selesai }}
                        @endif
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500 mb-1">Lokasi</p>
                    <p class="font-medium text-gray-900">
                        {{ $kegiatan->lokasi_kegiatan ?? '-' }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Statistik Kehadiran --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div class="rounded-2xl border border-gray-100 bg-white p-4 text-center shadow-sm">
                <p class="text-2xl font-bold text-gray-900">
                    {{ $absensi->count() }}
                </p>
                <p class="text-xs text-gray-500 mt-1">Total Peserta</p>
            </div>

            <div class="rounded-2xl border border-green-100 bg-green-50 p-4 text-center shadow-sm">
                <p class="text-2xl font-bold text-green-700">
                    {{ $absensi->where('status_kehadiran', 'Hadir')->count() }}
                </p>
                <p class="text-xs text-green-600 mt-1">Hadir</p>
            </div>

            <div class="rounded-2xl border border-yellow-100 bg-yellow-50 p-4 text-center shadow-sm">
                <p class="text-2xl font-bold text-yellow-700">
                    {{ $absensi->where('status_kehadiran', 'Izin')->count() }}
                </p>
                <p class="text-xs text-yellow-600 mt-1">Izin</p>
            </div>

            <div class="rounded-2xl border border-red-100 bg-red-50 p-4 text-center shadow-sm">
                <p class="text-2xl font-bold text-red-700">
                    {{ $absensi->where('status_kehadiran', 'Tidak Hadir')->count() }}
                </p>
                <p class="text-xs text-red-600 mt-1">Tidak Hadir</p>
            </div>

        </div>

        {{-- Tabel Absensi --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <div>
                    <h3 class="font-semibold text-gray-900">Daftar Kehadiran</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Rincian kehadiran peserta kegiatan
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Anggota</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jabatan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($absensi as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $i + 1 }}
                                </td>

                                <td class="px-4 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $item->pengurus->nama_lengkap ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->pengurus->jabatan ?? '-' }}
                                </td>

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->status_kehadiran == 'Hadir'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : ($item->status_kehadiran == 'Izin'
                                                ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                                                : 'bg-red-50 text-red-700 border-red-100') }}">

                                        {{ $item->status_kehadiran }}
                                    </span>

                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->keterangan ?? '-' }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📝</div>
                                        <p class="font-medium">Belum ada data absensi.</p>
                                        <p class="text-sm text-gray-400">
                                            Data kehadiran akan muncul setelah absensi diinput.
                                        </p>
                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="flex justify-end">

            <a href="{{ route('kegiatan.index') }}"
                class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                ← Kembali
            </a>
        </div>

    </div>
</x-app-layout>
