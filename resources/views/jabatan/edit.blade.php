<x-app-layout>
    <x-slot name="header">
        Edit Jabatan
    </x-slot>

<div class="space-y-6 max-w-5xl mx-auto">

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
                    Edit Jabatan Pengurus
                </h1>

                <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                    Perbarui data <span class="font-semibold text-green-900">jabatan pengurus Fatayat NU</span>
                    beserta organisasi dan periode kepengurusannya.
                </p>
            </div>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit Jabatan</h2>
            <p class="text-sm text-gray-500 mt-1">
                Pastikan data jabatan dan organisasi sudah sesuai sebelum menyimpan perubahan.
            </p>
        </div>

        <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- PENGURUS --}}
            <div x-data="{
                pengurus_id: '{{ old('pengurus_id', $jabatan->pengurus_id) }}',
                pengurus_label: '{{ old('pengurus_id', $jabatan->pengurus_id)
                    ? optional($pengurus->firstWhere('id', old('pengurus_id', $jabatan->pengurus_id)))->nama_lengkap
                    : '-- Pilih Pengurus --' }}'
            }" class="space-y-2 relative">

                <label class="block text-sm font-medium text-gray-700">Pengurus</label>

                <input type="hidden" name="pengurus_id" :value="pengurus_id">

                <x-ui.dropdown width="full" align="left">

                    <x-slot name="trigger">
                        <button type="button"
                            class="w-full flex items-center justify-between rounded-3xl border border-green-200 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 hover:shadow-md transition">

                            <span class="flex items-center gap-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                <span x-text="pengurus_label"></span>
                            </span>

                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <button type="button" @click="pengurus_id=''; pengurus_label='-- Pilih Pengurus --'"
                            class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                            <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                            -- Pilih Pengurus --
                        </button>

                        @foreach ($pengurus as $p)
                            <button type="button"
                                @click="pengurus_id='{{ $p->id }}'; pengurus_label='{{ $p->nama_lengkap }}'"
                                class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                <div
                                    class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">
                                    {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                                </div>

                                {{ $p->nama_lengkap }}
                            </button>
                        @endforeach

                    </x-slot>

                </x-ui.dropdown>

                @error('pengurus_id')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- NAMA JABATAN --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jabatan</label>

                <input type="text" name="nama_jabatan" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}"
                    placeholder="Contoh: Ketua, Sekretaris Bidang Kaderisasi"
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                @error('nama_jabatan')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- ORGANISASI --}}
            <div class="border-t border-gray-100 pt-6 space-y-6">

                <div class="flex items-center gap-2">

                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        🏢
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Organisasi Tujuan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Pilih SATU organisasi tempat jabatan ini berlaku.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- PAC --}}
                    <div x-data="{
                        pac_id: '{{ old('pac_id', $jabatan->pac_id) }}',
                        pac_label: '{{ old('pac_id', $jabatan->pac_id)
                            ? optional($pac->firstWhere('id', old('pac_id', $jabatan->pac_id)))->nama
                            : '-- Tidak Dipilih --' }}'
                    }" class="space-y-2 relative">

                        <label class="block text-sm font-medium text-gray-700">PAC</label>

                        <input type="hidden" name="pac_id" :value="pac_id">

                        <x-ui.dropdown width="full" align="left">

                            <x-slot name="trigger">
                                <button type="button"
                                    class="w-full flex items-center justify-between rounded-3xl border border-green-200 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 hover:shadow-md transition">

                                    <span class="flex items-center gap-3">
                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        <span x-text="pac_label"></span>
                                    </span>

                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button" @click="pac_id=''; pac_label='-- Tidak Dipilih --'"
                                    class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                    -- Tidak Dipilih --
                                </button>

                                @foreach ($pac as $item)
                                    <button type="button"
                                        @click="pac_id='{{ $item->id }}'; pac_label='{{ $item->nama }}'"
                                        class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <div
                                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>

                                        {{ $item->nama }}
                                    </button>
                                @endforeach

                            </x-slot>

                        </x-ui.dropdown>
                    </div>

                    {{-- PR --}}
                    <div x-data="{
                        pr_id: '{{ old('pr_id', $jabatan->pr_id) }}',
                        pr_label: '{{ old('pr_id', $jabatan->pr_id)
                            ? optional($pr->firstWhere('id', old('pr_id', $jabatan->pr_id)))->nama
                            : '-- Tidak Dipilih --' }}'
                    }" class="space-y-2 relative">

                        <label class="block text-sm font-medium text-gray-700">PR</label>

                        <input type="hidden" name="pr_id" :value="pr_id">

                        <x-ui.dropdown width="full" align="left">

                            <x-slot name="trigger">
                                <button type="button"
                                    class="w-full flex items-center justify-between rounded-3xl border border-green-200 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 hover:shadow-md transition">

                                    <span class="flex items-center gap-3">
                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        <span x-text="pr_label"></span>
                                    </span>

                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button" @click="pr_id=''; pr_label='-- Tidak Dipilih --'"
                                    class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                    -- Tidak Dipilih --
                                </button>

                                @foreach ($pr as $item)
                                    <button type="button"
                                        @click="pr_id='{{ $item->id }}'; pr_label='{{ $item->nama }}'"
                                        class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <div
                                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>

                                        {{ $item->nama }}
                                    </button>
                                @endforeach

                            </x-slot>

                        </x-ui.dropdown>
                    </div>

                    {{-- PAR --}}
                    <div x-data="{
                        par_id: '{{ old('par_id', $jabatan->par_id) }}',
                        par_label: '{{ old('par_id', $jabatan->par_id)
                            ? optional($par->firstWhere('id', old('par_id', $jabatan->par_id)))->nama
                            : '-- Tidak Dipilih --' }}'
                    }" class="space-y-2 relative">

                        <label class="block text-sm font-medium text-gray-700">PAR</label>

                        <input type="hidden" name="par_id" :value="par_id">

                        <x-ui.dropdown width="full" align="left">

                            <x-slot name="trigger">
                                <button type="button"
                                    class="w-full flex items-center justify-between rounded-3xl border border-green-200 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 hover:shadow-md transition">

                                    <span class="flex items-center gap-3">
                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        <span x-text="par_label"></span>
                                    </span>

                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button" @click="par_id=''; par_label='-- Tidak Dipilih --'"
                                    class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                    -- Tidak Dipilih --
                                </button>

                                @foreach ($par as $item)
                                    <button type="button"
                                        @click="par_id='{{ $item->id }}'; par_label='{{ $item->nama }}'"
                                        class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <div
                                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>

                                        {{ $item->nama }}
                                    </button>
                                @endforeach

                            </x-slot>

                        </x-ui.dropdown>
                    </div>

                    {{-- LEMBAGA --}}
                    <div x-data="{
                        lembaga_id: '{{ old('lembaga_id', $jabatan->lembaga_id) }}',
                        lembaga_label: '{{ old('lembaga_id', $jabatan->lembaga_id)
                            ? optional($lembaga->firstWhere('id', old('lembaga_id', $jabatan->lembaga_id)))->nama_lembaga
                            : '-- Tidak Dipilih --' }}'
                    }" class="space-y-2 relative">

                        <label class="block text-sm font-medium text-gray-700">Lembaga</label>

                        <input type="hidden" name="lembaga_id" :value="lembaga_id">

                        <x-ui.dropdown width="full" align="left">

                            <x-slot name="trigger">
                                <button type="button"
                                    class="w-full flex items-center justify-between rounded-3xl border border-green-200 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 hover:shadow-md transition">

                                    <span class="flex items-center gap-3">
                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        <span x-text="lembaga_label"></span>
                                    </span>

                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button" @click="lembaga_id=''; lembaga_label='-- Tidak Dipilih --'"
                                    class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                    -- Tidak Dipilih --
                                </button>

                                @foreach ($lembaga as $item)
                                    <button type="button"
                                        @click="lembaga_id='{{ $item->id }}'; lembaga_label='{{ $item->nama_lembaga }}'"
                                        class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <div
                                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">
                                            {{ strtoupper(substr($item->nama_lembaga, 0, 1)) }}
                                        </div>

                                        {{ $item->nama_lembaga }}
                                    </button>
                                @endforeach

                            </x-slot>

                        </x-ui.dropdown>
                    </div>
                </div>
            </div>

            {{-- PERIODE & STATUS --}}
            <div class="border-t border-gray-100 pt-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode Mulai</label>

                        <input type="number" name="periode_mulai"
                            value="{{ old('periode_mulai', $jabatan->periode_mulai) }}" placeholder="2024"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                        @error('periode_mulai')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode Selesai</label>

                        <input type="number" name="periode_selesai"
                            value="{{ old('periode_selesai', $jabatan->periode_selesai) }}" placeholder="2027"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                        @error('periode_selesai')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{
                        status: '{{ old('status', $jabatan->status) }}',
                        statusLabel: '{{ old('status', $jabatan->status) ?: 'Pilih Status' }}'
                    }" class="space-y-2 relative">

                        <label class="block text-sm font-medium text-gray-700">Status Jabatan</label>

                        <input type="hidden" name="status" :value="status">

                        <x-ui.dropdown width="full" align="left">

                            <x-slot name="trigger">
                                <button type="button"
                                    class="w-full flex items-center justify-between rounded-3xl border border-green-200 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 hover:shadow-md transition">

                                    <span class="flex items-center gap-3">
                                        <span class="h-2.5 w-2.5 rounded-full"
                                            :class="status === 'Purna Tugas' ? 'bg-gray-500' : 'bg-green-500'"></span>

                                        <span x-text="statusLabel"></span>
                                    </span>

                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <button type="button" @click="status='Aktif'; statusLabel='Aktif'"
                                    class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    Aktif
                                </button>

                                <button type="button" @click="status='Purna Tugas'; statusLabel='Purna Tugas'"
                                    class="flex w-full items-center gap-3 rounded-2xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-gray-500"></span>
                                    Purna Tugas
                                </button>

                            </x-slot>

                        </x-ui.dropdown>

                        @error('status')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div
                class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                <a href="{{ route('jabatan.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                    💾 Perbarui Jabatan
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>