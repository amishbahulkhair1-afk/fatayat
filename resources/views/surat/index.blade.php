<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Administrasi Surat</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6">

        {{-- Alert --}}
        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header Card --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Administrasi Surat</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola surat masuk dan surat keluar organisasi PAC Fatayat NU Pragaan.
                    </p>
                </div>

                <a href="{{ route('surat.create', ['jenis' => $jenisAktif]) }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    📄 + Tambah Surat {{ $jenisAktif }}
                </a>
            </div>
        </div>

        {{-- Tab Jenis Surat --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-2 shadow-sm">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">

                <a href="{{ route('surat.index', ['jenis' => 'Masuk']) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold transition
                    {{ $jenisAktif == 'Masuk'
                        ? 'bg-green-700 text-white shadow-lg shadow-green-700/20'
                        : 'text-gray-600 hover:bg-gray-50' }}">

                    📥 Surat Masuk
                </a>

                <a href="{{ route('surat.index', ['jenis' => 'Keluar']) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold transition
                    {{ $jenisAktif == 'Keluar'
                        ? 'bg-green-700 text-white shadow-lg shadow-green-700/20'
                        : 'text-gray-600 hover:bg-gray-50' }}">

                    📤 Surat Keluar
                </a>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm space-y-4">

            <input type="hidden" name="jenis" value="{{ $jenisAktif }}">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                {{-- Jenis Surat --}}
                <div x-data="{
                    openJenis: false,
                    labelJenis: '{{ request('jenis_surat') ?: 'Semua Jenis Surat' }}'
                }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>

                    <input type="hidden" name="jenis_surat" value="{{ request('jenis_surat') }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openJenis = !openJenis"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelJenis"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=jenis_surat]').value = ''; labelJenis = 'Semua Jenis Surat'; openJenis = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Jenis Surat
                            </button>

                            @foreach ($jenisSuratList as $j)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=jenis_surat]').value = '{{ $j }}'; labelJenis = '{{ $j }}'; openJenis = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $j }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Bulan --}}
                <div x-data="{
                    openBulan: false,
                    labelBulan: '{{ request('bulan') ? \Carbon\Carbon::create()->month(request('bulan'))->translatedFormat('F') : 'Semua Bulan' }}'
                }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>

                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openBulan = !openBulan"
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
                                @click="$el.closest('[x-data]').querySelector('input[name=bulan]').value = ''; labelBulan = 'Semua Bulan'; openBulan = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Bulan
                            </button>

                            @for ($b = 1; $b <= 12; $b++)
                                @php $namaBulan = \Carbon\Carbon::create()->month($b)->translatedFormat('F'); @endphp

                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=bulan]').value = '{{ $b }}'; labelBulan = '{{ $namaBulan }}'; openBulan = false"
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
                    openTahun: false,
                    labelTahun: '{{ request('tahun') ?: 'Semua Tahun' }}'
                }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>

                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">

                    <x-ui.dropdown width="48" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openTahun = !openTahun"
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
                                @click="$el.closest('[x-data]').querySelector('input[name=tahun]').value = ''; labelTahun = 'Semua Tahun'; openTahun = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Tahun
                            </button>

                            @for ($t = date('Y'); $t >= date('Y') - 5; $t--)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=tahun]').value = '{{ $t }}'; labelTahun = '{{ $t }}'; openTahun = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $t }}
                                </button>
                            @endfor

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Pencarian --}}
                <div class="md:col-span-2 xl:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>

                    <x-ui.input name="cari" :value="request('cari')"
                        placeholder="Cari nomor surat, perihal, atau pengirim/tujuan..." />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
                <p class="text-xs text-gray-500">
                    Filter akan diterapkan setelah tombol cari ditekan.
                </p>

                <div class="flex gap-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        🔍 Cari
                    </button>

                    <a href="{{ route('surat.index', ['jenis' => $jenisAktif]) }}"
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
                    <h3 class="font-semibold text-gray-900">Daftar Surat {{ $jenisAktif }}</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $surat->total() }} surat
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nomor Surat</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">
                                {{ $jenisAktif == 'Masuk' ? 'Pengirim' : 'Tujuan' }}
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Perihal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jenis Surat</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Sifat Surat</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">File</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($surat as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $surat->firstItem() + $i }}
                                </td>

                                <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $item->nomor_surat }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->pengirim_tujuan }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 max-w-xs truncate">
                                    {{ $item->perihal }}
                                </td>

                                <td class="px-4 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 border border-green-100">
                                        {{ $item->jenis_surat }}
                                    </span>
                                </td>

                                <td class="px-4 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->sifat_surat == 'Penting'
                                            ? 'bg-red-50 text-red-700 border-red-100'
                                            : ($item->sifat_surat == 'Segera'
                                                ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                                                : 'bg-gray-50 text-gray-700 border-gray-100') }}">

                                        {{ $item->sifat_surat }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    @if ($item->file_surat)
                                        <a href="{{ Storage::url($item->file_surat) }}" target="_blank"
                                            class="inline-flex items-center gap-1 rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            📎 Lihat
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif

                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('surat.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('surat.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus surat ini?')">

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
                                <td colspan="9" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📭</div>
                                        <p class="font-medium">Belum ada surat {{ strtolower($jenisAktif) }}.</p>
                                        <p class="text-sm text-gray-400">Data surat akan muncul setelah ditambahkan.
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
            {{ $surat->links() }}
        </div>
    </div>
</x-app-layout>
