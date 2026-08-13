<x-app-layout>
    <x-slot name="header">
        Pengelolaan Visi dan Misi
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
                    🎯
                </div>

                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-green-900 leading-tight">
                        Profil Organisasi - Visi & Misi
                    </h1>

                    <p class="text-xs text-green-800/80 mt-1 leading-relaxed">
                        Kelola <span class="font-semibold text-green-900">visi dan misi organisasi PAC Pragaan</span>
                        yang akan ditampilkan pada halaman publik profil organisasi.
                    </p>
                </div>
            </div>
        </div>

        {{-- INFO --}}
        <div class="rounded-3xl border border-blue-200 bg-blue-50 px-5 py-4 text-blue-700 shadow-sm">
            <div class="flex items-start gap-3">
                <div
                    class="h-10 w-10 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-700 text-lg flex-shrink-0">
                    ℹ️
                </div>

                <div>
                    <p class="font-semibold text-blue-900">Informasi</p>
                    <p class="text-sm text-blue-700 mt-1">
                        Perubahan visi dan misi akan langsung memengaruhi tampilan halaman publik profil organisasi.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-3xl bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Visi & Misi</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Lengkapi visi dan misi organisasi dengan jelas dan mudah dipahami.
                </p>
            </div>

            <form action="{{ route('profil-organisasi.visi-misi.update') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- VISI --}}
                <div class="space-y-4">

                    <div class="flex items-center gap-2">

                        <div
                            class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                            🌟
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Visi Organisasi</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Tuliskan visi utama organisasi sebagai arah dan cita-cita jangka panjang.
                            </p>
                        </div>
                    </div>

                    <div>
                        <textarea name="visi" id="visiInput" maxlength="500" rows="4" placeholder="Tuliskan visi organisasi..."
                            class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition resize-none"
                            oninput="hitungKarakter()">{{ old('visi', $profil->visi) }}</textarea>

                        <div class="flex justify-between items-center mt-2">
                            <p class="text-xs text-gray-500">
                                Maksimal 500 karakter.
                            </p>

                            <p class="text-xs font-medium text-gray-600">
                                <span id="jumlahKarakter">0</span>/500
                            </p>
                        </div>

                        @error('visi')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- MISI --}}
                <div class="border-t border-gray-100 pt-6 space-y-4">

                    <div class="flex items-center justify-between gap-4 flex-wrap">

                        <div class="flex items-center gap-2">

                            <div
                                class="h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700 text-sm">
                                📌
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Misi Organisasi</h3>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    Tambahkan poin-poin misi organisasi yang mendukung tercapainya visi.
                                </p>
                            </div>
                        </div>

                        <button type="button" onclick="tambahMisi()"
                            class="inline-flex items-center justify-center rounded-2xl border border-green-200 bg-green-50 px-4 py-2 text-sm font-semibold text-green-700 hover:bg-green-100 transition">
                            ➕ Tambah Misi
                        </button>
                    </div>

                    <div id="daftarMisi" class="space-y-3">

                        @forelse ($profil->misi as $i => $m)
                            <div
                                class="misi-item flex items-start gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-4">

                                <div
                                    class="mt-1 h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-xs font-semibold text-green-700 flex-shrink-0">
                                    {{ $i + 1 }}
                                </div>

                                <div class="flex-1">

                                    <input type="hidden" name="misi[{{ $i }}][id]"
                                        value="{{ $m->id }}">

                                    <input type="text" name="misi[{{ $i }}][isi_misi]"
                                        value="{{ $m->isi_misi }}" placeholder="Tuliskan poin misi organisasi"
                                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
                                </div>

                                <button type="button" onclick="this.parentElement.remove()"
                                    class="inline-flex items-center justify-center h-10 w-10 rounded-xl border border-red-200 bg-white text-red-600 hover:bg-red-50 transition flex-shrink-0">
                                    🗑️
                                </button>
                            </div>
                        @empty
                            <div
                                class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada misi organisasi. Silakan tambahkan misi pertama.
                            </div>
                        @endforelse

                    </div>
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

    <script>
        let misiIndex = {{ $profil->misi->count() }};

        function tambahMisi() {
            const div = document.createElement('div');

            div.className =
                'misi-item flex items-start gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-4';

            div.innerHTML = `
            <div class="mt-1 h-8 w-8 rounded-xl bg-green-100 flex items-center justify-center text-xs font-semibold text-green-700 flex-shrink-0">
                ${misiIndex + 1}
            </div>

            <div class="flex-1">
                <input type="hidden" name="misi[${misiIndex}][id]" value="">

                <input type="text"
                    name="misi[${misiIndex}][isi_misi]"
                    placeholder="Tuliskan poin misi organisasi"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 shadow-sm focus:border-green-500 focus:ring-4 focus:ring-green-100 transition">
            </div>

            <button type="button"
                onclick="this.parentElement.remove()"
                class="inline-flex items-center justify-center h-10 w-10 rounded-xl border border-red-200 bg-white text-red-600 hover:bg-red-50 transition flex-shrink-0">
                🗑️
            </button>
        `;

            document.getElementById('daftarMisi').appendChild(div);

            misiIndex++;
        }

        function hitungKarakter() {
            const teks = document.getElementById('visiInput').value;
            document.getElementById('jumlahKarakter').textContent = teks.length;
        }

        // Jalankan sekali saat halaman dibuka
        hitungKarakter();
    </script>

</x-app-layout>
