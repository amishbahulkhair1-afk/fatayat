<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Form Pengaduan - Fatayat NU PAC Pragaan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mb-2">Form Pengaduan Masyarakat</h1>
        <p class="text-center text-gray-500 mb-6">Fatayat NU PAC Pragaan</p>

        <form action="{{ route('pengaduan.publik.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Kategori Pengaduan</label>
                <select name="kategori" class="w-full border rounded p-2">
                    <option value="">-- Pilih --</option>
                    @foreach ($kategoriList as $k)
                        <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>
                            {{ $k }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Jenis Kekerasan (jika ada)</label>
                <select name="jenis_kekerasan" class="w-full border rounded p-2">
                    <option value="">-- Tidak Ada --</option>
                    @foreach ($jenisKekerasanList as $j)
                        <option value="{{ $j }}" {{ old('jenis_kekerasan') == $j ? 'selected' : '' }}>
                            {{ $j }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Tanggal Kejadian</label>
                <input type="date" name="tanggal_pengaduan" value="{{ old('tanggal_pengaduan') }}"
                    class="w-full border rounded p-2">
                @error('tanggal_pengaduan')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Nama Pelapor</label>
                <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
                    class="w-full border rounded p-2">
                @error('nama_pelapor')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Kontak (No. HP/Email)</label>
                <input type="text" name="kontak_pelapor" value="{{ old('kontak_pelapor') }}"
                    class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Isi Pengaduan</label>
                <textarea name="isi_pengaduan" rows="5" class="w-full border rounded p-2">{{ old('isi_pengaduan') }}</textarea>
                @error('isi_pengaduan')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Bukti Pendukung (opsional)</label>
                <input type="file" name="bukti_pendukung" accept="image/jpeg,image/png,application/pdf"
                    class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">Kirim Pengaduan</button>
        </form>
    </div>
</body>

</html>
