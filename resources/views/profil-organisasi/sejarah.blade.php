<x-app-layout>
    <x-slot name="header">
        Sejarah
    </x-slot>

<div class="space-y-6 max-w-5xl mx-auto">

    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="rounded-3xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm">
            <div class="flex items-start gap-3">
                <div
                    class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                    ✅
                </div>

                <div>
                    <p class="font-semibold text-green-900">Berhasil</p>
                    <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- BANNER --}}
    <div
        class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm backdrop-blur-sm">

        <div class="flex items-start gap-3">

            <div
                class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg flex-shrink-0">
                📖
            </div>

            <div class="min-w-0">
                <h1 class="text-base font-semibold text-green-900 leading-tight">
                    Profil Organisasi - Sejarah
                </h1>

                <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                    Kelola konten <span class="font-semibold text-green-900">sejarah organisasi Fatayat NU</span>
                    yang akan ditampilkan pada halaman profil organisasi.
                </p>
            </div>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Sejarah Organisasi</h2>
            <p class="text-sm text-gray-500 mt-1">
                Lengkapi informasi sejarah organisasi dengan benar sebelum menyimpan perubahan.
            </p>
        </div>

        <form action="{{ route('profil-organisasi.sejarah.update') }}" method="POST"
            enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            {{-- INFORMASI UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Utama
                    </label>

                    <input type="text" name="judul_utama"
                        value="{{ old('judul_utama', $profil->judul_utama) }}"
                        placeholder="Contoh: Sejarah Fatayat Nahdlatul Ulama"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                    @error('judul_utama')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sub Judul
                    </label>

                    <input type="text" name="sub_judul"
                        value="{{ old('sub_judul', $profil->sub_judul) }}"
                        placeholder="Sub judul atau tagline sejarah organisasi"
                        class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                    @error('sub_judul')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- GAMBAR SAMPUL --}}
            <div class="border-t border-gray-100 pt-6">

                <div class="flex items-center gap-2 mb-4">

                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        🖼️
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Gambar Sampul</h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Unggah gambar sampul yang akan ditampilkan pada halaman sejarah organisasi.
                        </p>
                    </div>
                </div>

                @if ($profil->gambar_sampul)
                    <div class="mb-4">
                        <img src="{{ Storage::url($profil->gambar_sampul) }}"
                            class="w-full max-w-md h-48 object-cover rounded-2xl border border-gray-200 shadow-sm"
                            alt="Gambar Sampul Sejarah">
                    </div>
                @endif

                <input type="file" name="gambar_sampul" accept="image/jpeg,image/png"
                    class="block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-green-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-green-700 hover:file:bg-green-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                <p class="text-xs text-gray-500 mt-2">
                    Format yang didukung: JPG dan PNG.
                </p>

                @error('gambar_sampul')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- KONTEN SEJARAH --}}
            <div class="border-t border-gray-100 pt-6">

                <div class="flex items-center gap-2 mb-4">

                    <div
                        class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                        📝
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Konten Sejarah</h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Tulis narasi sejarah organisasi yang akan ditampilkan kepada pengunjung.
                        </p>
                    </div>
                </div>

                <textarea name="konten_sejarah" rows="10"
                    placeholder="Tuliskan sejarah organisasi Fatayat NU di sini..."
                    class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none">{{ old('konten_sejarah', $profil->konten_sejarah) }}</textarea>

                @error('konten_sejarah')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTION BUTTONS --}}
            <div
                class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>