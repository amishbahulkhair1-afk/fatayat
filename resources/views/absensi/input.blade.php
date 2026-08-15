<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Absensi Kegiatan</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto space-y-6">

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

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 mt-6 text-sm">

                <div>
                    <p class="text-gray-500 mb-1">Waktu</p>
                    <p class="font-medium text-gray-900">
                        {{ $kegiatan->jam_mulai }}
                        @if ($kegiatan->jam_selesai)
                            - {{ $kegiatan->jam_selesai }}
                        @endif
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 mb-1">Penanggung Jawab</p>
                    <p class="font-medium text-gray-900">
                        {{ $kegiatan->penanggungJawab->nama_lengkap ?? '-' }}
                    </p>
                </div>

                <div class="lg:col-span-1 md:col-span-2">
                    <p class="text-gray-500 mb-1">Lokasi</p>
                    <p class="font-medium text-gray-900">
                        {{ $kegiatan->lokasi_kegiatan ?? '-' }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Form Absensi --}}
        <form action="{{ route('absensi.simpan', $kegiatan->id) }}" method="POST"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">

            @csrf

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Anggota</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Tentukan status kehadiran setiap anggota pada kegiatan ini.
                    </p>
                </div>

                <div class="w-full md:w-72">
                    <x-ui.input id="cariAnggota" placeholder="Cari nama anggota..." onkeyup="filterTabel()" />
                </div>
            </div>

            <div class="flex flex-wrap gap-3">

                <button type="button" onclick="setSemua('Hadir')"
                    class="inline-flex items-center rounded-2xl bg-green-700 px-4 py-2 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    ✅ Semua Hadir
                </button>

                <button type="button" onclick="setSemua('Tidak Hadir')"
                    class="inline-flex items-center rounded-2xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition shadow-lg shadow-red-600/20">

                    ❌ Semua Tidak Hadir
                </button>
            </div>

            <div class="rounded-3xl border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-100 text-sm" id="tabelAbsensi">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600 w-16">No</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Anggota</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Jabatan</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600 w-52">Status Kehadiran</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600 w-72">Keterangan</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">

                            @foreach ($daftarPengurus as $i => $p)
                                @php
                                    $existing = $absensiSudahAda->get($p->id);
                                    $statusAwal = optional($existing)->status_kehadiran ?? 'Tidak Hadir';
                                @endphp

                                <tr class="nama-row hover:bg-gray-50/70 transition">

                                    <td class="px-4 py-4 text-gray-500 align-top">
                                        {{ $i + 1 }}
                                    </td>

                                    <td class="px-4 py-4 align-top">
                                        <div class="font-medium text-gray-900 nama-anggota">
                                            {{ $p->nama_lengkap }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 text-gray-700 align-top">
                                        {{ $p->jabatan ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4 align-top">

                                        <div x-data="{
                                            status: '{{ $statusAwal }}',
                                            setStatus(value) {
                                                this.status = value;
                                                $refs.input.value = value;
                                            }
                                        }" class="relative">

                                            <input type="hidden" name="kehadiran[{{ $p->id }}][status]"
                                                value="{{ $statusAwal }}" class="status-select" x-ref="input">

                                            <x-ui.dropdown width="56" align="left">

                                                <x-slot name="trigger">
                                                    <button type="button"
                                                        class="w-full inline-flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                                        <span class="inline-flex items-center gap-2">

                                                            <span class="h-2.5 w-2.5 rounded-full"
                                                                :class="status === 'Hadir' ? 'bg-green-500' : 'bg-red-500'"></span>

                                                            <span x-text="status"></span>
                                                        </span>

                                                        <svg class="w-4 h-4 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </button>
                                                </x-slot>

                                                <x-slot name="content">

                                                    <button type="button" @click="setStatus('Hadir')"
                                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                                        Hadir
                                                    </button>

                                                    <button type="button" @click="setStatus('Tidak Hadir')"
                                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition">

                                                        <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                                                        Tidak Hadir
                                                    </button>

                                                </x-slot>

                                            </x-ui.dropdown>
                                        </div>

                                    </td>

                                    <td class="px-4 py-4 align-top">

                                        <x-ui.input name="kehadiran[{{ $p->id }}][keterangan]" :value="optional($existing)->keterangan"
                                            placeholder="Misal: Sakit, izin, atau tugas lain" />

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">

                <p class="text-xs text-gray-500">
                    Pastikan status kehadiran setiap anggota sudah sesuai sebelum disimpan.
                </p>

                <div class="flex gap-3">

                    <a href="{{ route('kegiatan.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                        ← Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        💾 Simpan Absensi
                    </button>

                </div>
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
            document.querySelectorAll('.status-select').forEach(input => {
                input.value = status;

                const component = input.closest('[x-data]');
                if (component && component.__x) {
                    component.__x.$data.status = status;
                }
            });
        }
    </script>
</x-app-layout>
