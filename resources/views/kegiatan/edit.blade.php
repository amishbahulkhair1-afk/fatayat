
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Kegiatan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST"
            class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-100/50 p-6 sm:p-8 space-y-8">

            @csrf
            @method('PUT')

            <div class="space-y-2">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Kegiatan</h3>
                <p class="text-sm text-gray-500">Perbarui informasi utama kegiatan dan pengaturan pesertanya.</p>
            </div>

            <div class="grid grid-cols-1 gap-6">

                {{-- Nama Kegiatan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan</label>

                    <x-ui.input name="nama_kegiatan" :value="old('nama_kegiatan', $kegiatan->nama_kegiatan)" placeholder="Contoh: Rapat Koordinasi PAC" />

                    @error('nama_kegiatan')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis Kegiatan --}}
                <div x-data="{ openJenis: false, labelJenis: '{{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) ?: '-- Pilih Jenis --' }}' }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kegiatan</label>

                    <input type="hidden" name="jenis_kegiatan"
                        value="{{ old('jenis_kegiatan', $kegiatan->jenis_kegiatan) }}">

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
                            @foreach ($jenisList as $j)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=jenis_kegiatan]').value = '{{ $j }}'; labelJenis = '{{ $j }}'; openJenis = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $j }}
                                </button>
                            @endforeach
                        </x-slot>
                    </x-ui.dropdown>

                    @error('jenis_kegiatan')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <x-ui.date-input name="tanggal_kegiatan" label="Tanggal Kegiatan" :value="old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan)" />
                </div>

                {{-- Jam --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-ui.time-input name="jam_mulai" label="Jam Mulai" :value="old('jam_mulai', $kegiatan->jam_mulai)" />
                    </div>

                    <div>
                        <x-ui.time-input name="jam_selesai" label="Jam Selesai" :value="old('jam_selesai', $kegiatan->jam_selesai)" />
                    </div>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kegiatan</label>

                    <x-ui.input name="lokasi_kegiatan" :value="old('lokasi_kegiatan', $kegiatan->lokasi_kegiatan)" placeholder="Masukkan lokasi kegiatan" />
                </div>

                {{-- Lembaga --}}
                <div x-data="{ openLembaga: false, labelLembaga: '{{ old('lembaga_id', $kegiatan->lembaga_id) ? optional($lembaga->firstWhere('id', old('lembaga_id', $kegiatan->lembaga_id)))->nama_lembaga : '-- Tidak Terkait Lembaga --' }}' }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Lembaga (Opsional)</label>

                    <input type="hidden" name="lembaga_id" value="{{ old('lembaga_id', $kegiatan->lembaga_id) }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openLembaga = !openLembaga"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelLembaga"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <button type="button"
                                @click="$el.closest('[x-data]').querySelector('input[name=lembaga_id]').value = ''; labelLembaga = '-- Tidak Terkait Lembaga --'; openLembaga = false"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                                <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                                -- Tidak Terkait Lembaga --
                            </button>

                            @foreach ($lembaga as $l)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=lembaga_id]').value = '{{ $l->id }}'; labelLembaga = '{{ $l->nama_lembaga }}'; openLembaga = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $l->nama_lembaga }}
                                </button>
                            @endforeach
                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Penanggung Jawab --}}
                <div x-data="{ openPenanggung: false, labelPenanggung: '{{ old('penanggung_jawab_id', $kegiatan->penanggung_jawab_id) ? optional($pengurus->firstWhere('id', old('penanggung_jawab_id', $kegiatan->penanggung_jawab_id)))->nama_lengkap : '-- Pilih Penanggung Jawab --' }}' }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>

                    <input type="hidden" name="penanggung_jawab_id"
                        value="{{ old('penanggung_jawab_id', $kegiatan->penanggung_jawab_id) }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openPenanggung = !openPenanggung"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span x-text="labelPenanggung"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @foreach ($pengurus as $p)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=penanggung_jawab_id]').value = '{{ $p->id }}'; labelPenanggung = '{{ $p->nama_lengkap }}'; openPenanggung = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $p->nama_lengkap }}
                                </button>
                            @endforeach
                        </x-slot>
                    </x-ui.dropdown>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Kegiatan</label>

                    <x-ui.textarea name="deskripsi_kegiatan" rows="4"
                        placeholder="Jelaskan tujuan dan detail kegiatan">{{ old('deskripsi_kegiatan', $kegiatan->deskripsi_kegiatan) }}</x-ui.textarea>
                </div>
            </div>

            {{-- Pengaturan Tambahan --}}
            <div class="border-t border-gray-100 pt-6 space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">Pengaturan Tambahan</h3>

                <div class="space-y-3">
                    <label
                        class="flex items-center gap-3 rounded-2xl border border-gray-200 px-4 py-3 cursor-pointer hover:border-green-300 hover:bg-green-50/50 transition">
                        <input type="radio" name="target_peserta" value="semua" id="target_semua"
                            {{ old('target_peserta', $kegiatan->target_peserta) == 'semua' ? 'checked' : '' }}
                            onclick="document.getElementById('daftar_peserta').classList.add('hidden')"
                            class="text-green-600 focus:ring-green-500">

                        <div>
                            <p class="text-sm font-medium text-gray-800">Semua Anggota</p>
                            <p class="text-xs text-gray-500">Absensi berlaku untuk seluruh anggota yang tersedia.</p>
                        </div>
                    </label>

                    <label
                        class="flex items-center gap-3 rounded-2xl border border-gray-200 px-4 py-3 cursor-pointer hover:border-green-300 hover:bg-green-50/50 transition">
                        <input type="radio" name="target_peserta" value="tertentu" id="target_tertentu"
                            {{ old('target_peserta', $kegiatan->target_peserta) == 'tertentu' ? 'checked' : '' }}
                            onclick="document.getElementById('daftar_peserta').classList.remove('hidden')"
                            class="text-green-600 focus:ring-green-500">

                        <div>
                            <p class="text-sm font-medium text-gray-800">Anggota Tertentu</p>
                            <p class="text-xs text-gray-500">Pilih hanya peserta yang diundang mengikuti kegiatan ini.
                            </p>
                        </div>
                    </label>
                </div>

                <div id="daftar_peserta"
                    class="{{ old('target_peserta', $kegiatan->target_peserta) == 'tertentu' ? '' : 'hidden' }} rounded-2xl border border-gray-200 bg-gray-50/60 p-4 max-h-56 overflow-y-auto space-y-2">

                    @foreach ($pengurus as $p)
                        <label
                            class="flex items-center gap-3 rounded-xl bg-white px-3 py-2 border border-gray-100 hover:border-green-200 transition">
                            <input type="checkbox" name="peserta[]" value="{{ $p->id }}"
                                {{ in_array($p->id, old('peserta', $pesertaTerpilih)) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-green-600 focus:ring-green-500">

                            <span class="text-sm text-gray-700">{{ $p->nama_lengkap }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- Status --}}
                <div x-data="{ openStatus: false, labelStatus: '{{ old('status_kegiatan', $kegiatan->status_kegiatan) ?: 'Pilih Status Kegiatan' }}' }" class="relative">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Kegiatan</label>

                    <input type="hidden" name="status_kegiatan"
                        value="{{ old('status_kegiatan', $kegiatan->status_kegiatan) }}">

                    <x-ui.dropdown width="64" align="left">
                        <x-slot name="trigger">
                            <button type="button" @click="openStatus = !openStatus"
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
                            @foreach ($statusList as $s)
                                <button type="button"
                                    @click="$el.closest('[x-data]').querySelector('input[name=status_kegiatan]').value = '{{ $s }}'; labelStatus = '{{ $s }}'; openStatus = false"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $s }}
                                </button>
                            @endforeach
                        </x-slot>
                    </x-ui.dropdown>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    💾 Update Kegiatan
                </button>

                <a href="{{ route('kegiatan.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>