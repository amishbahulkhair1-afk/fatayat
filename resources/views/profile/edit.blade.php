<x-app-layout>
    <x-slot name="header">
        Pengaturan Akun
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pengaturan Akun</h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola informasi profil, keamanan akun, dan pengaturan lainnya.
            </p>
        </div>

        <!-- Informasi Profil -->
        <x-ui.card class="p-8">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Informasi Profil</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui nama dan alamat email akun Anda.
                </p>
            </div>

            @include('profile.partials.update-profile-information-form')
        </x-ui.card>

        <!-- Ubah Password -->
        <x-ui.card class="p-8">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Keamanan Akun</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Gunakan password yang kuat untuk menjaga keamanan akun Anda.
                </p>
            </div>

            @include('profile.partials.update-password-form')
        </x-ui.card>

        <!-- Hapus Akun -->
        <x-ui.card class="border-red-100 bg-red-50/30 p-8">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-red-700">Zona Berbahaya</h2>
                <p class="text-sm text-red-600 mt-1">
                    Menghapus akun akan menghilangkan seluruh data secara permanen.
                </p>
            </div>

            @include('profile.partials.delete-user-form')
        </x-ui.card>
    </div>

    <div class="mt-6 rounded-3xl bg-white border border-gray-200 shadow-sm p-6"></div>
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Tampilan Aplikasi</h3>
            <p class="text-sm text-gray-500 mt-1">
                Atur ukuran tampilan dashboard sesuai kenyamanan Anda.
            </p>
        </div>

        <div class="h-10 w-10 rounded-2xl bg-green-100 flex items-center justify-center text-green-700 text-lg">
            🔍
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700">Ukuran Tampilan</span>
            <span class="text-sm font-semibold text-green-700" x-text="zoom + '%'"></span>
        </div>

        <div class="flex items-center gap-3">

            <button type="button" @click="zoom = Math.max(80, zoom - 10)"
                class="w-10 h-10 rounded-xl border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold transition">
                −
            </button>

            <input type="range" min="80" max="130" step="10" x-model="zoom"
                class="flex-1 accent-green-600">

            <button type="button" @click="zoom = Math.min(130, zoom + 10)"
                class="w-10 h-10 rounded-xl border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold transition">
                +
            </button>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-gray-50 border border-gray-200 px-4 py-3">
            <div>
                <p class="text-sm font-medium text-gray-900">Reset Tampilan</p>
                <p class="text-xs text-gray-500 mt-1">Kembalikan ukuran tampilan ke standar aplikasi.</p>
            </div>

            <button type="button" @click="zoom = 100"
                class="px-4 py-2 rounded-xl bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition">
                Reset
            </button>
        </div>
    </div>
    </div>
</x-app-layout>
