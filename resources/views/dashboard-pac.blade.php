<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="space-y-6">

        <!-- Welcome -->
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex items-start gap-3">

                <div
                    class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                    🌿
                </div>

                <div class="min-w-0">

                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Dashboard Fatayat NU
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Selamat datang,
                        <span class="font-semibold text-green-900">{{ auth()->user()->name }}</span>
                        👋 Semoga aktivitas organisasi hari ini berjalan lancar dan penuh keberkahan.
                    </p>
                </div>
            </div>
        </div>

        <!-- KPI CARDS -->
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pengurus Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_pengurus'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                        👥
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Anggota Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_anggota'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-700 text-xl">
                        🧑‍🤝‍🧑
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Lembaga Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $ringkasan['total_lembaga'] }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 text-xl">
                        🏛️
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pengaduan Baru</p>
                        <p class="text-3xl font-bold text-red-600 mt-2">
                            {{ $ringkasan['pengaduan_baru'] }}
                        </p>
                    </div>

                    <div class="h-12 w-12 rounded-2xl bg-red-100 flex items-center justify-center text-red-700 text-xl">
                        ⚠️
                    </div>
                </div>
            </div>
        </div>

        <!-- CHART SECTION -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- Bar Chart -->
            <div class="xl:col-span-2 rounded-3xl bg-white border border-gray-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Grafik Organisasi</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Perbandingan jumlah PR, PAR, dan Anggota aktif.
                        </p>
                    </div>
                </div>

                <div id="chartOrganisasi" class="h-80"></div>
            </div>

            <!-- Donut Chart -->
            <div class="rounded-3xl bg-white border border-gray-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Status Kaderisasi</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Distribusi kader aktif berdasarkan tingkat kaderisasi.
                        </p>
                    </div>
                </div>

                <div id="chartKaderisasi" class="h-80"></div>
            </div>
        </div>

        <!-- BOTTOM SECTION -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <!-- Kegiatan -->
            <div class="rounded-3xl bg-white border border-gray-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Kegiatan Mendatang</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Agenda dan kegiatan terjadwal dalam waktu dekat.
                        </p>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse($kegiatanMendatang as $item)
                        <div
                            class="rounded-2xl border border-gray-200 bg-[#F8FBF8] p-4 hover:shadow-sm transition-all duration-200">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0 flex-1">
                                    <p class="font-semibold text-gray-900 leading-tight">
                                        {{ $item->nama_kegiatan }}
                                    </p>
                                    <p class="text-sm text-gray-500 mt-2 flex items-center gap-2">
                                        <span>📍</span>
                                        <span
                                            class="truncate">{{ $item->lokasi_kegiatan ?? 'Lokasi belum ditentukan' }}</span>
                                    </p>
                                </div>

                                <div class="flex-shrink-0 rounded-xl bg-green-100 px-3 py-2 text-center">
                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-green-700">Agenda
                                    </p>
                                    <p class="text-xs font-medium text-green-800 mt-1">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-gray-200 bg-gray-50 py-10 text-center">
                            <div
                                class="h-14 w-14 rounded-full bg-white border border-gray-200 flex items-center justify-center text-2xl mb-3">
                                📭</div>
                            <p class="font-medium text-gray-500">Tidak ada kegiatan mendatang</p>
                            <p class="text-sm text-gray-400 mt-1">
                                Jadwal kegiatan berikutnya akan muncul di sini.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Aktivitas Administrasi -->
            <div class="rounded-3xl bg-white border border-gray-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Administrasi</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Ringkasan aktivitas administrasi organisasi hari ini.
                        </p>
                    </div>
                </div>

                <div class="space-y-4">

                    <div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-[#F8FBF8] p-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-xl bg-green-100 flex items-center justify-center text-green-700">
                                📨</div>
                            <div>
                                <p class="font-medium text-gray-900">Surat Masuk</p>
                                <p class="text-sm text-gray-500">Dokumen yang diterima hari ini</p>
                            </div>
                        </div>
                        <span class="text-xl font-bold text-gray-900">12</span>
                    </div>

                    <div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-[#F8FBF8] p-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-700">
                                📦</div>
                            <div>
                                <p class="font-medium text-gray-900">Inventaris Dipinjam</p>
                                <p class="text-sm text-gray-500">Barang inventaris yang sedang dipinjam</p>
                            </div>
                        </div>
                        <span class="text-xl font-bold text-gray-900">4</span>
                    </div>

                    <div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-[#F8FBF8] p-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-700">
                                📝</div>
                            <div>
                                <p class="font-medium text-gray-900">Notulen Bulan Ini</p>
                                <p class="text-sm text-gray-500">Jumlah notulen yang telah dibuat bulan ini</p>
                            </div>
                        </div>
                        <span class="text-xl font-bold text-gray-900">7</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // BAR CHART ORGANISASI
            new ApexCharts(document.querySelector('#chartOrganisasi'), {
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#16a34a'],
                series: [{
                    name: 'Jumlah',
                    data: [
                        {{ $ringkasan['total_pr'] }},
                        {{ $ringkasan['total_par'] }},
                        {{ $ringkasan['total_anggota'] }}
                    ]
                }],
                xaxis: {
                    categories: ['PR', 'PAR', 'Anggota']
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        columnWidth: '45%'
                    }
                },
                grid: {
                    borderColor: '#f1f5f9'
                }
            }).render();

            // DONUT CHART KADERISASI
            new ApexCharts(document.querySelector('#chartKaderisasi'), {
                chart: {
                    type: 'donut',
                    height: 320
                },
                labels: ['LKD', 'LKK', 'PKL'],
                series: [18, 9, 4],
                colors: ['#16a34a', '#22c55e', '#86efac'],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    enabled: true
                }
            }).render();

        });
    </script>
</x-app-layout>
