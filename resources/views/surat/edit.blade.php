<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Surat {{ $surat->jenis }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf
            @method('PUT')

            {{-- Header --}}
            <div class="border-b border-gray-100 pb-4">
                <h3 class="text-lg font-semibold text-gray-900">
                    Informasi Surat {{ $surat->jenis }}
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi surat sesuai data terbaru.
                </p>
            </div>

            {{-- Nomor Surat --}}
            <x-ui.input name="nomor_surat" label="Nomor Surat" :value="old('nomor_surat', $surat->nomor_surat)"
                placeholder="Contoh: 001/PAC-FN/VIII/2026" required />

            {{-- Tanggal --}}
            <x-ui.date-input name="tanggal" label="Tanggal {{ $surat->jenis == 'Masuk' ? 'Terima' : 'Kirim' }}"
                :value="old('tanggal', $surat->tanggal)" required />

            {{-- Pengirim / Tujuan --}}
            <x-ui.input name="pengirim_tujuan" label="{{ $surat->jenis == 'Masuk' ? 'Pengirim' : 'Tujuan' }}"
                :value="old('pengirim_tujuan', $surat->pengirim_tujuan)"
                placeholder="Masukkan {{ strtolower($surat->jenis == 'Masuk' ? 'pengirim' : 'tujuan') }} surat"
                required />

            {{-- Perihal --}}
            <x-ui.input name="perihal" label="Perihal" :value="old('perihal', $surat->perihal)" placeholder="Masukkan perihal surat"
                required />

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Jenis Surat --}}
                <div x-data="{
                    openJenis: false,
                    labelJenis: '{{ old('jenis_surat', $surat->jenis_surat) ?: '-- Pilih Jenis Surat --' }}'
                }" class="relative space-y-2">

                    <label class="block text-sm font-medium text-gray-700">
                        Jenis Surat
                    </label>

                    <input type="hidden" name="jenis_surat" value="{{ old('jenis_surat', $surat->jenis_surat) }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openJenis = !openJenis"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelJenis"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=jenis_surat]').value = ''; labelJenis = '-- Pilih Jenis Surat --'; openJenis = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                -- Pilih Jenis Surat --
                            </button>

                            @foreach ($jenisSuratList as $j)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=jenis_surat]').value = '{{ $j }}'; labelJenis = '{{ $j }}'; openJenis = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $j }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>

                    @error('jenis_surat')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Sifat Surat --}}
                <div x-data="{
                    openSifat: false,
                    labelSifat: '{{ old('sifat_surat', $surat->sifat_surat) ?: '-- Pilih Sifat Surat --' }}'
                }" class="relative space-y-2">

                    <label class="block text-sm font-medium text-gray-700">
                        Sifat Surat
                    </label>

                    <input type="hidden" name="sifat_surat" value="{{ old('sifat_surat', $surat->sifat_surat) }}">

                    <x-ui.dropdown width="56" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openSifat = !openSifat"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelSifat"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=sifat_surat]').value = ''; labelSifat = '-- Pilih Sifat Surat --'; openSifat = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                -- Pilih Sifat Surat --
                            </button>

                            @foreach ($sifatList as $s)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=sifat_surat]').value = '{{ $s }}'; labelSifat = '{{ $s }}'; openSifat = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $s }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>

                    @error('sifat_surat')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- File Surat --}}
            <div class="space-y-3">

                <label class="block text-sm font-medium text-gray-700">
                    File Surat
                </label>

                @if ($surat->file_surat)
                    <div
                        class="flex items-center justify-between rounded-2xl border border-green-100 bg-green-50 px-4 py-3">

                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-700">
                                📎
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    File surat saat ini tersedia
                                </p>
                                <a href="{{ Storage::url($surat->file_surat) }}" target="_blank"
                                    class="text-xs font-medium text-green-700 hover:text-green-800">
                                    Lihat file
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div
                    class="rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-6 text-center hover:border-green-300 hover:bg-green-50/40 transition">

                    <div class="flex flex-col items-center gap-3">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-700 text-xl">
                            📤
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700">
                                Unggah file baru
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Kosongkan jika tidak ingin mengganti file surat.
                            </p>
                        </div>

                        <input type="file" name="file_surat" accept="image/jpeg,image/png,application/pdf"
                            class="block w-full max-w-xs cursor-pointer rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 file:mr-3 file:rounded-lg file:border-0 file:bg-green-100 file:px-3 file:py-2 file:text-sm file:font-medium file:text-green-700 hover:file:bg-green-200">
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Keterangan
                </label>

                <textarea name="keterangan" rows="4"
                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition"
                    placeholder="Tambahkan catatan atau keterangan tambahan jika diperlukan...">{{ old('keterangan', $surat->keterangan) }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex flex-col gap-3 border-t border-gray-100 pt-4 sm:flex-row sm:justify-end">

                <a href="{{ route('surat.index', ['jenis' => $surat->jenis]) }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    💾 Update Surat
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
