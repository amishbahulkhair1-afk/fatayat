<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Data Tamu</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        <form action="{{ route('buku-tamu.update', $bukuTamu->id) }}" method="POST"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf
            @method('PUT')

            {{-- Header --}}
            <div class="border-b border-gray-100 pb-4">
                <h3 class="text-lg font-semibold text-gray-900">Form Edit Data Tamu</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi kunjungan tamu atau instansi yang datang ke PAC Fatayat NU Pragaan.
                </p>
            </div>

            {{-- Nama Tamu --}}
            <div>
                <x-ui.input name="nama_tamu" label="Nama Tamu" :value="old('nama_tamu', $bukuTamu->nama_tamu)"
                    placeholder="Masukkan nama lengkap tamu" />

                @error('nama_tamu')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Instansi --}}
            <div>
                <x-ui.input name="asal_instansi" label="Asal Instansi" :value="old('asal_instansi', $bukuTamu->asal_instansi)"
                    placeholder="Contoh: Kecamatan Pragaan, NU Cabang Sumenep, atau organisasi lain" />
            </div>

            {{-- Tujuan --}}
            <div>
                <x-ui.input name="tujuan_kunjungan" label="Tujuan Kunjungan" :value="old('tujuan_kunjungan', $bukuTamu->tujuan_kunjungan)"
                    placeholder="Contoh: Silaturahmi, koordinasi program, konsultasi administrasi, dan lain-lain" />

                @error('tujuan_kunjungan')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal & Jam --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <div>
                    <x-ui.date-input name="tanggal_kunjungan" label="Tanggal Kunjungan" :value="old('tanggal_kunjungan', $bukuTamu->tanggal_kunjungan)" />

                    @error('tanggal_kunjungan')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-ui.time-input name="jam_kunjungan" label="Jam Kunjungan" :value="old('jam_kunjungan', $bukuTamu->jam_kunjungan)" />
                </div>
            </div>

            {{-- Kontak --}}
            <div>
                <x-ui.input name="kontak" label="Kontak" :value="old('kontak', $bukuTamu->kontak)"
                    placeholder="Nomor telepon atau WhatsApp yang bisa dihubungi" />
            </div>

            {{-- Keterangan --}}
            <div>
                <x-ui.textarea name="keterangan" label="Keterangan Tambahan" rows="5"
                    placeholder="Tambahkan catatan tambahan mengenai kunjungan, pihak yang ditemui, atau hal penting lainnya...">{{ old('keterangan', $bukuTamu->keterangan) }}</x-ui.textarea>
            </div>

            {{-- Action --}}
            <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                <a href="{{ route('buku-tamu.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800 transition shadow-lg shadow-blue-700/20">

                    💾 Update Data Tamu
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
