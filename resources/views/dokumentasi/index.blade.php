<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Daftar Dokumentasi Kegiatan</h2>
            </div>
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
                    <h3 class="text-lg font-semibold text-gray-900">Dokumentasi Kegiatan</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Simpan dan publikasikan foto dokumentasi kegiatan organisasi.
                    </p>
                </div>

                <a href="{{ route('dokumentasi.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    + Tambah Dokumentasi
                </a>
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

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori
                    </label>

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

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Dokumentasi
                    </label>

                    <x-ui.input type="date" name="tanggal" :value="request('tanggal')" />
                </div>

                {{-- Pencarian --}}
                <div class="md:col-span-2 xl:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pencarian
                    </label>

                    <x-ui.input name="cari" :value="request('cari')"
                        placeholder="Cari judul dokumentasi atau kategori..." />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">

                <p class="text-xs text-gray-500">
                    Gunakan filter untuk mempersempit hasil pencarian dokumentasi.
                </p>

                <div class="flex gap-2">

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        Cari
                    </button>

                    <a href="{{ route('dokumentasi.index') }}"
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
                    <h3 class="font-semibold text-gray-900">Daftar Dokumentasi</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $dokumentasi->total() }} dokumentasi
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Foto</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Judul Dokumentasi</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($dokumentasi as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $dokumentasi->firstItem() + $i }}
                                </td>

                                <td class="px-4 py-4">

                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}"
                                            alt="{{ $item->judul_dokumentasi }}"
                                            class="h-14 w-14 rounded-2xl object-cover border border-gray-200 shadow-sm">
                                    @else
                                        <div
                                            class="h-14 w-14 rounded-2xl border border-dashed border-gray-300 bg-gray-50 flex items-center justify-center text-gray-400 text-xs">
                                            Tidak ada
                                        </div>
                                    @endif

                                </td>

                                <td class="px-4 py-4 font-medium text-gray-900 max-w-xs truncate">
                                    {{ $item->judul_dokumentasi }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $item->kategori }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->status == 'Publikasi'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : 'bg-yellow-50 text-yellow-700 border-yellow-100' }}">

                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        @if ($item->foto)
                                            <a href="{{ Storage::url($item->foto) }}" target="_blank"
                                                class="inline-flex items-center rounded-xl bg-gray-50 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-100 transition">

                                                Lihat
                                            </a>
                                        @endif

                                        <a href="{{ route('dokumentasi.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            Edit
                                        </a>

                                        <form action="{{ route('dokumentasi.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin hapus dokumentasi ini?')">

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
                                        <div class="text-4xl">📸</div>
                                        <p class="font-medium">Belum ada dokumentasi kegiatan.</p>
                                        <p class="text-sm text-gray-400">
                                            Data dokumentasi akan muncul setelah ditambahkan.
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
            {{ $dokumentasi->links() }}
        </div>
    </div>
</x-app-layout>
