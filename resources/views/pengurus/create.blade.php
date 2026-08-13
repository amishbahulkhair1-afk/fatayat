<x-app-layout>
    <div class="space-y-6 max-w-6xl mx-auto">

        <!-- BANNER -->
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

            <div class="flex items-start gap-3">

                <div
                    class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                    👥
                </div>

                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Tambah Pengurus
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Tambahkan data <span class="font-semibold text-green-900">Pengurus Fatayat Nahdlatul Ulama</span>
                        beserta informasi pribadi, pendidikan, organisasi, dan dokumen pendukung.
                    </p>
                </div>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Tambah Pengurus</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Lengkapi seluruh informasi pengurus dengan benar sebelum menyimpan data.
                </p>
            </div>

            <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-8">
                @csrf

                <!-- IDENTITAS -->
                <div class="space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🪪</div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Identitas Pengurus</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Informasi dasar mengenai pengurus.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                placeholder="Nama lengkap pengurus"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                            @error('nama_lengkap')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{
                            jk: '{{ old('jenis_kelamin') }}',
                            labelJk: '{{ old('jenis_kelamin') ?: 'Pilih Jenis Kelamin' }}'
                        }">

                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>

                            <input type="hidden" name="jenis_kelamin" :value="jk">

                            <x-ui.dropdown width="72" align="left">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">
                                        <span x-text="labelJk"></span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button" @click="jk='Laki-laki'; labelJk='Laki-laki'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                        👨 Laki-laki
                                    </button>

                                    <button type="button" @click="jk='Perempuan'; labelJk='Perempuan'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 transition">
                                        👩 Perempuan
                                    </button>
                                </x-slot>
                            </x-ui.dropdown>

                            @error('jenis_kelamin')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-ui.date-input name="tanggal_lahir" label="Tanggal Lahir" :value="old('tanggal_lahir')" />
                            @error('tanggal_lahir')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Domisili</label>
                            <textarea name="alamat_domisili" rows="4" placeholder="Alamat domisili lengkap"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('alamat_domisili') }}</textarea>
                            @error('alamat_domisili')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{
                            statusNikah: '{{ old('status_menikah') }}',
                            labelNikah: '{{ old('status_menikah') ?: 'Pilih Status Menikah' }}'
                        }">

                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Menikah</label>

                            <input type="hidden" name="status_menikah" :value="statusNikah">

                            <x-ui.dropdown width="72" align="left">
                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">
                                        <span x-text="labelNikah"></span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button"
                                        @click="statusNikah='Belum Menikah'; labelNikah='Belum Menikah'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        💚 Belum Menikah
                                    </button>

                                    <button type="button" @click="statusNikah='Menikah'; labelNikah='Menikah'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        💍 Menikah
                                    </button>
                                </x-slot>
                            </x-ui.dropdown>

                            @error('status_menikah')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                placeholder="Pekerjaan saat ini"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>
                </div>

                <!-- PENDIDIKAN -->
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🎓</div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Riwayat Pendidikan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Informasi pendidikan formal dan pondok pesantren.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">SD / MI Sederajat</label>
                            <input type="text" name="sd_sederajat" value="{{ old('sd_sederajat') }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus SD</label>
                            <input type="number" name="sd_tahun_lulus" value="{{ old('sd_tahun_lulus') }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">SMP / MTs Sederajat</label>
                            <input type="text" name="smp_sederajat" value="{{ old('smp_sederajat') }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus SMP</label>
                            <input type="number" name="smp_tahun_lulus" value="{{ old('smp_tahun_lulus') }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">SMA / MA Sederajat</label>
                            <input type="text" name="sma_sederajat" value="{{ old('sma_sederajat') }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus SMA</label>
                            <input type="number" name="sma_tahun_lulus" value="{{ old('sma_tahun_lulus') }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Pondok
                                Pesantren</label>
                            <input type="text" name="pondok_pesantren" value="{{ old('pondok_pesantren') }}"
                                placeholder="Nama pondok pesantren yang pernah ditempuh"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">S1</label>
                            <input type="text" name="s1" value="{{ old('s1') }}"
                                placeholder="Program studi / perguruan tinggi"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">S2</label>
                            <input type="text" name="s2" value="{{ old('s2') }}"
                                placeholder="Program studi / perguruan tinggi"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">S3</label>
                            <input type="text" name="s3" value="{{ old('s3') }}"
                                placeholder="Program studi / perguruan tinggi"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>
                </div>

                <!-- ORGANISASI -->
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🤝</div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Organisasi & Pengkaderan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Riwayat kaderisasi dan pengalaman organisasi
                                pengurus.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pengkaderan Fatayat</label>
                            <input type="text" name="pengkaderan_fatayat"
                                value="{{ old('pengkaderan_fatayat') }}" placeholder="PKD, PKL, PKN, dll"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pengkaderan NU</label>
                            <input type="text" name="pengkaderan_nu" value="{{ old('pengkaderan_nu') }}"
                                placeholder="Lakmud, Lakut, dll"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Organisasi</label>
                            <textarea name="pengalaman_organisasi" rows="4"
                                placeholder="Pengalaman organisasi di dalam maupun di luar Fatayat NU"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('pengalaman_organisasi') }}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                                placeholder="Jabatan organisasi"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal PR</label>
                            <input type="text" name="asal_pr" value="{{ old('asal_pr') }}"
                                placeholder="Asal PR pengurus"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal PAR</label>
                            <input type="text" name="asal_par" value="{{ old('asal_par') }}"
                                placeholder="Asal PAR pengurus"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pelatihan yang Pernah
                            Diikuti</label>
                        <textarea name="pelatihan" rows="4" placeholder="Daftar pelatihan yang pernah diikuti"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('pelatihan') }}</textarea>
                    </div>
                </div>

                <!-- POTENSI -->
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🌱</div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Potensi & Prestasi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Informasi potensi, usaha, dan prestasi yang
                                dimiliki pengurus.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Potensi yang Dimiliki</label>
                            <textarea name="potensi" rows="4" placeholder="Keterampilan, kemampuan, atau potensi lain yang dimiliki"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('potensi') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Produk / Usaha yang
                                Dimiliki</label>
                            <textarea name="produk_usaha" rows="4" placeholder="Jenis usaha, produk, atau UMKM yang dimiliki"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('produk_usaha') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prestasi atau Penghargaan</label>
                        <textarea name="prestasi" rows="4" placeholder="Prestasi atau penghargaan yang pernah dicapai pengurus"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('prestasi') }}</textarea>
                    </div>
                </div>

                <!-- DOKUMEN -->
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            📎</div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Dokumen & Lampiran</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Unggah dokumen pendukung sesuai format yang
                                diperbolehkan.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div class="rounded-2xl border border-gray-200 p-4 space-y-3">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900">Foto KTP</h4>
                                <p class="text-xs text-gray-500 mt-1">Format JPG atau PNG.</p>
                            </div>

                            <input type="file" name="foto_ktp" accept="image/jpeg,image/png"
                                class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-green-700 hover:file:bg-green-100">
                        </div>

                        <div class="rounded-2xl border border-gray-200 p-4 space-y-3">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900">Foto 3x4 Seragam Fatayat</h4>
                                <p class="text-xs text-gray-500 mt-1">Format JPG atau PNG.</p>
                            </div>

                            <input type="file" name="foto_seragam" accept="image/jpeg,image/png"
                                class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-green-700 hover:file:bg-green-100">
                        </div>

                        <div class="rounded-2xl border border-gray-200 p-4 space-y-3">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900">Sertifikat Pengkaderan</h4>
                                <p class="text-xs text-gray-500 mt-1">Format JPG, PNG, atau PDF.</p>
                            </div>

                            <input type="file" name="sertifikat_pengkaderan"
                                accept="image/jpeg,image/png,application/pdf"
                                class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-green-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-green-700 hover:file:bg-green-100">
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div
                    class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a href="{{ route('pengurus.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        💾 Simpan Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
