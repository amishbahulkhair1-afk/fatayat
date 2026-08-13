<x-app-layout>
    <x-slot name="header">
        Tambah Anggota
    </x-slot>

    <div class="space-y-6 max-w-5xl mx-auto">

        {{-- BANNER --}}
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex items-start gap-3">

                <div
                    class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                    👤
                </div>

                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Tambah Anggota Baru
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Tambahkan data <span class="font-semibold text-green-900">anggota Fatayat NU</span>
                        beserta informasi pribadi dan keanggotaan organisasi.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Tambah Anggota</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Lengkapi informasi anggota dengan benar sebelum menyimpan data.
                </p>
            </div>

            <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-8">
                @csrf

                {{-- A. DATA PRIBADI --}}
                <div class="border border-gray-100 rounded-3xl p-5 space-y-5">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            👤
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">A. Data Pribadi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Informasi identitas dasar anggota.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                placeholder="Nama lengkap anggota"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                            @error('nama_lengkap')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tempat Lahir
                            </label>

                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                placeholder="Kota / Kabupaten lahir"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Lahir
                            </label>

                            <x-ui.date-input name="tanggal_lahir" :value="old('tanggal_lahir')" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                No. Telepon
                            </label>

                            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Lengkap
                            </label>

                            <textarea name="alamat_lengkap" rows="4" placeholder="Alamat domisili lengkap anggota..."
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('alamat_lengkap') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pekerjaan
                            </label>

                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                placeholder="Pekerjaan utama anggota"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                            @error('email')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- B. DATA KEANGGOTAAN --}}
                <div class="border border-gray-100 rounded-3xl p-5 space-y-5">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🏘️
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">B. Data Keanggotaan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Informasi wilayah dan status keanggotaan organisasi.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- PAC hanya untuk selain admin_par --}}
                        @if (auth()->user()->role !== 'admin_par')

                            <div x-data="{
                                open: false,
                                pacId: '{{ old('pac_id') }}',
                                labelPac: '{{ old('pac_id') ? optional($pac->firstWhere('id', old('pac_id')))->nama : '-- Tidak Ada --' }}'
                            }" class="relative">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    PAC (opsional)
                                </label>

                                <input type="hidden" name="pac_id" x-model="pacId">

                                <x-ui.dropdown width="64" align="left">

                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">

                                            <span class="truncate" x-text="labelPac"></span>

                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">

                                        <button type="button" @click="pacId = ''; labelPac = '-- Tidak Ada --'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                            <span class="h-2.5 w-2.5 rounded-full bg-gray-300"></span>
                                            -- Tidak Ada --
                                        </button>

                                        @foreach ($pac as $item)
                                            <button type="button"
                                                @click="pacId = '{{ $item->id }}'; labelPac = '{{ $item->nama }}'"
                                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                                {{ $item->nama }}
                                            </button>
                                        @endforeach

                                    </x-slot>
                                </x-ui.dropdown>
                            </div>

                            <div x-data="{
                                open: false,
                                prId: '{{ old('pr_id') }}',
                                labelPr: '{{ old('pr_id') ? optional($pr->firstWhere('id', old('pr_id')))->nama : '-- Pilih PR --' }}'
                            }" class="relative">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih PR Asal
                                </label>

                                <input type="hidden" name="pr_id" x-model="prId">

                                <x-ui.dropdown width="64" align="left">

                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">

                                            <span class="truncate" x-text="labelPr"></span>

                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">

                                        <button type="button" @click="prId = ''; labelPr = '-- Pilih PR --'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                            <span class="h-2.5 w-2.5 rounded-full bg-gray-300"></span>
                                            -- Pilih PR --
                                        </button>

                                        @foreach ($pr as $item)
                                            <button type="button"
                                                @click="prId = '{{ $item->id }}'; labelPr = '{{ $item->nama }}'"
                                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                                {{ $item->nama }}
                                            </button>
                                        @endforeach

                                    </x-slot>
                                </x-ui.dropdown>
                            </div>

                        @endif

                        {{-- PAR --}}
                        @if (auth()->user()->role === 'admin_par')

                            <input type="hidden" name="par_id" value="{{ $par->first()->id }}">

                            <div class="md:col-span-2 rounded-2xl border border-green-200 bg-green-50 px-4 py-3">
                                <p class="text-sm text-green-800">
                                    Wilayah PAR:
                                    <span class="font-semibold text-green-900">{{ $par->first()->nama }}</span>
                                </p>
                            </div>
                        @else
                            <div x-data="{
                                open: false,
                                parId: '{{ old('par_id') }}',
                                labelPar: '{{ old('par_id') ? optional($par->firstWhere('id', old('par_id')))->nama : '-- Pilih PAR --' }}'
                            }" class="relative">

                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih PAR Asal
                                </label>

                                <input type="hidden" name="par_id" x-model="parId">

                                <x-ui.dropdown width="64" align="left">

                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">

                                            <span class="truncate" x-text="labelPar"></span>

                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">

                                        <button type="button" @click="parId = ''; labelPar = '-- Pilih PAR --'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                            <span class="h-2.5 w-2.5 rounded-full bg-gray-300"></span>
                                            -- Pilih PAR --
                                        </button>

                                        @foreach ($par as $item)
                                            <button type="button"
                                                @click="parId = '{{ $item->id }}'; labelPar = '{{ $item->nama }}'"
                                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                                {{ $item->nama }}
                                            </button>
                                        @endforeach

                                    </x-slot>
                                </x-ui.dropdown>
                            </div>

                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Bergabung
                            </label>

                            <x-ui.date-input name="tanggal_bergabung" :value="old('tanggal_bergabung')" />

                            @error('tanggal_bergabung')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{
                            open: false,
                            statusAnggota: '{{ old('status_anggota') }}',
                            labelStatus: '{{ old('status_anggota') ?: '-- Pilih Status --' }}'
                        }" class="relative">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Anggota
                            </label>

                            <input type="hidden" name="status_anggota" x-model="statusAnggota">

                            <x-ui.dropdown width="64" align="left">

                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">

                                        <span class="flex items-center gap-2 truncate">

                                            <span class="h-2.5 w-2.5 rounded-full"
                                                :class="{
                                                    'bg-green-500': statusAnggota === 'Aktif',
                                                    'bg-red-500': statusAnggota === 'Tidak Aktif',
                                                    'bg-gray-300': !statusAnggota
                                                }"></span>

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

                                    <button type="button" @click="statusAnggota = 'Aktif'; labelStatus = 'Aktif'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        Aktif
                                    </button>

                                    <button type="button"
                                        @click="statusAnggota = 'Tidak Aktif'; labelStatus = 'Tidak Aktif'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                                        Tidak Aktif
                                    </button>

                                </x-slot>
                            </x-ui.dropdown>

                            @error('status_anggota')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                No. KTA / NIK
                            </label>

                            <input type="text" name="no_kta" value="{{ old('no_kta') }}"
                                placeholder="Nomor KTA atau NIK anggota"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                            @error('no_kta')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Foto Kader
                            </label>

                            <div
                                class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-4 py-5 text-center hover:border-green-300 hover:bg-green-50/40 transition">

                                <input type="file" name="foto_kader" accept="image/jpeg,image/png"
                                    class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-xl file:border-0 file:bg-green-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-green-700 hover:file:bg-green-200">

                                <p class="text-xs text-gray-500 mt-2">
                                    Format JPG atau PNG dengan ukuran maksimal sesuai ketentuan server.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- C. DATA TAMBAHAN --}}
                <div class="border border-gray-100 rounded-3xl p-5 space-y-5">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            📚
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">C. Data Tambahan (Opsional)</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Informasi pendidikan dan keterampilan anggota.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Riwayat Pendidikan
                            </label>

                            <textarea name="riwayat_pendidikan" rows="5"
                                placeholder="Tuliskan riwayat pendidikan formal maupun nonformal..."
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('riwayat_pendidikan') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Keterampilan / Pekerjaan
                            </label>

                            <textarea name="keterampilan_pekerjaan" rows="5"
                                placeholder="Tuliskan keterampilan, usaha, atau kemampuan khusus yang dimiliki anggota..."
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('keterampilan_pekerjaan') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a href="{{ route('anggota.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        💾 Simpan Anggota
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>