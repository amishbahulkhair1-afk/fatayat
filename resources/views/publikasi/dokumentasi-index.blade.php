<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Dokumentasi Kegiatan - Fatayat NU PAC Pragaan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mb-6">Dokumentasi Kegiatan Fatayat NU PAC Pragaan</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($dokumentasi as $item)
                <div class="bg-white rounded shadow overflow-hidden">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-32 object-cover">
                    @else
                        <div class="w-full h-32 bg-gray-200"></div>
                    @endif
                    <div class="p-2">
                        <p class="text-xs text-gray-500">{{ $item->kategori }}</p>
                        <p class="font-medium text-sm">{{ $item->judul_dokumentasi }}</p>
                        <p class="text-xs text-gray-400">{{ $item->tanggal_kegiatan }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">Belum ada dokumentasi yang dipublikasikan.</p>
            @endforelse
        </div>

        <div class="mt-6">{{ $dokumentasi->links() }}</div>
    </div>
</body>

</html>
