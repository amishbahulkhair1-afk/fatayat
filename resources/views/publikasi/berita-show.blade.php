<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>{{ $berita->judul }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <a href="{{ route('berita.publik.index') }}" class="text-blue-600 text-sm">&larr; Kembali ke Daftar Berita</a>

        <div class="bg-white rounded shadow overflow-hidden mt-4">
            @if ($berita->gambar_utama)
                <img src="{{ Storage::url($berita->gambar_utama) }}" class="w-full h-64 object-cover">
            @endif
            <div class="p-6">
                <p class="text-sm text-gray-500">{{ $berita->kategori }} &middot; {{ $berita->tanggal_kegiatan }}
                    @if ($berita->lokasi)
                        &middot; {{ $berita->lokasi }}
                    @endif
                </p>
                <h1 class="text-2xl font-bold mt-1 mb-2">{{ $berita->judul }}</h1>
                <p class="text-sm text-gray-500 mb-4">Oleh {{ $berita->penulis }}</p>
                <div class="prose max-w-none whitespace-pre-line">{{ $berita->isi_berita }}</div>
            </div>
        </div>
    </div>
</body>

</html>
