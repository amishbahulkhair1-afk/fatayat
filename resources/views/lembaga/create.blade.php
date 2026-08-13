<x-app-layout>
    <x-slot name="header">
        Tambah Lembaga
    </x-slot>
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- BANNER -->
    <div
        class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

        <div class="flex items-start gap-3">

            <div
                class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                ➕
            </div>

            <div class="min-w-0">
                <h1 class="text-base font-semibold text-green-900 leading-tight">
                    Tambah Lembaga
                </h1>

                <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                    Tambahkan data <span class="font-semibold text-green-900">Lembaga Nahdlatul Ulama</span>
                    beserta informasi ketua, status organisasi, dan bidang kegiatan lembaga.
                </p>
            </div>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Tambah Lembaga</h2>
            <p class="text-sm text-gray-500 mt-1">
                Lengkapi informasi lembaga dengan benar sebelum menyimpan data.
            </p>
        </div>

        <form action="{{ route('lembaga.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- PAC -->
            <div x-data="{
                pacId: '{{ old('pac_id') }}',
                namaPac: '{{ old('pac_id') ? optional($pac->firstWhere('id', old('pac_id')))->nama : 'Pilih PAC' }}'
            }">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    PAC Induk
                </label>

                <input type="hidden" name="pac_id" :value="pacId">

                <x-ui.dropdown width="72" align="left">

                    <x-slot name="trigger">
                        <button type="button"
                            class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                            <span x-text="namaPac"></span>

                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="max-h-64 overflow-y-auto">

                            @foreach ($pac as $item)
                                <button type="button"
                                    @click="
                                        pacId = '{{ $item->id }}';
                                        namaPac = '{{ $item->nama }}';
                                    "
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <div
                                        class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </div>

                                    <span class="text-left">{{ $item->nama }}</span>
                                </button>
                            @endforeach

                        </div>
                    </x-slot>
                </x-ui.dropdown>

                @error('pac_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- INFORMASI UTAMA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lembaga
                    </label>

                    <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga') }}"
                        placeholder="Contoh: Lembaga Kesehatan NU"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                    @error('nama_lembaga')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Singkatan
                    </label>

                    <input type="text" name="singkatan" value="{{ old('singkatan') }}" placeholder="Contoh: LKNU"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                </div>
            </div>

            <!-- TANGGAL & STATUS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <x-ui.date-input name="tanggal_dibentuk" label="Tanggal Dibentuk" />

                <div x-data="{
                    status: '{{ old('status', 'Aktif') }}',
                    labelStatus: '{{ old('status', 'Aktif') }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status Organisasi
                    </label>

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

                            <button type="button" @click="status = 'Aktif'; labelStatus = 'Aktif'"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                Aktif
                            </button>

                            <button type="button" @click="status = 'Persiapan'; labelStatus = 'Persiapan'"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-yellow-500"></span>
                                Persiapan
                            </button>

                            <button type="button" @click="status = 'Vakum'; labelStatus = 'Vakum'"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-orange-500"></span>
                                Vakum
                            </button>

                            <button type="button" @click="status = 'Tidak Aktif'; labelStatus = 'Tidak Aktif'"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                                Tidak Aktif
                            </button>

                        </x-slot>
                    </x-ui.dropdown>
                </div>
            </div>

            <!-- KETUA LEMBAGA -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        👤
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Ketua Lembaga</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Pilih pengurus yang menjabat sebagai ketua lembaga.</p>
                    </div>
                </div>

                <div x-data="{
                    ketua: '{{ old('ketua_id') }}',
                    namaKetua: '{{ old('ketua_id')
                        ? optional($pengurus->firstWhere('id', old('ketua_id')))->nama_lengkap
                        : 'Pilih Ketua Lembaga' }}'
                }">

                    <input type="hidden" name="ketua_id" :value="ketua">

                    <x-ui.dropdown width="72" align="left">

                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="namaKetua"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="max-h-64 overflow-y-auto">

                                @foreach ($pengurus as $p)
                                    <button type="button"
                                        @click="
                                            ketua = '{{ $p->id }}';
                                            namaKetua = '{{ $p->nama_lengkap }}';
                                        "
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <div
                                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">
                                            {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                                        </div>

                                        <span class="text-left">{{ $p->nama_lengkap }}</span>
                                    </button>
                                @endforeach

                            </div>
                        </x-slot>
                    </x-ui.dropdown>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        📝
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Deskripsi / Bidang Kegiatan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Tambahkan bidang kegiatan atau deskripsi singkat
                            lembaga.</p>
                    </div>
                </div>

                <textarea name="deskripsi" rows="5" placeholder="Deskripsi singkat atau bidang kegiatan lembaga..."
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- KONTAK -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        📞
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Kontak Lembaga</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Tambahkan nomor telepon atau kontak yang dapat
                            dihubungi.</p>
                    </div>
                </div>

                <input type="text" name="kontak" value="{{ old('kontak') }}" placeholder="08xxxxxxxxxx"
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
            </div>

            <!-- ACTION BUTTONS -->
            <div
                class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                <a href="{{ route('lembaga.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                    💾 Simpan Lembaga
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
