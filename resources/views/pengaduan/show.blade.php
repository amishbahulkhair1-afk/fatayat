<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Pengaduan</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto space-y-6">

        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Detail Pengaduan --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                <div>
                    <p class="text-sm text-gray-500">Nomor Pengaduan</p>
                    <h3 class="text-xl font-semibold text-gray-900 mt-1">
                        {{ $pengaduan->no_pengaduan }}
                    </h3>
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

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 text-sm">

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

                <div>
                    <p class="text-gray-500 mb-1">Tanggal Pengaduan</p>
                    <p class="font-medium text-gray-900">
                        {{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 mb-1">Nama Pelapor</p>
                    <p class="font-medium text-gray-900">
                        {{ $pengaduan->nama_pelapor }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500 mb-1">Kontak Pelapor</p>
                    <p class="font-medium text-gray-900">
                        {{ $pengaduan->kontak_pelapor ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- Isi Pengaduan --}}
            <div class="space-y-2">
                <p class="text-sm font-medium text-gray-700">Isi Pengaduan</p>

                <div
                    class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $pengaduan->isi_pengaduan }}
                </div>
            </div>

            {{-- Bukti Pendukung --}}
            @if ($pengaduan->bukti_pendukung)
                <div class="space-y-2">
                    <p class="text-sm font-medium text-gray-700">Bukti Pendukung</p>

                    <a href="{{ Storage::url($pengaduan->bukti_pendukung) }}" target="_blank"
                        class="inline-flex items-center gap-2 rounded-2xl bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-100 transition">

                        📎 Lihat File Bukti
                    </a>
                </div>
            @endif

            {{-- Tanggapan Admin --}}
            @if ($pengaduan->tanggapan_admin)
                <div class="space-y-2">
                    <p class="text-sm font-medium text-gray-700">Tanggapan Admin</p>

                    <div
                        class="rounded-2xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-800 leading-relaxed whitespace-pre-line">
                        {{ $pengaduan->tanggapan_admin }}
                    </div>
                </div>
            @endif

        </div>

        {{-- Aksi --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between">

                <a href="{{ route('pengaduan.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Kembali ke Daftar
                </a>

                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:justify-end">

                    @if ($pengaduan->status == 'Baru')
                        <form action="{{ route('pengaduan.tolak', $pengaduan->id) }}" method="POST"
                            onsubmit="return confirm('Yakin menolak pengaduan ini?')">

                            @csrf

                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-5 py-3 text-sm font-semibold text-white hover:bg-red-700 transition shadow-lg shadow-red-600/20">

                                ❌ Tolak Pengaduan
                            </button>
                        </form>

                        <form action="{{ route('pengaduan.proses', $pengaduan->id) }}" method="POST">

                            @csrf

                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-2xl bg-yellow-500 px-5 py-3 text-sm font-semibold text-white hover:bg-yellow-600 transition shadow-lg shadow-yellow-500/20">

                                ⏳ Proses Pengaduan
                            </button>
                        </form>
                    @elseif($pengaduan->status == 'Diproses')
                        <a href="{{ route('pengaduan.edit', $pengaduan->id) }}"
                            class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">

                            ✏️ Beri Tanggapan
                        </a>

                        <form action="{{ route('pengaduan.selesai', $pengaduan->id) }}" method="POST">

                            @csrf

                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                                ✅ Tandai Selesai
                            </button>
                        </form>
                    @elseif($pengaduan->status == 'Selesai')
                        <a href="{{ route('pengaduan.edit', $pengaduan->id) }}"
                            class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">

                            ✏️ Edit Tanggapan
                        </a>
                    @endif

                </div>
            </div>

        </div>

    </div>
</x-app-layout>
