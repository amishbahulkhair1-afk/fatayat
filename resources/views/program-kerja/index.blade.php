<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Proker
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto space-y-6">

        {{-- Alert --}}
        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header Card --}}
        <div
            class="rounded-3xl border border-green-200/60 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 px-5 py-4 shadow-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Program Kerja Lembaga
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola daftar program kerja untuk lembaga
                        <span class="font-medium text-gray-700">
                            {{ $lembaga->nama_lembaga }}
                        </span>.
                    </p>
                </div>

                <a href="{{ route('lembaga.program-kerja.create', $lembaga->id) }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    ➕ Tambah Program Kerja
                </a>
            </div>

        </div>

        {{-- Tabel --}}
        <div class="rounded-3xl border border-gray-100 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">

                <div>
                    <h3 class="font-semibold text-gray-900">Daftar Program Kerja</h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Total data: {{ $programKerja->total() }} program kerja
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-100 text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">
                                Nama Program Kerja
                            </th>

                            <th class="px-4 py-3 text-left font-semibold text-gray-600 w-48">
                                Status
                            </th>

                            <th class="px-4 py-3 text-left font-semibold text-gray-600 w-44">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @forelse($programKerja as $item)
                            <tr class="hover:bg-gray-50/70 transition">

                                <td class="px-4 py-4">

                                    <div class="font-medium text-gray-900">
                                        {{ $item->nama_program_kerja }}
                                    </div>

                                </td>

                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold border
                                        {{ $item->status == 'Selesai'
                                            ? 'bg-green-50 text-green-700 border-green-100'
                                            : 'bg-yellow-50 text-yellow-700 border-yellow-100' }}">

                                        {{ $item->status }}
                                    </span>

                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('lembaga.program-kerja.edit', [$lembaga->id, $item->id]) }}"
                                            class="inline-flex items-center rounded-xl bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">

                                            ✏️ Edit
                                        </a>

                                        <form
                                            action="{{ route('lembaga.program-kerja.destroy', [$lembaga->id, $item->id]) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Yakin hapus program kerja ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center rounded-xl bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100 transition">

                                                🗑 Hapus
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-gray-500">

                                    <div class="flex flex-col items-center gap-2">

                                        <div class="text-4xl">📋</div>

                                        <p class="font-medium">
                                            Belum ada program kerja.
                                        </p>

                                        <p class="text-sm text-gray-400">
                                            Tambahkan program kerja pertama untuk lembaga ini.
                                        </p>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>

        {{-- Pagination --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <a href="{{ route('lembaga.index') }}"
                class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                ← Kembali ke Daftar Lembaga
            </a>

            <div class="flex justify-end">
                {{ $programKerja->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
