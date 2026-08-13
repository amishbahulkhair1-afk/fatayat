<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Surat {{ $jenis }}</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow space-y-4">
            @csrf
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <div>
                <label class="block font-medium">Nomor Surat</label>
                <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}"
                    class="w-full border rounded p-2">
                @error('nomor_surat')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Tanggal {{ $jenis == 'Masuk' ? 'Terima' : 'Kirim' }}</label>
                <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full border rounded p-2">
                @error('tanggal')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">{{ $jenis == 'Masuk' ? 'Pengirim' : 'Tujuan' }}</label>
                <input type="text" name="pengirim_tujuan" value="{{ old('pengirim_tujuan') }}"
                    class="w-full border rounded p-2">
                @error('pengirim_tujuan')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Perihal</label>
                <input type="text" name="perihal" value="{{ old('perihal') }}" class="w-full border rounded p-2">
                @error('perihal')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Jenis Surat</label>
                <select name="jenis_surat" class="w-full border rounded p-2">
                    <option value="">-- Pilih --</option>
                    @foreach ($jenisSuratList as $j)
                        <option value="{{ $j }}" {{ old('jenis_surat') == $j ? 'selected' : '' }}>
                            {{ $j }}</option>
                    @endforeach
                </select>
                @error('jenis_surat')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Sifat Surat</label>
                <select name="sifat_surat" class="w-full border rounded p-2">
                    <option value="">-- Pilih --</option>
                    @foreach ($sifatList as $s)
                        <option value="{{ $s }}" {{ old('sifat_surat') == $s ? 'selected' : '' }}>
                            {{ $s }}</option>
                    @endforeach
                </select>
                @error('sifat_surat')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">File Surat</label>
                <input type="file" name="file_surat" accept="image/jpeg,image/png,application/pdf"
                    class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded p-2">{{ old('keterangan') }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('surat.index', ['jenis' => $jenis]) }}"
                    class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
