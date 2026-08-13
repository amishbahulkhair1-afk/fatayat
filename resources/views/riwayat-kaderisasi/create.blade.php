<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Kaderisasi</h2>
    </x-slot>

    <div class="space-y-6 max-w-4xl mx-auto py-6">

        <!-- BANNER -->
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex items-start gap-3">

                <div
                    class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                    🎓
                </div>

                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Tambah Riwayat Kaderisasi
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Catat riwayat <span class="font-semibold text-green-900">kaderisasi pengurus atau anggota</span>
                        untuk mendukung pendataan jenjang kaderisasi organisasi Fatayat NU.
                    </p>
                </div>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Riwayat Kaderisasi</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Pilih salah satu kader (pengurus atau anggota), kemudian lengkapi informasi kaderisasi yang pernah
                    diikuti.
                </p>
            </div>

            <form action="{{ route('riwayat-kaderisasi.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf

                <!-- PESERTA -->
                <div x-data="{
                    pengurusSelected: '{{ old('pengurus_id') ? $pengurus->firstWhere('id', old('pengurus_id'))->nama_lengkap ?? '' : '' }}',
                    anggotaSelected: '{{ old('anggota_id') ? $anggota->firstWhere('id', old('anggota_id'))->nama_lengkap ?? '' : '' }}'
                }" class="border border-gray-100 rounded-3xl p-5 bg-gray-50/50 space-y-5">

                    <div class="flex items-start gap-3">
                        <div
                            class="h-9 w-9 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-sm flex-shrink-0">
                            👤
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Peserta Kaderisasi</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                Pilih <span class="font-medium text-gray-700">salah satu</span>: pengurus atau anggota.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- DROPDOWN PENGURUS -->
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pengurus</label>

                            <input type="hidden" name="pengurus_id"
                                :value="pengurusSelected !== '' ?
                                    '{{ old('pengurus_id') }}' : ''">

                            <x-ui.dropdown width="full" align="left">
                                <x-slot name="trigger">
                                    <button type="button" :disabled="anggotaSelected !== ''"
                                        :class="anggotaSelected !== ''
                                            ?
                                            'w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm text-gray-400 cursor-not-allowed' :
                                            'w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-300 focus:outline-none focus:ring-4 focus:ring-green-100 transition'">

                                        <span class="truncate"
                                            x-text="pengurusSelected || '-- Pilih Pengurus --'"></span>

                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button" @click="pengurusSelected = ''"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        -- Tidak Dipilih --
                                    </button>

                                    @foreach ($pengurus as $p)
                                        <button type="button"
                                            @click="pengurusSelected = '{{ $p->nama_lengkap }}'; anggotaSelected = ''"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            {{ $p->nama_lengkap }}
                                        </button>
                                    @endforeach
                                </x-slot>
                            </x-ui.dropdown>
                        </div>

                        <!-- DROPDOWN ANGGOTA -->
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Anggota</label>

                            <input type="hidden" name="anggota_id"
                                :value="anggotaSelected !== '' ?
                                    '{{ old('anggota_id') }}' : ''">

                            <x-ui.dropdown width="full" align="left">
                                <x-slot name="trigger">
                                    <button type="button" :disabled="pengurusSelected !== ''"
                                        :class="pengurusSelected !== ''
                                            ?
                                            'w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm text-gray-400 cursor-not-allowed' :
                                            'w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-300 focus:outline-none focus:ring-4 focus:ring-green-100 transition'">

                                        <span class="truncate" x-text="anggotaSelected || '-- Pilih Anggota --'"></span>

                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button" @click="anggotaSelected = ''"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        -- Tidak Dipilih --
                                    </button>

                                    @foreach ($anggota as $a)
                                        <button type="button"
                                            @click="anggotaSelected = '{{ $a->nama_lengkap }}'; pengurusSelected = ''"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            {{ $a->nama_lengkap }}
                                        </button>
                                    @endforeach
                                </x-slot>
                            </x-ui.dropdown>
                        </div>

                    </div>
                </div>

                <!-- INFORMASI KADERISASI -->
                <div class="border border-gray-100 rounded-3xl p-5 bg-gray-50/50 space-y-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-9 w-9 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-sm flex-shrink-0">
                            📚
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Informasi Kaderisasi</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                Lengkapi data kegiatan kaderisasi yang pernah diikuti.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <x-ui.input name="jabatan" :value="old('jabatan')"
                                placeholder="Jabatan saat mengikuti kaderisasi" />
                        </div>

                        <div x-data="{ open: false, selected: '{{ old('jenjang_kaderisasi', '-- Pilih Jenjang --') }}' }" class="relative">

                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenjang Kaderisasi</label>

                            <input type="hidden" name="jenjang_kaderisasi"
                                :value="selected !== '-- Pilih Jenjang --' ? selected : ''">

                            <x-ui.dropdown width="full" align="left">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-300 focus:outline-none focus:ring-4 focus:ring-green-100 transition">
                                        <span class="truncate" x-text="selected"></span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button" @click="selected = '-- Pilih Jenjang --'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        -- Tidak Dipilih --
                                    </button>

                                    @foreach ($jenjangList as $j)
                                        <button type="button" @click="selected = '{{ $j }}'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            {{ $j }}
                                        </button>
                                    @endforeach
                                </x-slot>
                            </x-ui.dropdown>

                            @error('jenjang_kaderisasi')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Penyelenggara</label>
                            <x-ui.input name="penyelenggara" :value="old('penyelenggara')"
                                placeholder="Contoh: PAC Fatayat NU Pragaan" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <x-ui.input name="lokasi" :value="old('lokasi')" placeholder="Lokasi kegiatan kaderisasi" />
                        </div>
                    </div>
                </div>

                <!-- WILAYAH ASAL -->
                <div class="border border-gray-100 rounded-3xl p-5 bg-gray-50/50 space-y-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-9 w-9 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-sm flex-shrink-0">
                            🗺️
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Wilayah Asal</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                Pilih PR dan PAR asal kader yang mengikuti kegiatan kaderisasi.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div x-data="{ open: false, selected: '{{ old('pr_id') ? $pr->firstWhere('id', old('pr_id'))->nama ?? '-- Pilih PR --' : '-- Pilih PR --' }}' }" class="relative">

                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal PR</label>

                            <input type="hidden" name="pr_id"
                                :value="selected !== '-- Pilih PR --' ? selected : ''">

                            <x-ui.dropdown width="full" align="left">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-300 focus:outline-none focus:ring-4 focus:ring-green-100 transition">
                                        <span class="truncate" x-text="selected"></span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button" @click="selected = '-- Pilih PR --'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        -- Tidak Dipilih --
                                    </button>

                                    @foreach ($pr as $item)
                                        <button type="button" @click="selected = '{{ $item->nama }}'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            {{ $item->nama }}
                                        </button>
                                    @endforeach
                                </x-slot>
                            </x-ui.dropdown>
                        </div>

                        <div x-data="{ open: false, selected: '{{ old('par_id') ? $par->firstWhere('id', old('par_id'))->nama ?? '-- Pilih PAR --' : '-- Pilih PAR --' }}' }" class="relative">

                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal PAR</label>

                            <input type="hidden" name="par_id"
                                :value="selected !== '-- Pilih PAR --' ? selected : ''">

                            <x-ui.dropdown width="full" align="left">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-300 focus:outline-none focus:ring-4 focus:ring-green-100 transition">
                                        <span class="truncate" x-text="selected"></span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button" @click="selected = '-- Pilih PAR --'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        -- Tidak Dipilih --
                                    </button>

                                    @foreach ($par as $item)
                                        <button type="button" @click="selected = '{{ $item->nama }}'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            {{ $item->nama }}
                                        </button>
                                    @endforeach
                                </x-slot>
                            </x-ui.dropdown>
                        </div>
                    </div>
                </div>

                <!-- WAKTU & SERTIFIKAT -->
                <div class="border border-gray-100 rounded-3xl p-5 bg-gray-50/50 space-y-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-9 w-9 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-sm flex-shrink-0">
                            📅
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Waktu &amp; Sertifikat</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                Isi tanggal pelaksanaan, informasi sertifikat, dan unggah dokumen pendukung jika
                                tersedia.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <x-ui.date-input name="tanggal_mulai" :value="old('tanggal_mulai')" />

                            @error('tanggal_mulai')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                            <x-ui.date-input name="tanggal_selesai" :value="old('tanggal_selesai')" />

                            @error('tanggal_selesai')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Sertifikat</label>
                            <x-ui.input name="no_sertifikat" :value="old('no_sertifikat')"
                                placeholder="Nomor sertifikat (opsional)" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                            <x-ui.input type="number" name="tahun" :value="old('tahun')" placeholder="Contoh: 2025" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Sertifikat</label>

                        <div
                            class="rounded-2xl border border-dashed border-gray-300 bg-white px-4 py-5 text-center hover:border-green-300 transition">

                            <div
                                class="mx-auto mb-3 h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-xl">
                                📄
                            </div>

                            <p class="text-sm font-medium text-gray-700">Pilih file sertifikat</p>

                            <p class="text-xs text-gray-500 mt-1">
                                Format yang didukung: JPG, PNG, atau PDF.
                            </p>

                            <input type="file" name="upload_sertifikat"
                                accept="image/jpeg,image/png,application/pdf"
                                class="mt-4 block w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-green-700 hover:file:bg-green-100">
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div
                    class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a href="{{ route('riwayat-kaderisasi.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        💾 Simpan Riwayat
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
