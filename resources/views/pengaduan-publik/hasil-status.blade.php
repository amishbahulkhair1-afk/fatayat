<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Status Pengaduan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-16">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white p-6 rounded shadow space-y-3">
            <h1 class="text-xl font-bold text-center mb-2">Status Pengaduan</h1>

            <div>
                <p class="text-gray-500 text-sm">Nomor Pengaduan</p>
                <p class="font-medium">{{ $pengaduan->no_pengaduan }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Status Saat Ini</p>
                <span
                    class="inline-block px-3 py-1 rounded text-sm
                    {{ $pengaduan->status == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $pengaduan->status == 'Diproses' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $pengaduan->status == 'Ditolak' ? 'bg-red-100 text-red-700' : '' }}
                    {{ $pengaduan->status == 'Baru' ? 'bg-gray-100 text-gray-700' : '' }}">
                    {{ $pengaduan->status }}
                </span>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Tanggal Diajukan</p>
                <p>{{ $pengaduan->tanggal_pengaduan }}</p>
            </div>

            @if ($pengaduan->tanggapan_admin)
                <div>
                    <p class="text-gray-500 text-sm">Tanggapan dari Admin</p>
                    <p class="bg-gray-50 p-3 rounded">{{ $pengaduan->tanggapan_admin }}</p>
                </div>
            @else
                <p class="text-gray-400 text-sm italic">Belum ada tanggapan dari admin.</p>
            @endif

            <a href="{{ route('pengaduan.publik.cek') }}" class="text-blue-600 text-sm block text-center mt-4">Cek Nomor
                Lain</a>
        </div>
    </div>
</body>

</html>
