<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Daftar Kaderisasi
        </h2>
    </x-slot>

    <div class="space-y-6 max-w-7xl mx-auto">

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
                        🎓
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-base font-semibold text-green-900 leading-tight">
                            Data Kaderisasi
                        </h1>

                        <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                            Kelola data <span class="font-semibold text-green-900">riwayat kaderisasi Fatayat NU</span>
                            untuk memantau jenjang kaderisasi, status kader, dan perkembangan sumber daya organisasi.
                        </p>
                    </div>
                </div>

                <a href="{{ route('riwayat-kaderisasi.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20 flex-shrink-0">
                    <span class="mr-2 text-base">+</span>
                    Tambah Riwayat
                </a>
            </div>
        </div>

        {{-- FILTER BAR --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5">

            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jenjang Kaderisasi
                    </label>

                    <div x-data="{ open: false, jenjang: '{{ request('jenjang') }}', labelJenjang: '{{ request('jenjang') ?: 'Semua Jenjang' }}' }" class="relative">

                        <input type="hidden" name="jenjang" :value="jenjang">

                        <x-ui.dropdown width="64" align="left">

                            <x-slot name="trigger">
                                <button type="button"
                                    class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                    <span class="flex items-center gap-2">
                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        <span x-text="labelJenjang"></span>
                                    </span>

                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button" @click="jenjang = ''; labelJenjang = 'Semua Jenjang'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                    Semua Jenjang
                                </button>

                                @foreach ($jenjangList as $j)
                                    <button type="button"
                                        @click="jenjang = '{{ $j }}'; labelJenjang = '{{ $j }}'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        {{ $j }}
                                    </button>
                                @endforeach

                            </x-slot>
                        </x-ui.dropdown>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status Kader
                    </label>

                    <div x-data="{ open: false, status: '{{ request('status') }}', labelStatus: '{{ request('status') ?: 'Semua Status' }}' }" class="relative">

                        <input type="hidden" name="status" :value="status">

                        <x-ui.dropdown width="64" align="left">

                            <x-slot name="trigger">
                                <button type="button"
                                    class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                    <span class="flex items-center gap-2">
                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        <span x-text="labelStatus"></span>
                                    </span>

                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button" @click="status = ''; labelStatus = 'Semua Status'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                    Semua Status
                                </button>

                                <button type="button" @click="status = 'Anggota'; labelStatus = 'Anggota'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    Anggota
                                </button>

                                <button type="button" @click="status = 'Pengurus'; labelStatus = 'Pengurus'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                                    Pengurus
                                </button>

                            </x-slot>
                        </x-ui.dropdown>
                    </div>
                </div>

                <div class="xl:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>

                    <div class="flex gap-3">

                        <input type="text" name="cari" value="{{ request('cari') }}"
                            placeholder="Cari nama kader, jabatan, PR, atau PAR..."
                            class="flex-1 rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                            🔍 Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- RINGKASAN STATISTIK --}}
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Riwayat</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $riwayat->total() }}</p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                        🎓
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status Anggota</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $riwayat->where('status', 'Anggota')->count() }}
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
                        <p class="text-sm font-medium text-gray-500">Status Pengurus</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $riwayat->where('status', 'Pengurus')->count() }}
                        </p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-700 text-xl">
                        🏛️
                    </div>
                </div>
            </div>

            <div
                class="rounded-3xl bg-white border border-gray-200 shadow-sm p-5 hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Halaman Saat Ini</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $riwayat->currentPage() }}</p>
                    </div>

                    <div
                        class="h-12 w-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-700 text-xl">
                        📄
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL RIWAYAT --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Riwayat Kaderisasi</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Data kader beserta jenjang kaderisasi, wilayah asal, dan status organisasi yang tercatat dalam
                        sistem.
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-[#F8FBF8]">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                No
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Nama Kader
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Jabatan
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Jenjang
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Wilayah Asal
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

                        @forelse($riwayat as $i => $item)
                            <tr class="hover:bg-[#F8FBF8] transition-colors">

                                <td class="px-6 py-4 text-sm font-medium text-gray-500 whitespace-nowrap">
                                    {{ $riwayat->firstItem() + $i }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center text-sm font-bold text-green-700 flex-shrink-0">
                                            {{ strtoupper(substr($item->nama_kader, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-900 truncate">
                                                {{ $item->nama_kader }}
                                            </p>

                                            <p class="text-xs text-gray-500 truncate">
                                                Kader Fatayat Nahdlatul Ulama
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $item->jabatan ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        {{ $item->jenjang_kaderisasi }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="space-y-1">
                                        <p><span class="font-medium text-gray-900">PR:</span>
                                            {{ $item->pr->nama ?? '-' }}
                                        </p>
                                        <p><span class="font-medium text-gray-900">PAR:</span>
                                            {{ $item->par->nama ?? '-' }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($item->status === 'Pengurus')
                                        <span
                                            class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                                            🏛️ Pengurus
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            👤 Anggota
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2">

                                        <a href="{{ route('riwayat-kaderisasi.edit', $item->id) }}"
                                            class="inline-flex items-center justify-center rounded-xl border border-green-200 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-50 transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('riwayat-kaderisasi.destroy', $item->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin hapus data ini?')">

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
                                <td colspan="7" class="px-6 py-14 text-center">

                                    <div class="flex flex-col items-center justify-center gap-4 text-gray-400">

                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                            🎓
                                        </div>

                                        <div>
                                            <p class="font-medium text-gray-500">Belum ada data kaderisasi</p>
                                            <p class="text-sm text-gray-400 mt-1">
                                                Silakan tambahkan riwayat kaderisasi pertama untuk mulai
                                                mendokumentasikan perkembangan kader organisasi.
                                            </p>
                                        </div>

                                        <a href="{{ route('riwayat-kaderisasi.create') }}"
                                            class="inline-flex items-center rounded-2xl bg-green-700 px-4 py-2 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                                            + Tambah Riwayat
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
        @if ($riwayat->hasPages())
            <div class="flex justify-center">
                <div class="rounded-2xl bg-white border border-gray-200 shadow-sm px-4 py-3">
                    {{ $riwayat->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
