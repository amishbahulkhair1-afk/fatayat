<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Program Kerja - {{ $lembaga->nama_lembaga }}</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('lembaga.program-kerja.update', [$lembaga->id, $program_kerja->id]) }}" method="POST"
            class="bg-white p-6 rounded shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Nama Program Kerja</label>
                <input type="text" name="nama_program_kerja"
                    value="{{ old('nama_program_kerja', $program_kerja->nama_program_kerja) }}"
                    class="w-full border rounded p-2">
                @error('nama_program_kerja')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded p-2">{{ old('deskripsi', $program_kerja->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="Tidak Selesai"
                        {{ old('status', $program_kerja->status) == 'Tidak Selesai' ? 'selected' : '' }}>Tidak Selesai
                    </option>
                    <option value="Selesai" {{ old('status', $program_kerja->status) == 'Selesai' ? 'selected' : '' }}>
                        Selesai</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('lembaga.program-kerja.index', $lembaga->id) }}"
                    class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
