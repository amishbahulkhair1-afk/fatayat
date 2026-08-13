
<x-app-layout>
    <x-slot name="header">
        Edit Anggota
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
                        Edit Data Anggota
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Perbarui data <span class="font-semibold text-green-900">anggota Fatayat NU</span>
                        beserta informasi keanggotaan dan data pendukung lainnya.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Edit Anggota</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Pastikan data anggota sudah sesuai sebelum menyimpan perubahan.
                </p>
            </div>

            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-8">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    {{-- KOLOM KIRI --}}
                    <div class="space-y-6">

                        <div class="flex items-center gap-2">
                            <div
                                class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                                👤
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Data Pribadi</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Informasi identitas utama anggota.</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                            @error('nama_lengkap')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}"
                                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <x-ui.date-input name="tanggal_lahir" :value="old('tanggal_lahir', $anggota->tanggal_lahir)" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                            <input type="text" name="no_telepon"
                                value="{{ old('no_telepon', $anggota->no_telepon) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" rows="4"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('alamat_lengkap', $anggota->alamat_lengkap) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                <input type="text" name="pekerjaan"
                                    value="{{ old('pekerjaan', $anggota->pekerjaan) }}"
                                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $anggota->email) }}"
                                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                                @error('email')
                                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6 space-y-4">

                            <div class="flex items-center gap-2">
                                <div
                                    class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                                    🎓
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900">Data Tambahan</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Informasi pendidikan dan keterampilan
                                        anggota.</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Pendidikan</label>
                                <textarea name="riwayat_pendidikan" rows="4"
                                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('riwayat_pendidikan', $anggota->riwayat_pendidikan) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Keterampilan /
                                    Pekerjaan</label>
                                <textarea name="keterampilan_pekerjaan" rows="4"
                                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('keterampilan_pekerjaan', $anggota->keterampilan_pekerjaan) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="space-y-6">

                        <div class="flex items-center gap-2">
                            <div
                                class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                                🪪
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Data Keanggotaan</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Informasi wilayah dan status keanggotaan
                                    organisasi.</p>
                            </div>
                        </div>

                        @if (auth()->user()->role !== 'admin_par')

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">PAC (Opsional)</label>

                                <div x-data="{ open: false, selected: '{{ old('pac_id', $anggota->pac_id) ? $pac->firstWhere('id', old('pac_id', $anggota->pac_id))->nama ?? '-- Tidak Ada --' : '-- Tidak Ada --' }}' }" class="relative">

                                    <input type="hidden" name="pac_id"
                                        :value="selected === '-- Tidak Ada --' ? '' : '{{ old('pac_id', $anggota->pac_id) }}'">

                                    <x-ui.dropdown width="64" align="left">
                                        <x-slot name="trigger">
                                            <button type="button"
                                                class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">
                                                <span x-text="selected"></span>
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <button type="button" @click="selected = '-- Tidak Ada --'"
                                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                                -- Tidak Ada --
                                            </button>

                                            @foreach ($pac as $item)
                                                <button type="button" @click="selected = '{{ $item->nama }}'"
                                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                                    {{ $item->nama }}
                                                </button>
                                            @endforeach
                                        </x-slot>
                                    </x-ui.dropdown>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">PR Asal</label>

                                <div x-data="{ open: false, selected: '{{ old('pr_id', $anggota->pr_id) ? $pr->firstWhere('id', old('pr_id', $anggota->pr_id))->nama ?? '-- Pilih PR --' : '-- Pilih PR --' }}' }" class="relative">

                                    <input type="hidden" name="pr_id"
                                        :value="selected === '-- Pilih PR --' ? '' : '{{ old('pr_id', $anggota->pr_id) }}'">

                                    <x-ui.dropdown width="64" align="left">
                                        <x-slot name="trigger">
                                            <button type="button"
                                                class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">
                                                <span x-text="selected"></span>
                                                <svg class="w-4 h-4 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7" />
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
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">PAR Asal</label>

                                <div x-data="{ open: false, selected: '{{ old('par_id', $anggota->par_id) ? $par->firstWhere('id', old('par_id', $anggota->par_id))->nama ?? '-- Pilih PAR --' : '-- Pilih PAR --' }}' }" class="relative">

                                    <input type="hidden" name="par_id"
                                        :value="selected === '-- Pilih PAR --' ? '' : '{{ old('par_id', $anggota->par_id) }}'">

                                    <x-ui.dropdown width="64" align="left">
                                        <x-slot name="trigger">
                                            <button type="button"
                                                class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">
                                                <span x-text="selected"></span>
                                                <svg class="w-4 h-4 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7" />
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
                        @else
                            <input type="hidden" name="par_id" value="{{ $par->first()->id }}">

                            <div
                                class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                                <p class="font-medium text-green-900">Wilayah PAR</p>
                                <p class="mt-1">{{ $par->first()->nama }}</p>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                            <x-ui.date-input name="tanggal_bergabung" :value="old('tanggal_bergabung', $anggota->tanggal_bergabung)" />
                            @error('tanggal_bergabung')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Anggota</label>

                            <div x-data="{ open: false, selected: '{{ old('status_anggota', $anggota->status_anggota) ?: '-- Pilih Status --' }}' }" class="relative">

                                <input type="hidden" name="status_anggota"
                                    :value="selected === '-- Pilih Status --' ? '' : selected">

                                <x-ui.dropdown width="64" align="left">
                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 hover:shadow-sm transition">
                                            <span x-text="selected"></span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <button type="button" @click="selected = '-- Pilih Status --'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            -- Pilih Status --
                                        </button>

                                        <button type="button" @click="selected = 'Aktif'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            Aktif
                                        </button>

                                        <button type="button" @click="selected = 'Tidak Aktif'"
                                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                            Tidak Aktif
                                        </button>
                                    </x-slot>
                                </x-ui.dropdown>
                            </div>

                            @error('status_anggota')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. KTA / NIK</label>
                            <input type="text" name="no_kta" value="{{ old('no_kta', $anggota->no_kta) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                            @error('no_kta')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="border-t border-gray-100 pt-6 space-y-4">

                            <div class="flex items-center gap-2">
                                <div
                                    class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                                    🖼️
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900">Foto Kader</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Unggah foto terbaru anggota jika ingin
                                        mengganti foto sebelumnya.</p>
                                </div>
                            </div>

                            @if ($anggota->foto_kader)
                                <div class="flex items-center gap-4 rounded-2xl border border-gray-200 bg-gray-50 p-4">
                                    <img src="{{ Storage::url($anggota->foto_kader) }}"
                                        class="w-20 h-20 rounded-2xl object-cover border border-gray-200 shadow-sm">

                                    <div class="text-sm text-gray-600">
                                        <p class="font-medium text-gray-800">Foto saat ini</p>
                                        <p class="text-xs text-gray-500 mt-1">Pilih file baru jika ingin memperbarui
                                            foto kader.</p>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <input type="file" name="foto_kader" accept="image/jpeg,image/png"
                                    class="w-full rounded-2xl border border-dashed border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-green-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-green-700 hover:border-green-300 hover:file:bg-green-200 transition">

                                <p class="text-xs text-gray-500 mt-2">Format JPG atau PNG dengan ukuran maksimal 2 MB.
                                </p>
                            </div>
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
                        💾 Perbarui Anggota
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>