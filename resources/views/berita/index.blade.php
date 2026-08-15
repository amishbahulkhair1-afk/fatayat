<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Berita Kegiatan</h2>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- HEADER CARD --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Manajemen Berita</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Tambahkan, edit, dan publikasikan berita kegiatan organisasi.
                    </p>
                </div>

                <a href="{{ route('berita.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    + Tambah Berita
                </a>
            </div>
        </div>

        {{-- STATISTIK --}}
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Total Berita</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $ringkasan['total'] }}</p>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Dipublikasikan</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $ringkasan['publik'] }}</p>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Draft</p>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $ringkasan['draft'] }}</p>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Dijadwalkan</p>
                <p class="text-3xl font-bold text-gray-600 mt-2">{{ $ringkasan['dijadwalkan'] }}</p>
            </div>
        </div>

        {{-- FILTER --}}
        <form method="GET" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm space-y-4">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                {{-- Kategori --}}
                <div x-data="{
                    openKategori: false,
                    labelKategori: '{{ request('kategori') ?: 'Semua Kategori' }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>

                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openKategori = !openKategori"
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
                                @click="$el.closest('[x-data]').querySelector('input[name=kategori]').value = ''; labelKategori = 'Semua Kategori'; openKategori = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Kategori
                            </button>

                            @foreach ($kategoriList as $k)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=kategori]').value = '{{ $k }}'; labelKategori = '{{ $k }}'; openKategori = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $k }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Status --}}
                <div x-data="{
                    openStatus: false,
                    labelStatus: '{{ request('status') ?: 'Semua Status' }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>

                    <input type="hidden" name="status" value="{{ request('status') }}">

                    <x-ui.dropdown width="56" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openStatus = !openStatus"
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

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=status]').value = ''; labelStatus = 'Semua Status'; openStatus = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Status
                            </button>

                            @foreach (['Publik', 'Draft', 'Dijadwalkan'] as $status)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=status]').value = '{{ $status }}'; labelStatus = '{{ $status }}'; openStatus = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $status }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <x-ui.input type="date" name="tanggal" :value="request('tanggal')" />
                </div>

                {{-- Pencarian --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <x-ui.input name="cari" :value="request('cari')" placeholder="Cari judul atau penulis..." />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
                <p class="text-xs text-gray-500">
                    Gunakan filter untuk menemukan berita tertentu dengan lebih cepat.
                </p>

                <div class="flex gap-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        Cari
                    </button>

                    <a href="{{ route('berita.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                        Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- TABEL --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <div>
                    <h3 class="font-semibold text-gray-900">Daftar Berita</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $berita->total() }} berita
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Judul Berita</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Penulis</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($berita as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $berita->firstItem() + $i }}
                                </td>

                                <td class="px-4 py-4 font-medium text-gray-900 max-w-xs truncate">
                                    {{ $item->judul }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $item->kategori }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $item->penulis }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->status == 'Publik'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : ($item->status == 'Draft'
                                                ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                                                : 'bg-gray-50 text-gray-700 border-gray-100') }}">

                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('berita.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            Edit
                                        </a>

                                        <form action="{{ route('berita.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus berita ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100 transition">

                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📰</div>
                                        <p class="font-medium">Belum ada berita kegiatan.</p>
                                        <p class="text-sm text-gray-400">
                                            Data berita akan muncul setelah ditambahkan.
                                        </p>
                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end">
            {{ $berita->links() }}
        </div>
    </div>
</x-app-layout>
