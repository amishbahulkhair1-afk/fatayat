<x-app-layout>
    <x-slot name="header">
        Struktur
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
                    🏛️
                </div>

                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Profil Organisasi - Struktur Kepengurusan
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Kelola <span class="font-semibold text-green-900">foto struktur kepengurusan organisasi</span>
                        yang akan ditampilkan pada halaman profil organisasi.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Struktur Kepengurusan</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Unggah atau perbarui foto struktur kepengurusan organisasi yang akan ditampilkan kepada pengunjung.
                </p>
            </div>

            <form action="{{ route('profil-organisasi.struktur.update') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf

                {{-- FOTO STRUKTUR --}}
                <div class="space-y-4">

                    <div class="flex items-center gap-2">

                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🖼️
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Foto Struktur Kepengurusan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Unggah gambar struktur organisasi terbaru dengan format JPG atau PNG.
                            </p>
                        </div>
                    </div>

                    <div
                        class="rounded-3xl border-2 border-dashed border-green-200 bg-green-50/40 p-6 text-center space-y-4">

                        @if ($profil->foto_struktur)
                            <div class="flex justify-center">
                                <img src="{{ Storage::url($profil->foto_struktur) }}"
                                    class="w-full max-w-3xl rounded-2xl border border-gray-200 shadow-sm object-contain"
                                    alt="Struktur Kepengurusan">
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center gap-3 py-6 text-gray-400">

                                <div
                                    class="w-16 h-16 rounded-full bg-white border border-green-100 flex items-center justify-center text-2xl shadow-sm">
                                    🏛️
                                </div>

                                <div>
                                    <p class="font-medium text-gray-500">Belum ada foto struktur kepengurusan</p>
                                    <p class="text-sm text-gray-400 mt-1">
                                        Silakan unggah foto struktur organisasi untuk ditampilkan pada halaman profil.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="space-y-2">

                            <input type="file" name="foto_struktur" accept="image/jpeg,image/png"
                                class="block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-green-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-green-700 hover:file:bg-green-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">

                            <p class="text-xs text-gray-500">
                                Format yang didukung: JPG dan PNG.
                            </p>
                        </div>

                        @error('foto_struktur')
                            <p class="text-red-600 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div
                    class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a href="{{ route('profil-organisasi.struktur') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                        💾 Simpan Struktur
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
