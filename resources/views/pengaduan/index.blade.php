<x-app-layout> <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Pengaduan</h2>
    </x-slot>
    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4"> {{ session('success') }} </div>
        @endif
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Pengaduan Masyarakat</h3>
                <p class="text-sm text-gray-500"> Data pengaduan yang dikirim melalui formulir publik. </p>
            </div> <span class="text-sm text-gray-500"> Total: {{ $pengaduan->total() }} pengaduan </span>
        </div>

        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm text-center">
                <p class="text-3xl font-bold text-yellow-600">{{ $ringkasan['diproses'] }}</p>
                <p class="text-sm text-gray-500 mt-1">Sedang Diproses</p>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm text-center">
                <p class="text-3xl font-bold text-green-600">{{ $ringkasan['selesai'] }}</p>
                <p class="text-sm text-gray-500 mt-1">Pengaduan Selesai</p>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm text-center">
                <p class="text-3xl font-bold text-red-600">{{ $ringkasan['ditolak'] }}</p>
                <p class="text-sm text-gray-500 mt-1">Pengaduan Ditolak</p>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm space-y-4">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">

                {{-- Kategori --}}
                <div x-data="{
                    labelKategori: '{{ request('kategori') ?: 'Semua Kategori' }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>

                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">

                    <x-ui.dropdown width="64" align="left">

                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelKategori"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=kategori]').value = ''; labelKategori = 'Semua Kategori'"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Kategori
                            </button>

                            @foreach ($kategoriList as $k)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=kategori]').value = '{{ $k }}'; labelKategori = '{{ $k }}'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $k }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Bulan --}}
                <div x-data="{
                    labelBulan: '{{ request('bulan') ? \Carbon\Carbon::create()->month(request('bulan'))->translatedFormat('F') : 'Semua Bulan' }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>

                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">

                    <x-ui.dropdown width="64" align="left">

                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelBulan"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=bulan]').value = ''; labelBulan = 'Semua Bulan'"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Bulan
                            </button>

                            @for ($b = 1; $b <= 12; $b++)
                                @php
                                    $namaBulan = \Carbon\Carbon::create()->month($b)->translatedFormat('F');
                                @endphp

                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=bulan]').value = '{{ $b }}'; labelBulan = '{{ $namaBulan }}'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $namaBulan }}
                                </button>
                            @endfor

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Tahun --}}
                <div x-data="{
                    labelTahun: '{{ request('tahun') ?: 'Semua Tahun' }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>

                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">

                    <x-ui.dropdown width="48" align="left">

                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelTahun"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=tahun]').value = ''; labelTahun = 'Semua Tahun'"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Tahun
                            </button>

                            @for ($t = date('Y'); $t >= date('Y') - 5; $t--)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=tahun]').value = '{{ $t }}'; labelTahun = '{{ $t }}'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $t }}
                                </button>
                            @endfor

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Status --}}
                <div x-data="{
                    labelStatus: '{{ request('status') ?: 'Semua Status' }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>

                    <input type="hidden" name="status" value="{{ request('status') }}">

                    <x-ui.dropdown width="56" align="left">

                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelStatus"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            @foreach (['Baru', 'Diproses', 'Selesai', 'Ditolak'] as $s)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=status]').value = '{{ $s }}'; labelStatus = '{{ $s }}'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $s }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Pencarian --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>

                    <x-ui.input name="cari" :value="request('cari')"
                        placeholder="Cari nomor, pelapor, atau kategori..." />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">

                <p class="text-xs text-gray-500">
                    Gunakan filter untuk mempersempit data pengaduan.
                </p>

                <div class="flex gap-2">

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        🔍 Cari
                    </button>

                    <a href="{{ route('pengaduan.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                        ↺ Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <div>
                    <h3 class="font-semibold text-gray-900">Daftar Pengaduan</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $pengaduan->total() }} pengaduan
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No. Pengaduan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Pelapor</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jenis Kekerasan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($pengaduan as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $pengaduan->firstItem() + $i }}
                                </td>

                                <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $item->no_pengaduan }}
                                </td>

                                <td class="px-4 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 border border-green-100">
                                        {{ $item->kategori }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->nama_pelapor }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->jenis_kekerasan ?? '-' }}
                                </td>

                                <td class="px-4 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->status == 'Selesai'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : ($item->status == 'Diproses'
                                                ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                                                : ($item->status == 'Ditolak'
                                                    ? 'bg-red-50 text-red-700 border-red-100'
                                                    : 'bg-gray-50 text-gray-700 border-gray-100')) }}">

                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('pengaduan.show', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-200 transition">

                                            👁 Detail
                                        </a>

                                        <a href="{{ route('pengaduan.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100 transition">

                                                🗑 Hapus
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📭</div>
                                        <p class="font-medium">Belum ada data pengaduan.</p>
                                        <p class="text-sm text-gray-400">
                                            Data pengaduan akan muncul setelah ditambahkan.
                                        </p>
                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="flex justify-end">
            {{ $pengaduan->links() }}
        </div>
    </div>
</x-app-layout>
