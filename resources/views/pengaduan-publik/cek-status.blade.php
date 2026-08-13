<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Cek Status Pengaduan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-16">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-xl font-bold text-center mb-4">Cek Status Pengaduan</h1>

            <form action="{{ route('pengaduan.publik.cari') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-medium">Nomor Pengaduan</label>
                    <input type="text" name="no_pengaduan" value="{{ old('no_pengaduan') }}"
                        placeholder="misal: PGD-2026-0001" class="w-full border rounded p-2">
                    @error('no_pengaduan')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">Cek Status</button>
            </form>

            <a href="{{ route('pengaduan.publik.create') }}" class="text-blue-600 text-sm block text-center mt-4">Buat
                Pengaduan Baru</a>
        </div>
    </div>
</body>

</html>
