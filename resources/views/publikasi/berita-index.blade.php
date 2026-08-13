<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Berita Kegiatan - Fatayat NU PAC Pragaan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mb-6">Berita Kegiatan Fatayat NU PAC Pragaan</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($berita as $item)
                <a href="{{ route('berita.publik.show', $item->id) }}"
                    class="bg-white rounded shadow overflow-hidden hover:shadow-md">
                    @if ($item->gambar_utama)
                        <img src="{{ Storage::url($item->gambar_utama) }}" class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-200"></div>
                    @endif
                    <div class="p-3">
                        <p class="text-xs text-gray-500">{{ $item->kategori }} &middot; {{ $item->tanggal_kegiatan }}
                        </p>
                        <h3 class="font-semibold">{{ $item->judul }}</h3>
                        <p class="text-sm text-gray-500">Oleh {{ $item->penulis }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-3 text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
            @endforelse
        </div>

        <div class="mt-6">{{ $berita->links() }}</div>
    </div>
</body>

</html>
