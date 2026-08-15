<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Inventaris</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto space-y-6">

        {{-- Detail Inventaris --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between mb-6">

                <div>
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ $inventaris->nama_barang }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kode: <span class="font-medium text-gray-700">{{ $inventaris->kode_inventaris }}</span>
                    </p>
                </div>

                <span
                    class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold border
                    {{ $inventaris->kondisi == 'Baik'
                        ? 'bg-green-50 text-green-700 border-green-100'
                        : ($inventaris->kondisi == 'Rusak Ringan'
                            ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                            : 'bg-red-50 text-red-700 border-red-100') }}">

                    {{ $inventaris->kondisi }}
                </span>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Kategori</p>
                    <p class="mt-2 text-sm font-semibold text-gray-900">
                        {{ $inventaris->kategori }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Merk / Tipe</p>
                    <p class="mt-2 text-sm font-semibold text-gray-900">
                        {{ $inventaris->merk_tipe ?? '-' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Tahun Perolehan</p>
                    <p class="mt-2 text-sm font-semibold text-gray-900">
                        {{ $inventaris->tahun_perolehan ?? '-' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Lokasi Penyimpanan</p>
                    <p class="mt-2 text-sm font-semibold text-gray-900">
                        {{ $inventaris->lokasi_penyimpanan ?? '-' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4 md:col-span-2">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Stok Tersedia</p>
                    <p class="mt-2 text-sm font-semibold text-gray-900">
                        {{ $inventaris->jumlah }} {{ $inventaris->satuan ?? 'Unit' }}
                    </p>
                </div>
            </div>

            @if ($inventaris->deskripsi)
                <div class="mt-6 rounded-2xl border border-gray-100 bg-gray-50 p-5">
                    <h4 class="text-sm font-semibold text-gray-900 mb-2">
                        Deskripsi / Keterangan
                    </h4>

                    <p class="text-sm leading-relaxed text-gray-700 whitespace-pre-line">
                        {{ $inventaris->deskripsi }}
                    </p>
                </div>
            @endif

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end pt-6">

                <a href="{{ route('inventaris.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Kembali
                </a>

                <a href="{{ route('inventaris.edit', $inventaris->id) }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">

                    ✏️ Edit Inventaris
                </a>
            </div>
        </div>

        {{-- Riwayat Peminjaman --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">

                <div>
                    <h3 class="font-semibold text-gray-900">Riwayat Peminjaman</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $riwayatPeminjaman->total() }} riwayat
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Peminjam</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Jumlah</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tgl Pinjam</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tgl Kembali</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($riwayatPeminjaman as $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 font-medium text-gray-900">
                                    {{ $item->pengurus->nama_lengkap ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->jumlah_pinjam }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ $item->tanggal_kembali_aktual
                                        ? \Carbon\Carbon::parse($item->tanggal_kembali_aktual)->translatedFormat('d M Y')
                                        : '-' }}
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
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📦</div>
                                        <p class="font-medium">Belum ada riwayat peminjaman.</p>
                                        <p class="text-sm text-gray-400">
                                            Data peminjaman inventaris akan muncul di sini.
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
            {{ $riwayatPeminjaman->links() }}
        </div>
    </div>
</x-app-layout>
