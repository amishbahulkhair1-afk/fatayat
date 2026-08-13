<x-app-layout>
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
                        Edit Pengurus
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Perbarui data <span class="font-semibold text-green-900">pengurus Fatayat NU</span>
                        beserta informasi pendidikan, organisasi, potensi, dan dokumen pendukung.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Edit Pengurus</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Pastikan seluruh informasi sudah benar sebelum menyimpan perubahan data.
                </p>
            </div>

            <form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-8">

                @csrf
                @method('PUT')

                {{-- DATA PRIBADI --}}
                <div class="space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            👤
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Data Pribadi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Perbarui identitas dasar pengurus.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $pengurus->nama_lengkap) }}"
                                placeholder="Nama lengkap sesuai identitas"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                            @error('nama_lengkap')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{
                            jenisKelamin: '{{ old('jenis_kelamin', $pengurus->jenis_kelamin) }}',
                            labelJenisKelamin: '{{ old('jenis_kelamin', $pengurus->jenis_kelamin) }}'
                        }">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kelamin
                            </label>

                            <input type="hidden" name="jenis_kelamin" :value="jenisKelamin">

                            <x-ui.dropdown width="72" align="left">

                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                        <span class="flex items-center gap-2">
                                            <span class="h-2.5 w-2.5 rounded-full"
                                                :class="jenisKelamin === 'Perempuan' ? 'bg-pink-500' : 'bg-blue-500'"></span>
                                            <span x-text="labelJenisKelamin || 'Pilih Jenis Kelamin'"></span>
                                        </span>

                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button"
                                        @click="jenisKelamin = 'Laki-laki'; labelJenisKelamin = 'Laki-laki'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                                        Laki-laki
                                    </button>

                                    <button type="button"
                                        @click="jenisKelamin = 'Perempuan'; labelJenisKelamin = 'Perempuan'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-pink-500"></span>
                                        Perempuan
                                    </button>
                                </x-slot>
                            </x-ui.dropdown>

                            @error('jenis_kelamin')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-ui.date-input name="tanggal_lahir" label="Tanggal Lahir" :value="old('tanggal_lahir', $pengurus->tanggal_lahir)" />

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Domisili
                            </label>

                            <textarea name="alamat_domisili" rows="4" placeholder="Alamat lengkap domisili saat ini"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('alamat_domisili', $pengurus->alamat_domisili) }}</textarea>

                            @error('alamat_domisili')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{
                            statusMenikah: '{{ old('status_menikah', $pengurus->status_menikah) }}',
                            labelStatusMenikah: '{{ old('status_menikah', $pengurus->status_menikah) }}'
                        }">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Menikah
                            </label>

                            <input type="hidden" name="status_menikah" :value="statusMenikah">

                            <x-ui.dropdown width="72" align="left">

                                <x-slot name="trigger">
                                    <button type="button"
                                        class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                        <span class="flex items-center gap-2">
                                            <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                            <span x-text="labelStatusMenikah || 'Pilih Status Menikah'"></span>
                                        </span>

                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <button type="button"
                                        @click="statusMenikah = 'Menikah'; labelStatusMenikah = 'Menikah'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                        Menikah
                                    </button>

                                    <button type="button"
                                        @click="statusMenikah = 'Belum Menikah'; labelStatusMenikah = 'Belum Menikah'"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 transition">

                                        <span class="h-2.5 w-2.5 rounded-full bg-yellow-500"></span>
                                        Belum Menikah
                                    </button>
                                </x-slot>
                            </x-ui.dropdown>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pekerjaan
                            </label>

                            <input type="text" name="pekerjaan"
                                value="{{ old('pekerjaan', $pengurus->pekerjaan) }}"
                                placeholder="Contoh: Guru, Wirausaha, Mahasiswa"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>
                </div>

                {{-- PENDIDIKAN --}}
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🎓
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Pendidikan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Perbarui riwayat pendidikan formal dan pondok pesantren.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">SD / MI Sederajat</label>
                            <input type="text" name="sd_sederajat"
                                value="{{ old('sd_sederajat', $pengurus->sd_sederajat) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus SD</label>
                            <input type="number" name="sd_tahun_lulus"
                                value="{{ old('sd_tahun_lulus', $pengurus->sd_tahun_lulus) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">SMP Sederajat</label>
                            <input type="text" name="smp_sederajat"
                                value="{{ old('smp_sederajat', $pengurus->smp_sederajat) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus SMP</label>
                            <input type="number" name="smp_tahun_lulus"
                                value="{{ old('smp_tahun_lulus', $pengurus->smp_tahun_lulus) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">SMA Sederajat</label>
                            <input type="text" name="sma_sederajat"
                                value="{{ old('sma_sederajat', $pengurus->sma_sederajat) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus SMA</label>
                            <input type="number" name="sma_tahun_lulus"
                                value="{{ old('sma_tahun_lulus', $pengurus->sma_tahun_lulus) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Pondok
                                Pesantren</label>
                            <input type="text" name="pondok_pesantren"
                                value="{{ old('pondok_pesantren', $pengurus->pondok_pesantren) }}"
                                placeholder="Nama pondok pesantren"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">S1</label>
                            <input type="text" name="s1" value="{{ old('s1', $pengurus->s1) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">S2</label>
                            <input type="text" name="s2" value="{{ old('s2', $pengurus->s2) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">S3</label>
                            <input type="text" name="s3" value="{{ old('s3', $pengurus->s3) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>
                </div>

                {{-- ORGANISASI & PENGKADERAN --}}
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🏢
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Organisasi & Pengkaderan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Perbarui riwayat organisasi, pengkaderan, dan jabatan pengurus.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pengkaderan Fatayat
                            </label>

                            <input type="text" name="pengkaderan_fatayat"
                                value="{{ old('pengkaderan_fatayat', $pengurus->pengkaderan_fatayat) }}"
                                placeholder="PKD, PKL, PKN, dll."
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pengkaderan NU
                            </label>

                            <input type="text" name="pengkaderan_nu"
                                value="{{ old('pengkaderan_nu', $pengurus->pengkaderan_nu) }}"
                                placeholder="MAPABA, PKPNU, dll."
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pengalaman Organisasi
                        </label>

                        <textarea name="pengalaman_organisasi" rows="4"
                            placeholder="Tuliskan pengalaman organisasi di dalam maupun di luar Fatayat NU"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('pengalaman_organisasi', $pengurus->pengalaman_organisasi) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan', $pengurus->jabatan) }}"
                                placeholder="Contoh: Ketua, Sekretaris, Bendahara"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal PR</label>
                            <input type="text" name="asal_pr" value="{{ old('asal_pr', $pengurus->asal_pr) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Asal PAR</label>
                            <input type="text" name="asal_par" value="{{ old('asal_par', $pengurus->asal_par) }}"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pelatihan yang Pernah Diikuti
                        </label>

                        <textarea name="pelatihan" rows="4"
                            placeholder="Tuliskan pelatihan, workshop, seminar, atau diklat yang pernah diikuti"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('pelatihan', $pengurus->pelatihan) }}</textarea>
                    </div>
                </div>

                {{-- POTENSI & PRESTASI --}}
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="flex items-center gap-2">
                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            ✨
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Potensi & Prestasi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Perbarui potensi, usaha, dan prestasi yang dimiliki pengurus.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Potensi yang Dimiliki</label>

                            <textarea name="potensi" rows="4"
                                placeholder="Contoh: Public speaking, desain grafis, administrasi, kewirausahaan"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('potensi', $pengurus->potensi) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Produk / Usaha yang
                                Dimiliki</label>

                            <textarea name="produk_usaha" rows="4" placeholder="Tuliskan usaha atau produk yang sedang dijalankan"
                                class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('produk_usaha', $pengurus->produk_usaha) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Prestasi atau Penghargaan
                        </label>

                        <textarea name="prestasi" rows="4"
                            placeholder="Tuliskan prestasi, penghargaan, atau pencapaian yang pernah diraih"
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('prestasi', $pengurus->prestasi) }}</textarea>
                    </div>
                </div>

                {{-- DOKUMEN --}}
                <div class="border-t border-gray-100 pt-8 space-y-6">

                    <div class="border-t border-gray-100 pt-8 space-y-6">

                        <div class="flex items-center gap-2">
                            <div
                                class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                                📎</div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Dokumen & Lampiran</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Unggah dokumen jika ingin merubahnya.</p>
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
                </div>

                {{-- ACTION BUTTONS --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a href="{{ route('pengurus.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        💾 Perbarui Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
