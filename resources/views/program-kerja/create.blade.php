<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Proker
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">

        <form action="{{ route('lembaga.program-kerja.store', $lembaga->id) }}" method="POST"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-5">

            @csrf

            {{-- Nama Program --}}
            <x-ui.input name="nama_program_kerja" label="Nama Program Kerja" :value="old('nama_program_kerja')" required />

            {{-- Deskripsi --}}
            <x-ui.textarea name="deskripsi" label="Deskripsi" rows="4">{{ old('deskripsi') }}</x-ui.textarea>

            {{-- Status --}}
            <div x-data="{
                labelStatus: '{{ old('status', 'Tidak Selesai') }}'
            }" class="space-y-2">

                <label class="block text-sm font-medium text-gray-700">
                    Status
                </label>

                <input type="hidden" name="status" value="{{ old('status', 'Tidak Selesai') }}">

                <x-ui.dropdown width="64" align="left">

                    <x-slot name="trigger">
                        <button type="button"
                            class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                            <span x-text="labelStatus"></span>

                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <button type="button"
                            @click="$el.closest('[x-data]').querySelector('input[name=status]').value = 'Tidak Selesai'; labelStatus = 'Tidak Selesai'"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">

                            <span class="h-2.5 w-2.5 rounded-full bg-yellow-500"></span>
                            Tidak Selesai
                        </button>

                        <button type="button"
                            @click="$el.closest('[x-data]').querySelector('input[name=status]').value = 'Selesai'; labelStatus = 'Selesai'"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">

                            <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                            Selesai
                        </button>

                    </x-slot>
                </x-ui.dropdown>

                @error('status')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-2">

                <a href="{{ route('lembaga.program-kerja.index', $lembaga->id) }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                    Simpan
                </button>

            </div>

        </form>

    </div>
</x-app-layout>
