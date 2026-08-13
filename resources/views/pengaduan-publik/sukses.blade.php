<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Pengaduan Terkirim</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-16">
    <div class="max-w-md mx-auto px-4 text-center bg-white p-8 rounded shadow">
        <h1 class="text-xl font-bold text-green-600 mb-2">Pengaduan Berhasil Dikirim</h1>
        <p class="text-gray-600 mb-4">Simpan nomor pengaduan ini untuk memantau status laporan Anda:</p>
        <p class="text-2xl font-bold border-2 border-dashed p-3 rounded">{{ $noPengaduan }}</p>
        <a href="{{ route('pengaduan.publik.create') }}" class="text-blue-600 mt-4 inline-block">Buat Pengaduan Lain</a>
    </div>
</body>

</html>
