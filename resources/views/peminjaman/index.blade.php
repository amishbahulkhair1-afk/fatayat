<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Transaksi Peminjaman Inventaris</h2>
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
                    <h3 class="text-lg font-semibold text-gray-900">Peminjaman Inventaris</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola transaksi peminjaman dan pengembalian inventaris organisasi.
                    </p>
                </div>

                <a href="{{ route('peminjaman.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    📦 + Catat Peminjaman
                </a>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm space-y-4">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

                {{-- Status --}}
                <div x-data="{
                    openStatus: false,
                    labelStatus: '{{ request('status') ?: 'Semua Status' }}'
                }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Peminjaman</label>

                    <input type="hidden" name="status" value="{{ request('status') }}">

                    <x-ui.dropdown width="64" align="left">
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

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=status]').value = 'Dipinjam'; labelStatus = 'Dipinjam'; openStatus = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-yellow-500"></span>
                                Dipinjam
                            </button>

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=status]').value = 'Dikembalikan'; labelStatus = 'Dikembalikan'; openStatus = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                Dikembalikan
                            </button>

                        </x-slot>
                    </x-ui.dropdown>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">

                <p class="text-xs text-gray-500">
                    Filter akan diterapkan setelah tombol cari ditekan.
                </p>

                <div class="flex gap-2">

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        🔍 Terapkan Filter
                    </button>

                    <a href="{{ route('peminjaman.index') }}"
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
                    <h3 class="font-semibold text-gray-900">Daftar Transaksi Peminjaman</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $peminjaman->total() }} transaksi
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Barang</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Peminjam</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jumlah</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tgl Pinjam</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Rencana Kembali</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($peminjaman as $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 font-medium text-gray-900">
                                    {{ $item->inventaris->nama_barang ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->pengurus->nama_lengkap ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->jumlah_pinjam }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali_rencana)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->status == 'Dikembalikan'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : 'bg-yellow-50 text-yellow-700 border-yellow-100' }}">

                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex flex-wrap items-center gap-2">

                                        @if ($item->status == 'Dipinjam')
                                            <form action="{{ route('peminjaman.kembalikan', $item->id) }}"
                                                method="POST" class="inline">

                                                @csrf

                                                <button type="submit"
                                                    class="inline-flex items-center rounded-xl bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700 hover:bg-green-100 transition">

                                                    ✔ Kembalikan
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('peminjaman.edit', $item->id) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST"
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
                                <td colspan="7" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📦</div>
                                        <p class="font-medium">Belum ada data peminjaman.</p>
                                        <p class="text-sm text-gray-400">
                                            Transaksi peminjaman inventaris akan muncul di sini.
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
            {{ $peminjaman->links() }}
        </div>
    </div>
</x-app-layout>
