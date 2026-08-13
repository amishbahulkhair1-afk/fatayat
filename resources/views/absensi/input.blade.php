<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Absensi Kegiatan</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-4 rounded shadow mb-4 grid grid-cols-2 gap-2 text-sm">
            <p><strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
            <p><strong>Waktu:</strong> {{ $kegiatan->jam_mulai }}@if ($kegiatan->jam_selesai)
                    - {{ $kegiatan->jam_selesai }}
                @endif
            </p>
            <p><strong>Penanggung Jawab:</strong> {{ $kegiatan->penanggungJawab->nama_lengkap ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal_kegiatan }}</p>
            <p><strong>Lokasi:</strong> {{ $kegiatan->lokasi_kegiatan ?? '-' }}</p>
        </div>

        <form action="{{ route('absensi.simpan', $kegiatan->id) }}" method="POST" class="bg-white p-4 rounded shadow">
            @csrf

            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-green-700">Daftar Anggota</h3>
                <input type="text" id="cariAnggota" placeholder="Cari nama anggota" class="border rounded p-2"
                    onkeyup="filterTabel()">
            </div>

            <div class="flex gap-2 mb-3">
                <button type="button" onclick="setSemua('Hadir')"
                    class="bg-green-600 text-white px-3 py-1 rounded text-sm">Semua Hadir</button>
                <button type="button" onclick="setSemua('Tidak Hadir')"
                    class="bg-red-600 text-white px-3 py-1 rounded text-sm">Semua Tidak Hadir</button>
            </div>

            <table class="w-full border" id="tabelAbsensi">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-2">No</th>
                        <th class="p-2">Nama Anggota</th>
                        <th class="p-2">Jabatan</th>
                        <th class="p-2">Status Kehadiran</th>
                        <th class="p-2">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarPengurus as $i => $p)
                        @php $existing = $absensiSudahAda->get($p->id); @endphp
                        <tr class="border-t nama-row">
                            <td class="p-2">{{ $i + 1 }}</td>
                            <td class="p-2 nama-anggota">{{ $p->nama_lengkap }}</td>
                            <td class="p-2">{{ $p->jabatan ?? '-' }}</td>
                            <td class="p-2">
                                <select name="kehadiran[{{ $p->id }}][status]"
                                    class="border rounded p-1 status-select">
                                    <option value="Hadir"
                                        {{ optional($existing)->status_kehadiran == 'Hadir' ? 'selected' : '' }}>Hadir
                                    </option>
                                    <option value="Tidak Hadir"
                                        {{ !$existing || $existing->status_kehadiran == 'Tidak Hadir' ? 'selected' : '' }}>
                                        Tidak Hadir</option>
                                </select>
                            </td>
                            <td class="p-2">
                                <input type="text" name="kehadiran[{{ $p->id }}][keterangan]"
                                    value="{{ optional($existing)->keterangan }}" class="border rounded p-1 w-full"
                                    placeholder="misal: Sakit">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex gap-2 mt-4">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Absensi</button>
                <a href="{{ route('kegiatan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>

    <script>
        function filterTabel() {
            const cari = document.getElementById('cariAnggota').value.toLowerCase();
            document.querySelectorAll('.nama-row').forEach(row => {
                const nama = row.querySelector('.nama-anggota').textContent.toLowerCase();
                row.style.display = nama.includes(cari) ? '' : 'none';
            });
        }

        function setSemua(status) {
            document.querySelectorAll('.status-select').forEach(select => {
                select.value = status;
            });
        }
    </script>
</x-app-layout>
