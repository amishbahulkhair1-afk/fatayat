<x-app-layout>
    <x-slot name="header">
        Edit PAR
    </x-slot>
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- BANNER -->
    <div
        class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

        <div class="flex items-start gap-3">

            <div
                class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                ✏️
            </div>

            <div class="min-w-0">
                <h1 class="text-base font-semibold text-green-900 leading-tight">
                    Edit Pimpinan Anak Ranting
                </h1>

                <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                    Perbarui data <span class="font-semibold text-green-900">PAR Nahdlatul Ulama</span>
                    beserta informasi pengurus inti dan data pendukung organisasi tingkat anak ranting.
                </p>
            </div>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit PAR</h2>
            <p class="text-sm text-gray-500 mt-1">
                Pastikan informasi pimpinan anak ranting sudah sesuai sebelum menyimpan perubahan data.
            </p>
        </div>

        <form action="{{ route('par.update', $par->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- PR ASAL -->
            <div x-data="{
                prId: '{{ old('pr_id', $par->pr_id) }}',
                namaPr: '{{ optional($pr->firstWhere('id', old('pr_id', $par->pr_id)))->nama ?? 'Pilih PR' }}'
            }">

                <label class="block text-sm font-medium text-gray-700 mb-2">PR Asal</label>

                <input type="hidden" name="pr_id" :value="prId">

                <x-ui.dropdown width="72" align="left">
                    <x-slot name="trigger">
                        <button type="button"
                            class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">
                            <span x-text="namaPr"></span>

                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="max-h-64 overflow-y-auto scrollbar-vscode scrollbar-vscode-green">
                            @foreach ($pr as $item)
                                <button type="button"
                                    @click="prId = '{{ $item->id }}'; namaPr = '{{ $item->nama }}'"
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

                @error('pr_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- INFORMASI UTAMA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama PAR</label>

                    <input type="text" name="nama" value="{{ old('nama', $par->nama) }}"
                        placeholder="Contoh: PAR NU Dusun Krajan"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                    @error('nama')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>

                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $par->kecamatan) }}"
                        placeholder="Nama kecamatan"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                    @error('kecamatan')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- TANGGAL & STATUS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <x-ui.date-input
                    name="tanggal_dibentuk"
                    label="Tanggal Dibentuk"
                    :value="old('tanggal_dibentuk', $par->tanggal_dibentuk)"
                />

                <div x-data="{
                    status: '{{ old('status', $par->status ?? 'Aktif') }}',
                    labelStatus: '{{ old('status', $par->status ?? 'Aktif') }}'
                }">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Organisasi</label>

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
                            @foreach (['Aktif', 'Persiapan', 'Vakum', 'Tidak Aktif', 'Dibekukan'] as $item)
                                <button type="button"
                                    @click="status = '{{ $item }}'; labelStatus = '{{ $item }}'"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                    {{ $item }}
                                </button>
                            @endforeach
                        </x-slot>
                    </x-ui.dropdown>

                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- PENGURUS INTI -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        👥</div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Pengurus Inti</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Perbarui pengurus yang menjabat sebagai ketua, sekretaris, dan bendahara PAR.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @php
                        $pengurusFields = [
                            'ketua_id' => ['label' => 'Ketua', 'nama' => 'namaKetua'],
                            'sekertaris_id' => ['label' => 'Sekretaris', 'nama' => 'namaSekertaris'],
                            'bendahara_id' => ['label' => 'Bendahara', 'nama' => 'namaBendahara'],
                        ];
                    @endphp

                    @foreach ($pengurusFields as $field => $config)
                        <div x-data="{
                            selected: '{{ old($field, $par->$field) }}',
                            label: '{{ optional($pengurus->firstWhere('id', old($field, $par->$field)))->nama_lengkap ?? 'Pilih ' . $config['label'] }}'
                        }">

                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $config['label'] }}</label>

                            <input type="hidden" name="{{ $field }}" :value="selected">

                            <x-ui.dropdown width="72" align="left">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                        <span x-text="label"></span>

                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="max-h-64 overflow-y-auto scrollbar-vscode scrollbar-vscode-green">
                                        @foreach ($pengurus as $p)
                                            <button type="button"
                                                @click="selected = '{{ $p->id }}'; label = '{{ $p->nama_lengkap }}'"
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

                            @error($field)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- KONTAK -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        📞</div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Kontak Organisasi</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Perbarui nomor telepon atau kontak yang dapat dihubungi.</p>
                    </div>
                </div>

                <input type="text" name="kontak" value="{{ old('kontak', $par->kontak) }}"
                    placeholder="08xxxxxxxxxx"
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
            </div>

            <!-- KETERANGAN -->
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        📝</div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Keterangan Tambahan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Tambahkan catatan atau informasi tambahan terkait PAR ini jika diperlukan.</p>
                    </div>
                </div>

                <textarea name="keterangan" rows="5" placeholder="Catatan tambahan mengenai PAR..."
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('keterangan', $par->keterangan) }}</textarea>
            </div>

            <!-- ACTION BUTTONS -->
            <div
                class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                <a href="{{ route('par.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                    💾 Perbarui PAR
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>