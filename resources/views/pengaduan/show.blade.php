<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Pengaduan</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded shadow space-y-3">
            <h3 class="text-center font-semibold text-lg text-green-700">Detail Pengaduan</h3>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-gray-500">No. Pengaduan</p>
                    <p class="font-medium">{{ $pengaduan->no_pengaduan }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Status</p>
                    <p class="font-medium">{{ $pengaduan->status }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Kategori</p>
                    <p class="font-medium">{{ $pengaduan->kategori }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jenis Kekerasan</p>
                    <p class="font-medium">{{ $pengaduan->jenis_kekerasan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal Kejadian</p>
                    <p class="font-medium">{{ $pengaduan->tanggal_pengaduan }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Nama Pelapor</p>
                    <p class="font-medium">{{ $pengaduan->nama_pelapor }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Kontak</p>
                    <p class="font-medium">{{ $pengaduan->kontak_pelapor ?? '-' }}</p>
                </div>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Isi Pengaduan</p>
                <p>{{ $pengaduan->isi_pengaduan }}</p>
            </div>

            @if ($pengaduan->bukti_pendukung)
                <div>
                    <p class="text-gray-500 text-sm">Bukti Pendukung</p>
                    <a href="{{ Storage::url($pengaduan->bukti_pendukung) }}" target="_blank"
                        class="text-blue-600">Lihat File</a>
                </div>
            @endif

            @if ($pengaduan->tanggapan_admin)
                <div>
                    <p class="text-gray-500 text-sm">Tanggapan Admin</p>
                    <p>{{ $pengaduan->tanggapan_admin }}</p>
                </div>
            @endif

            <div class="flex gap-2 justify-center pt-4">
                @if ($pengaduan->status == 'Baru')
                    <form action="{{ route('pengaduan.tolak', $pengaduan->id) }}" method="POST"
                        onsubmit="return confirm('Yakin tolak pengaduan ini?')">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Tolak</button>
                    </form>
                    <form action="{{ route('pengaduan.proses', $pengaduan->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Proses</button>
                    </form>
                @elseif($pengaduan->status == 'Diproses')
                    <form action="{{ route('pengaduan.selesai', $pengaduan->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tandai Selesai</button>
                    </form>
                @endif
            </div>

            <a href="{{ route('pengaduan.index') }}" class="text-gray-600 block text-center mt-2">&larr; Kembali</a>
        </div>
    </div>
</x-app-layout>
