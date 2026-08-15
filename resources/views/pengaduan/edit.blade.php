<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tanggapan Pengaduan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        @if ($errors->any())
            <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf
            @method('PUT')

            {{-- Informasi Pengaduan --}}
            <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5 space-y-4">

                <div class="flex flex-col gap-2 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Nomor Pengaduan</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $pengaduan->no_pengaduan }}
                        </p>
                    </div>

                    <span
                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                        {{ $pengaduan->status == 'Selesai'
                            ? 'bg-green-50 text-green-700 border-green-100'
                            : ($pengaduan->status == 'Diproses'
                                ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                                : ($pengaduan->status == 'Ditolak'
                                    ? 'bg-red-50 text-red-700 border-red-100'
                                    : 'bg-gray-50 text-gray-700 border-gray-100')) }}">

                        {{ $pengaduan->status }}
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 text-sm">

                    <div>
                        <p class="text-gray-500 mb-1">Nama Pelapor</p>
                        <p class="font-medium text-gray-900">
                            {{ $pengaduan->nama_pelapor }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-1">Tanggal Pengaduan</p>
                        <p class="font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-1">Kategori</p>
                        <p class="font-medium text-gray-900">
                            {{ $pengaduan->kategori }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-1">Jenis Kekerasan</p>
                        <p class="font-medium text-gray-900">
                            {{ $pengaduan->jenis_kekerasan ?? '-' }}
                        </p>
                    </div>
                </div>

                @if ($pengaduan->isi_pengaduan)
                    <div>
                        <p class="text-gray-500 text-sm mb-2">Isi Pengaduan</p>
                        <div
                            class="rounded-2xl border border-gray-100 bg-white px-4 py-3 text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $pengaduan->isi_pengaduan }}
                        </div>
                    </div>
                @endif

            </div>

            {{-- Tanggapan Admin --}}
            <div class="space-y-2">

                <label class="block text-sm font-medium text-gray-700">
                    Tanggapan Admin
                </label>

                <x-ui.textarea name="tanggapan_admin" rows="6"
                    placeholder="Tuliskan hasil verifikasi, tindak lanjut, atau tanggapan resmi terhadap pengaduan ini...">{{ old('tanggapan_admin', $pengaduan->tanggapan_admin) }}</x-ui.textarea>

                @error('tanggapan_admin')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:justify-end">

                <a href="{{ route('pengaduan.show', $pengaduan->id) }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    💾 Simpan Tanggapan
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
