
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Kaderisasi
        </h2>
    </x-slot>

    <div class="space-y-6 max-w-5xl mx-auto py-6">

        {{-- BANNER --}}
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex items-start gap-3">

                <div
                    class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                    ✏️
                </div>

                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Edit Riwayat Kaderisasi
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Perbarui data <span class="font-semibold text-green-900">riwayat kaderisasi dan status kader</span>
                        agar informasi pengkaderan tetap akurat dan terdokumentasi dengan baik.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Edit Riwayat Kaderisasi</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Pastikan data kader, jenjang kaderisasi, dan dokumen pendukung sudah sesuai sebelum menyimpan perubahan.
                </p>
            </div>

            <form action="{{ route('riwayat-kaderisasi.update', $riwayat->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 space-y-6">

                @csrf
                @method('PUT')

                {{-- KADER --}}
                <div class="border-b border-gray-100 pb-6">

                    <div class="flex items-center gap-2 mb-4">

                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            👥
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Data Kader</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Pilih salah satu sumber data kader, yaitu pengurus atau anggota.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- PENGURUS --}}
                        <div x-data="{ open: false, selected: '{{ optional($pengurus->firstWhere('id', old('pengurus_id', $riwayat->pengurus_id)))->nama_lengkap ?? '-- Tidak Dipilih --' }}' }">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pengurus
                            </label>

                            <input type="hidden" name="pengurus_id"
                                :value="selected === '-- Tidak Dipilih --' ? '' : '{{ old('pengurus_id', $riwayat->pengurus_id) }}'">

                            <x-ui.dropdown width="64" align="left">

                                <x-slot name="trigger">

                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-400 focus:outline-none focus:ring-4 focus:ring-green-100 transition">

                                        <span class="truncate" x-text="selected"></span>

                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">

                                    <button type="button" @click="selected = '-- Tidak Dipilih --'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        -- Tidak Dipilih --
                                    </button>

                                    @foreach ($pengurus as $p)
                                        <button type="button" @click="selected = '{{ $p->nama_lengkap }}'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                            {{ $p->nama_lengkap }}
                                        </button>
                                    @endforeach

                                </x-slot>
                            </x-ui.dropdown>
                        </div>

                        {{-- ANGGOTA --}}
                        <div x-data="{ open: false, selected: '{{ optional($anggota->firstWhere('id', old('anggota_id', $riwayat->anggota_id)))->nama_lengkap ?? '-- Tidak Dipilih --' }}' }">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Anggota
                            </label>

                            <input type="hidden" name="anggota_id"
                                :value="selected === '-- Tidak Dipilih --' ? '' : '{{ old('anggota_id', $riwayat->anggota_id) }}'">

                            <x-ui.dropdown width="64" align="left">

                                <x-slot name="trigger">

                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-400 focus:outline-none focus:ring-4 focus:ring-green-100 transition">

                                        <span class="truncate" x-text="selected"></span>

                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">

                                    <button type="button" @click="selected = '-- Tidak Dipilih --'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        -- Tidak Dipilih --
                                    </button>

                                    @foreach ($anggota as $a)
                                        <button type="button" @click="selected = '{{ $a->nama_lengkap }}'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                            {{ $a->nama_lengkap }}
                                        </button>
                                    @endforeach

                                </x-slot>
                            </x-ui.dropdown>

                            @error('pengurus_id')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- INFORMASI ORGANISASI --}}
                <div class="border-b border-gray-100 pb-6">

                    <div class="flex items-center gap-2 mb-4">

                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🏢
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Informasi Organisasi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Lengkapi jabatan kader dan asal wilayah organisasi.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jabatan
                            </label>

                            <x-ui.input type="text" name="jabatan"
                                value="{{ old('jabatan', $riwayat->jabatan) }}"
                                placeholder="Contoh: Ketua PAC, Sekretaris Bidang Kaderisasi" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- PR --}}
                            <div x-data="{ open: false, selected: '{{ optional($pr->firstWhere('id', old('pr_id', $riwayat->pr_id)))->nama ?? '-- Pilih PR --' }}' }">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Asal PR
                                </label>

                                <input type="hidden" name="pr_id"
                                    :value="selected === '-- Pilih PR --' ? '' : '{{ old('pr_id', $riwayat->pr_id) }}'">

                                <x-ui.dropdown width="64" align="left">

                                    <x-slot name="trigger">

                                        <button type="button"
                                            class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-400 focus:outline-none focus:ring-4 focus:ring-green-100 transition">

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

                                            -- Pilih PR --
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

                            {{-- PAR --}}
                            <div x-data="{ open: false, selected: '{{ optional($par->firstWhere('id', old('par_id', $riwayat->par_id)))->nama ?? '-- Pilih PAR --' }}' }">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Asal PAR
                                </label>

                                <input type="hidden" name="par_id"
                                    :value="selected === '-- Pilih PAR --' ? '' : '{{ old('par_id', $riwayat->par_id) }}'">

                                <x-ui.dropdown width="64" align="left">

                                    <x-slot name="trigger">

                                        <button type="button"
                                            class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-400 focus:outline-none focus:ring-4 focus:ring-green-100 transition">

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

                                            -- Pilih PAR --
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
                </div>

                {{-- INFORMASI KADERISASI --}}
                <div class="border-b border-gray-100 pb-6">

                    <div class="flex items-center gap-2 mb-4">

                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🎓
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Informasi Kaderisasi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Tentukan penyelenggara, jenjang, dan lokasi kegiatan kaderisasi.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Penyelenggara
                                </label>

                                <x-ui.input type="text" name="penyelenggara"
                                    value="{{ old('penyelenggara', $riwayat->penyelenggara) }}"
                                    placeholder="Contoh: PAC Pragaan, PC Fatayat NU Sumenep" />
                            </div>

                            {{-- JENJANG --}}
                            <div x-data="{ open: false, selected: '{{ old('jenjang_kaderisasi', $riwayat->jenjang_kaderisasi) ?: '-- Pilih Jenjang --' }}' }">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenjang Kaderisasi
                                </label>

                                <input type="hidden" name="jenjang_kaderisasi"
                                    :value="selected === '-- Pilih Jenjang --' ? '' : selected">

                                <x-ui.dropdown width="64" align="left">

                                    <x-slot name="trigger">

                                        <button type="button"
                                            class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm hover:border-green-400 focus:outline-none focus:ring-4 focus:ring-green-100 transition">

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

                                            -- Pilih Jenjang --
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
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi
                            </label>

                            <x-ui.input type="text" name="lokasi"
                                value="{{ old('lokasi', $riwayat->lokasi) }}"
                                placeholder="Contoh: Sumenep, Pamekasan, Surabaya" />
                        </div>
                    </div>
                </div>

                {{-- WAKTU --}}
                <div class="border-b border-gray-100 pb-6">

                    <div class="flex items-center gap-2 mb-4">

                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            📅
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Waktu Pelaksanaan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Tentukan tanggal mulai dan selesai kegiatan kaderisasi.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Mulai
                            </label>

                            <x-ui.date-input name="tanggal_mulai"
                                value="{{ old('tanggal_mulai', $riwayat->tanggal_mulai) }}" />

                            @error('tanggal_mulai')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Selesai
                            </label>

                            <x-ui.date-input name="tanggal_selesai"
                                value="{{ old('tanggal_selesai', $riwayat->tanggal_selesai) }}" />

                            @error('tanggal_selesai')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- DOKUMEN --}}
                <div>

                    <div class="flex items-center gap-2 mb-4">

                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            📄
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Dokumen & Sertifikat</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Lengkapi nomor sertifikat, tahun pelaksanaan, dan unggah dokumen pendukung bila diperlukan.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                No. Sertifikat
                            </label>

                            <x-ui.input type="text" name="no_sertifikat"
                                value="{{ old('no_sertifikat', $riwayat->no_sertifikat) }}"
                                placeholder="Masukkan nomor sertifikat" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun
                            </label>

                            <x-ui.input type="number" name="tahun"
                                value="{{ old('tahun', $riwayat->tahun) }}" placeholder="2025" />
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Sertifikat
                        </label>

                        @if ($riwayat->upload_sertifikat)
                            <a href="{{ Storage::url($riwayat->upload_sertifikat) }}" target="_blank"
                                class="inline-flex items-center text-sm font-medium text-green-700 hover:text-green-800 mb-3">
                                📄 Lihat sertifikat saat ini
                            </a>
                        @endif

                        <div
                            class="rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50/60 p-4 hover:border-green-400 hover:bg-green-50/40 transition">

                            <input type="file" name="upload_sertifikat"
                                accept="image/jpeg,image/png,application/pdf"
                                class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-xl file:border-0 file:bg-green-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-green-700 hover:file:bg-green-200">

                            <p class="text-xs text-gray-500 mt-2">
                                Format yang didukung: JPG, PNG, atau PDF.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a href="{{ route('riwayat-kaderisasi.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        💾 Perbarui Riwayat
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>