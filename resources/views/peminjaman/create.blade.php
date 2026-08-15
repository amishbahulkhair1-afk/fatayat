<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Catat Peminjaman</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        <form action="{{ route('peminjaman.store') }}" method="POST"
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm space-y-6">

            @csrf

            {{-- Barang --}}
            <div x-data="{
                openBarang: false,
                labelBarang: @js(old('inventaris_id') ? optional($inventaris->firstWhere('id', old('inventaris_id')))->nama_barang . ' (Stok tersedia: ' . optional($inventaris->firstWhere('id', old('inventaris_id')))->jumlah . ' ' . optional($inventaris->firstWhere('id', old('inventaris_id')))->satuan . ')' : 'Pilih Barang Inventaris')
            }" class="relative">

                <label class="block text-sm font-medium text-gray-700 mb-2">Barang Inventaris</label>

                <input type="hidden" name="inventaris_id" value="{{ old('inventaris_id') }}">

                <x-ui.dropdown width="80" align="left">
                    <x-slot name="trigger">
                        <button type="button" @click="openBarang = !openBarang"
                            class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                            <span x-text="labelBarang" class="truncate text-left"></span>

                            <svg class="w-4 h-4 text-gray-400 ml-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        @foreach ($inventaris as $item)
                            <button type="button"
                                @click="
                                    $el.closest('[x-data]').querySelector('input[name=inventaris_id]').value = '{{ $item->id }}';
                                    labelBarang = '{{ $item->nama_barang }} (Stok tersedia: {{ $item->jumlah }} {{ $item->satuan }})';
                                    openBarang = false;
                                "
                                class="flex w-full items-start gap-3 rounded-xl px-3 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition text-left">

                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-green-500 flex-shrink-0"></span>

                                <div class="min-w-0">
                                    <div class="font-medium truncate">{{ $item->nama_barang }}</div>
                                    <div class="text-xs text-gray-500 truncate">
                                        Stok tersedia: {{ $item->jumlah }} {{ $item->satuan }}
                                    </div>
                                </div>
                            </button>
                        @endforeach

                    </x-slot>
                </x-ui.dropdown>

                @error('inventaris_id')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Peminjam --}}
            <div x-data="{
                openPeminjam: false,
                labelPeminjam: @js(old('pengurus_id') ? optional($pengurus->firstWhere('id', old('pengurus_id')))->nama_lengkap : 'Pilih Peminjam')
            }" class="relative">

                <label class="block text-sm font-medium text-gray-700 mb-2">Peminjam</label>

                <input type="hidden" name="pengurus_id" value="{{ old('pengurus_id') }}">

                <x-ui.dropdown width="80" align="left">
                    <x-slot name="trigger">
                        <button type="button" @click="openPeminjam = !openPeminjam"
                            class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                            <span x-text="labelPeminjam" class="truncate text-left"></span>

                            <svg class="w-4 h-4 text-gray-400 ml-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        @foreach ($pengurus as $p)
                            <button type="button"
                                @click="
                                    $el.closest('[x-data]').querySelector('input[name=pengurus_id]').value = '{{ $p->id }}';
                                    labelPeminjam = '{{ $p->nama_lengkap }}';
                                    openPeminjam = false;
                                "
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition text-left">

                                <span class="h-2.5 w-2.5 rounded-full bg-green-500 flex-shrink-0"></span>
                                <span class="truncate">{{ $p->nama_lengkap }}</span>
                            </button>
                        @endforeach

                    </x-slot>
                </x-ui.dropdown>

                @error('pengurus_id')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <x-ui.input type="number" name="jumlah_pinjam" label="Jumlah Pinjam" :value="old('jumlah_pinjam', 1)" min="1"
                    required />

                @error('jumlah_pinjam')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <div>
                    <x-ui.date-input name="tanggal_pinjam" label="Tanggal Pinjam" :value="old('tanggal_pinjam')" required />

                    @error('tanggal_pinjam')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-ui.date-input name="tanggal_kembali_rencana" label="Rencana Kembali" :value="old('tanggal_kembali_rencana')"
                        required />

                    @error('tanggal_kembali_rencana')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <x-ui.textarea name="keterangan" label="Keterangan" rows="4"
                    placeholder="Tambahkan catatan peminjaman jika diperlukan...">{{ old('keterangan') }}</x-ui.textarea>
            </div>

            {{-- Action --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end pt-4">

                <a href="{{ route('peminjaman.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">

                    ← Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">

                    💾 Simpan Peminjaman
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
