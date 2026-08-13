<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tanggapan Pengaduan</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST"
            class="bg-white p-6 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <p><strong>No. Pengaduan:</strong> {{ $pengaduan->no_pengaduan }}</p>
            <p><strong>Pelapor:</strong> {{ $pengaduan->nama_pelapor }}</p>

            <div>
                <label class="block font-medium">Tanggapan Admin</label>
                <textarea name="tanggapan_admin" rows="5" class="w-full border rounded p-2">{{ old('tanggapan_admin', $pengaduan->tanggapan_admin) }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Tanggapan</button>
                <a href="{{ route('pengaduan.show', $pengaduan->id) }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
