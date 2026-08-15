<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Notulen</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        <form action="{{ route('notulen.update', $notulen->id) }}" method="POST" enctype="multipart/form-data"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf
            @method('PUT')

            {{-- Header --}}
            <div class="border-b border-gray-100 pb-4">
                <h3 class="text-lg font-semibold text-gray-900">Form Edit Notulen</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui dokumentasi hasil rapat atau kegiatan organisasi PAC Fatayat NU Pragaan.
                </p>
            </div>

            {{-- Kegiatan --}}
            <div x-data="{
                labelKegiatan: '{{ old('kegiatan_id', $notulen->kegiatan_id)
                    ? optional($kegiatan->firstWhere('id', old('kegiatan_id', $notulen->kegiatan_id)))->nama_kegiatan .
                        ' (' .
                        optional($kegiatan->firstWhere('id', old('kegiatan_id', $notulen->kegiatan_id)))->tanggal_kegiatan .
                        ')'
                    : 'Tidak Terkait Kegiatan' }}'
            }" class="space-y-2">

                <label class="block text-sm font-medium text-gray-700">
                    Kegiatan Terkait (opsional)
                </label>

                <input type="hidden" name="kegiatan_id" value="{{ old('kegiatan_id', $notulen->kegiatan_id) }}">

                <x-ui.dropdown width="80" align="left">

                    <x-slot name="trigger">
                        <button type="button"
                            class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-md transition-all duration-200">

                            <span class="truncate text-left" x-text="labelKegiatan"></span>

                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <button type="button"
                            @click="
                                $el.closest('[x-data]').querySelector('input[name=kegiatan_id]').value = '';
                                labelKegiatan = 'Tidak Terkait Kegiatan'
                            "
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                            <span class="h-2.5 w-2.5 rounded-full bg-gray-400"></span>
                            Tidak Terkait Kegiatan
                        </button>

                        @foreach ($kegiatan as $k)
                            <button type="button"
                                @click="
                                    $el.closest('[x-data]').querySelector('input[name=kegiatan_id]').value = '{{ $k->id }}';
                                    labelKegiatan = '{{ $k->nama_kegiatan }} ({{ $k->tanggal_kegiatan }})'
                                "
                                class="flex w-full items-start gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-green-500"></span>

                                <div class="text-left">
                                    <div class="font-medium">{{ $k->nama_kegiatan }}</div>
                                    <div class="text-xs text-gray-500">{{ $k->tanggal_kegiatan }}</div>
                                </div>
                            </button>
                        @endforeach

                    </x-slot>
                </x-ui.dropdown>
            </div>

            {{-- Judul --}}
            <div>
                <x-ui.input name="judul" label="Judul Notulen" :value="old('judul', $notulen->judul)"
                    placeholder="Contoh: Rapat Evaluasi Bulanan PAC Fatayat NU Pragaan" />

                @error('judul')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div>
                <x-ui.date-input name="tanggal" label="Tanggal Rapat" :value="old('tanggal', $notulen->tanggal)" />

                @error('tanggal')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pemimpin & Notulis --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <div>
                    <x-ui.input name="pemimpin_rapat" label="Pemimpin Rapat" :value="old('pemimpin_rapat', $notulen->pemimpin_rapat)"
                        placeholder="Nama pemimpin rapat" />
                </div>

                <div>
                    <x-ui.input name="notulis" label="Notulis" :value="old('notulis', $notulen->notulis)" placeholder="Nama notulis" />
                </div>
            </div>

            {{-- Isi Notulen --}}
            <div>
                <x-ui.textarea name="isi_notulen" label="Isi Notulen" rows="10"
                    placeholder="Tuliskan hasil rapat, poin pembahasan, keputusan, dan tindak lanjut...">{{ old('isi_notulen', $notulen->isi_notulen) }}</x-ui.textarea>

                @error('isi_notulen')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lampiran --}}
            <div class="space-y-2">

                <label class="block text-sm font-medium text-gray-700">
                    File Lampiran (opsional)
                </label>

                @if ($notulen->file_lampiran)
                    <a href="{{ Storage::url($notulen->file_lampiran) }}" target="_blank"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-50 px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100 transition">

                        📎 Lihat file saat ini
                    </a>
                @endif

                <div
                    class="rounded-2xl border border-dashed border-gray-300 bg-gray-50/50 px-4 py-5 hover:border-green-300 hover:bg-green-50/30 transition-all duration-200">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white shadow-sm text-lg">
                            📎
                        </div>

                        <div class="flex-1">

                            <input type="file" name="file_lampiran" accept=".pdf,.doc,.docx"
                                class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-xl file:border-0 file:bg-green-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-green-700 hover:file:bg-green-200 transition">

                            <p class="mt-1 text-xs text-gray-500">
                                Upload file baru jika ingin mengganti lampiran sebelumnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action --}}
            <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                <a href="{{ route('notulen.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">

                    💾 Update Notulen
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
