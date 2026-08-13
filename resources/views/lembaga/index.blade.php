<x-app-layout>
    <x-slot name="header">
        Lembaga
    </x-slot>
    <div class="space-y-6">

        {{-- SUCCESS ALERT --}}
        @if (session('success'))
            <div class="rounded-3xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm">
                <div class="flex items-start gap-3">
                    <div
                        class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                        ✅
                    </div>

                    <div>
                        <p class="font-semibold text-green-900">Berhasil</p>
                        <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- BANNER --}}
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-start gap-3">

                    <div
                        class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                        🏛️
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-base font-semibold text-green-900 leading-tight">
                            Data Lembaga
                        </h1>

                        <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                            Kelola data <span class="font-semibold text-green-900">lembaga Fatayat NU</span>
                            secara terpusat untuk mendukung administrasi dan pengelolaan struktur kelembagaan
                            organisasi.
                        </p>
                    </div>
                </div>

                <a href="{{ route('lembaga.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20 flex-shrink-0">
                    <span class="mr-2 text-base">+</span>
                    Tambah Lembaga
                </a>
            </div>
        </div>

        {{-- RINGKASAN STATISTIK --}}
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Lembaga</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $lembaga->total() }}</p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                        🏛️
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Data Ditampilkan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $lembaga->count() }}</p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-700 text-xl">
                        📋
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Ketua Terdaftar</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $lembaga->whereNotNull('ketua_id')->count() }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 text-xl">
                        👤
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Halaman Saat Ini</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $lembaga->currentPage() }}</p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-700 text-xl">
                        📄
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <x-ui.filter-bar :action="route('lembaga.index')" placeholder="Cari nama lembaga atau singkatan..." :statuses="['Aktif', 'Persiapan', 'Vakum', 'Tidak Aktif']" />

        {{-- TABEL LEMBAGA --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Lembaga</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Data lembaga yang telah terdaftar dalam sistem organisasi Fatayat NU.
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-[#F8FBF8]">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Nama Lembaga
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Singkatan
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Ketua
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Status
                            </th>

                            <th
                                class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($lembaga as $item)
                            <tr class="hover:bg-[#F8FBF8] transition-colors">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center text-sm font-bold text-green-700 flex-shrink-0">
                                            {{ strtoupper(substr($item->nama_lembaga, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-900 truncate">
                                                {{ $item->nama_lembaga }}
                                            </p>
                                            <p class="text-xs text-gray-500 truncate">
                                                Lembaga Fatayat Nahdlatul Ulama
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $item->singkatan ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->ketua->nama_lengkap ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $status = $item->status ?? '-';

                                        $badgeClass = match ($status) {
                                            'Aktif' => 'bg-green-100 text-green-700',
                                            'Persiapan' => 'bg-yellow-100 text-yellow-700',
                                            'Vakum' => 'bg-orange-100 text-orange-700',
                                            'Tidak Aktif' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $badgeClass }}">
                                        {{ $status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2">

                                        <a href="{{ route('lembaga.edit', $item->id) }}"
                                            class="inline-flex items-center justify-center rounded-xl border border-green-200 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-50 transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('lembaga.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl border border-red-200 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-14 text-center">

                                    <div class="flex flex-col items-center justify-center gap-4 text-gray-400">

                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                            🏛️
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-500">Belum ada data lembaga</p>
                                            <p class="text-sm text-gray-400 mt-1">
                                                Silakan tambahkan data lembaga pertama untuk mulai mengelola struktur
                                                kelembagaan organisasi.
                                            </p>
                                        </div>

                                        <a href="{{ route('lembaga.create') }}"
                                            class="inline-flex items-center rounded-2xl bg-green-700 px-4 py-2 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                                            + Tambah Lembaga
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if ($lembaga->hasPages())
            <div class="flex justify-center">
                <div class="rounded-2xl bg-white border border-gray-200 shadow-sm px-4 py-3">
                    {{ $lembaga->links() }}
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
