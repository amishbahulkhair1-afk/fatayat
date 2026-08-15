<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Laporan Anggota</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6">

        {{-- FILTER --}}
        <form method="GET" class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-4">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

                <div class="flex-1 max-w-sm" x-data="{
                    openStatus: false,
                    labelStatus: '{{ request('status_anggota') ?: 'Semua Status' }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status Anggota
                    </label>

                    <input type="hidden" name="status_anggota" value="{{ request('status_anggota') }}">

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
                                @click="$el.closest('[x-data]').querySelector('input[name=status_anggota]').value = ''; labelStatus = 'Semua Status'; openStatus = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                Semua Status
                            </button>

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=status_anggota]').value = 'Aktif'; labelStatus = 'Aktif'; openStatus = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                Aktif
                            </button>

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=status_anggota]').value = 'Tidak Aktif'; labelStatus = 'Tidak Aktif'; openStatus = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                Tidak Aktif
                            </button>

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                <div class="flex gap-2">

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                        Terapkan Filter
                    </button>

                    <a href="{{ route('laporan.anggota') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                        Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- HEADER TABEL --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h3 class="text-lg font-semibold text-gray-900">Data Laporan Anggota</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Total data: {{ $data->total() }} anggota
                </p>
            </div>

            <div class="flex gap-2">

                <a href="{{ route('laporan.anggota.pdf', request()->query()) }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    Export PDF
                </a>

                <button onclick="window.print()"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    Cetak
                </button>
            </div>
        </div>

        {{-- TABEL --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Lengkap</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">No KTA</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">PR</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">PAR</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Tanggal Bergabung</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($data as $i => $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $data->firstItem() + $i }}
                                </td>

                                <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $item->nama_lengkap }}
                                </td>

                                <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $item->no_kta ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->pr->nama ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-700">
                                    {{ $item->par->nama ?? '-' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_bergabung)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->status_anggota == 'Aktif'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : 'bg-gray-50 text-gray-700 border-gray-100' }}">

                                        {{ $item->status_anggota }}
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-4xl">📄</div>
                                        <p class="font-medium">Tidak ada data anggota.</p>
                                        <p class="text-sm text-gray-400">
                                            Data akan muncul setelah anggota ditambahkan.
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
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
