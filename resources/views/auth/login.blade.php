<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-8">
        <div class="w-full max-w-md">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ config('app.name') }}
                </h1>
                <p class="text-gray-500 mt-2">
                    Masuk ke dashboard aplikasi
                </p>
            </div>

            <x-ui.card class="p-8">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />

                        <x-text-input
                            id="email"
                            class="block mt-2 w-full rounded-xl border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-blue-500 px-4 py-3"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username" />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Password')" />

                            @if (Route::has('password.request'))
                                <a class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                                   href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <x-text-input
                            id="password"
                            class="block mt-2 w-full rounded-xl border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-blue-500 px-4 py-3"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                               name="remember">

                        <label for="remember_me" class="ms-2 text-sm text-gray-600">
                            Ingat saya
                        </label>
                    </div>

                    <x-ui.button type="submit" class="w-full">
                        Masuk
                    </x-ui.button>
                </form>
            </x-ui.card>

            @if (Route::has('register'))
                <p class="text-center text-sm text-gray-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                       class="text-blue-600 hover:text-blue-700 font-medium">
                        Daftar sekarang
                    </a>
                </p>
            @endif
        </div>
    </div>
</x-guest-layout>