<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Kegiatan</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('kegiatan.store') }}" method="POST"
            class="bg-white rounded-3xl border border-gray-200 shadow-xl shadow-gray-100 overflow-hidden">
            @csrf

            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-green-50 to-emerald-50">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Kegiatan</h3>
                <p class="text-sm text-gray-600 mt-1">
                    Lengkapi data kegiatan untuk kebutuhan absensi dan monitoring PAC.
                </p>
            </div>

            <div class="p-6 space-y-6">

                {{-- Nama Kegiatan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan</label>

                    <x-ui.input type="text" name="nama_kegiatan" :value="old('nama_kegiatan')"
                        placeholder="Contoh: Rapat Koordinasi PAC Pragaan" />

                    @error('nama_kegiatan')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis Kegiatan --}}
                <div x-data="{
                    jenis: '{{ old('jenis_kegiatan') }}',
                    labelJenis: '{{ old('jenis_kegiatan') ?: '-- Pilih Jenis Kegiatan --' }}'
                }">

                    <input type="hidden" name="jenis_kegiatan" :value="jenis">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kegiatan</label>

                    <x-ui.dropdown width="full" align="left">
                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-400 hover:shadow-md transition">

                                <span x-text="labelJenis"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            @foreach ($jenisList as $j)
                                <x-ui.dropdown-item type="button"
                                    @click="jenis = '{{ $j }}'; labelJenis = '{{ $j }}'">
                                    {{ $j }}
                                </x-ui.dropdown-item>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>

                    @error('jenis_kegiatan')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal & Waktu --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kegiatan</label>

                        <x-ui.date-input name="tanggal_kegiatan" :value="old('tanggal_kegiatan')" />

                        @error('tanggal_kegiatan')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>

                        <x-ui.time-input name="jam_mulai" label="Jam Mulai" :value="old('jam_mulai')" />

                        @error('jam_mulai')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>

                        <x-ui.time-input name="jam_selesai" label="Jam Selesai" :value="old('jam_selesai')" />

                        @error('jam_selesai')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kegiatan</label>

                    <x-ui.input type="text" name="lokasi_kegiatan" :value="old('lokasi_kegiatan')"
                        placeholder="Contoh: Aula PAC Pragaan" />
                </div>

                {{-- Lembaga --}}
                <div x-data="{
                    lembaga: '{{ old('lembaga_id') }}',
                    labelLembaga: '{{ old('lembaga_id') ? optional($lembaga->firstWhere('id', old('lembaga_id')))->nama_lembaga : '-- Tidak Terkait Lembaga --' }}'
                }">

                    <input type="hidden" name="lembaga_id" :value="lembaga">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Lembaga (Opsional)</label>

                    <x-ui.dropdown width="full" align="left">
                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-400 hover:shadow-md transition">

                                <span x-text="labelLembaga"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-ui.dropdown-item type="button"
                                @click="lembaga = ''; labelLembaga = '-- Tidak Terkait Lembaga --'">
                                -- Tidak Terkait Lembaga --
                            </x-ui.dropdown-item>

                            @foreach ($lembaga as $l)
                                <x-ui.dropdown-item type="button"
                                    @click="lembaga = '{{ $l->id }}'; labelLembaga = '{{ $l->nama_lembaga }}'">
                                    {{ $l->nama_lembaga }}
                                </x-ui.dropdown-item>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Penanggung Jawab --}}
                <div x-data="{
                    pj: '{{ old('penanggung_jawab_id') }}',
                    labelPj: '{{ old('penanggung_jawab_id') ? optional($pengurus->firstWhere('id', old('penanggung_jawab_id')))->nama_lengkap : '-- Pilih Penanggung Jawab --' }}'
                }">

                    <input type="hidden" name="penanggung_jawab_id" :value="pj">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>

                    <x-ui.dropdown width="full" align="left">
                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-400 hover:shadow-md transition">

                                <span x-text="labelPj"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            @foreach ($pengurus as $p)
                                <x-ui.dropdown-item type="button"
                                    @click="pj = '{{ $p->id }}'; labelPj = '{{ $p->nama_lengkap }}'">
                                    {{ $p->nama_lengkap }}
                                </x-ui.dropdown-item>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Kegiatan</label>

                    <x-ui.textarea name="deskripsi_kegiatan" rows="4"
                        placeholder="Tuliskan tujuan, agenda, atau informasi tambahan kegiatan...">{{ old('deskripsi_kegiatan') }}</x-ui.textarea>
                </div>

                {{-- Pengaturan Peserta --}}
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 space-y-4">

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Pengaturan Peserta</h3>
                        <p class="text-xs text-gray-500 mt-1">
                            Tentukan apakah kegiatan berlaku untuk seluruh anggota atau hanya peserta tertentu.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                        <label
                            class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-white p-4 cursor-pointer hover:border-green-300 transition">

                            <input type="radio" name="target_peserta" value="semua" id="target_semua"
                                {{ old('target_peserta', 'semua') == 'semua' ? 'checked' : '' }}
                                onclick="document.getElementById('daftar_peserta').classList.add('hidden')"
                                class="mt-1 h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">

                            <div>
                                <p class="text-sm font-medium text-gray-900">Semua Anggota</p>
                                <p class="text-xs text-gray-500">Absensi akan terbuka untuk seluruh anggota.</p>
                            </div>

                        </label>

                        <label
                            class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-white p-4 cursor-pointer hover:border-green-300 transition">

                            <input type="radio" name="target_peserta" value="tertentu" id="target_tertentu"
                                {{ old('target_peserta') == 'tertentu' ? 'checked' : '' }}
                                onclick="document.getElementById('daftar_peserta').classList.remove('hidden')"
                                class="mt-1 h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">

                            <div>
                                <p class="text-sm font-medium text-gray-900">Peserta Tertentu</p>
                                <p class="text-xs text-gray-500">Pilih pengurus yang menjadi peserta kegiatan.</p>
                            </div>

                        </label>

                    </div>

                    <div id="daftar_peserta"
                        class="{{ old('target_peserta') == 'tertentu' ? '' : 'hidden' }} rounded-2xl border border-gray-200 bg-white p-4 max-h-64 overflow-y-auto space-y-2">

                        @foreach ($pengurus as $p)
                            <label
                                class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-green-50 transition cursor-pointer">

                                <input type="checkbox" name="peserta[]" value="{{ $p->id }}"
                                    {{ in_array($p->id, old('peserta', [])) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">

                                <span class="text-sm text-gray-700">{{ $p->nama_lengkap }}</span>
                            </label>
                        @endforeach

                    </div>

                </div>

                {{-- Status --}}
                <div x-data="{
                    status: '{{ old('status_kegiatan', $statusList[0] ?? '') }}',
                    labelStatus: '{{ old('status_kegiatan', $statusList[0] ?? '-- Pilih Status --') }}'
                }">

                    <input type="hidden" name="status_kegiatan" :value="status">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Kegiatan</label>

                    <x-ui.dropdown width="full" align="left">
                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-400 hover:shadow-md transition">

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

                            @foreach ($statusList as $s)
                                <x-ui.dropdown-item type="button"
                                    @click="status = '{{ $s }}'; labelStatus = '{{ $s }}'">
                                    {{ $s }}
                                </x-ui.dropdown-item>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>

            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50">

                <a href="{{ route('kegiatan.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                    Simpan Kegiatan
                </button>

            </div>

        </form>
    </div>
</x-app-layout>
