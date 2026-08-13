<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Notulen</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('notulen.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Kegiatan Terkait (opsional)</label>
                <select name="kegiatan_id" class="w-full border rounded p-2">
                    <option value="">-- Tidak Terkait --</option>
                    @foreach ($kegiatan as $k)
                        <option value="{{ $k->id }}" {{ old('kegiatan_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kegiatan }} ({{ $k->tanggal_kegiatan }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Judul Notulen</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded p-2">
                @error('judul')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full border rounded p-2">
                @error('tanggal')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Pemimpin Rapat</label>
                    <input type="text" name="pemimpin_rapat" value="{{ old('pemimpin_rapat') }}"
                        class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block font-medium">Notulis</label>
                    <input type="text" name="notulis" value="{{ old('notulis') }}"
                        class="w-full border rounded p-2">
                </div>
            </div>

            <div>
                <label class="block font-medium">Isi Notulen</label>
                <textarea name="isi_notulen" rows="8" class="w-full border rounded p-2">{{ old('isi_notulen') }}</textarea>
                @error('isi_notulen')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">File Lampiran (opsional)</label>
                <input type="file" name="file_lampiran" accept=".pdf,.doc,.docx" class="w-full border rounded p-2">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('notulen.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
