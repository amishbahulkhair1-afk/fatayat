<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Program Kerja - {{ $lembaga->nama_lembaga }}</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('lembaga.program-kerja.create', $lembaga->id) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded inline-block mb-4">
            + Tambah Program Kerja
        </a>

        <table class="w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Nama Program Kerja</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programKerja as $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $item->nama_program_kerja }}</td>
                        <td class="p-2">
                            <span
                                class="px-2 py-1 rounded text-sm {{ $item->status == 'Selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="p-2">
                            <a href="{{ route('lembaga.program-kerja.edit', [$lembaga->id, $item->id]) }}"
                                class="text-blue-600">Edit</a>
                            <form action="{{ route('lembaga.program-kerja.destroy', [$lembaga->id, $item->id]) }}"
                                method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-2 text-center text-gray-500">Belum ada program kerja</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $programKerja->links() }}</div>

        <a href="{{ route('lembaga.index') }}" class="text-gray-600 mt-4 inline-block">&larr; Kembali ke Daftar
            Lembaga</a>
    </div>
</x-app-layout>
