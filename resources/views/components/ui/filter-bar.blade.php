
@props(['action', 'placeholder' => 'Cari data...', 'statuses' => []])

<div class="rounded-3xl bg-white border border-gray-200 shadow-sm p-4">

    <form method="GET" action="{{ $action }}"
        class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

        <div class="flex flex-col gap-3 sm:flex-row sm:flex-1">

            <!-- SEARCH -->
            <div class="relative flex-1">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $placeholder }}"
                    class="w-full rounded-2xl border border-gray-200 bg-white pl-10 pr-4 py-3 text-sm text-gray-700 placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-100 transition">
            </div>

            @if (count($statuses))
                <!-- STATUS DROPDOWN -->
                <div x-data="{
                    status: '{{ request('status') }}',
                    label: '{{ request('status') ?: 'Semua Status' }}'
                }" class="w-full sm:w-56">

                    <input type="hidden" name="status" :value="status">

                    <x-ui.dropdown width="64" align="left">

                        <x-slot name="trigger">
                            <button type="button"
                                class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 hover:border-green-300 hover:shadow-sm transition">

                                <span class="truncate" x-text="label"></span>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <button type="button" @click="status = ''; label = 'Semua Status'"
                                class="flex w-full items-center rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                Semua Status
                            </button>

                            @foreach ($statuses as $item)
                                <button type="button"
                                    @click="status = '{{ $item }}'; label = '{{ $item }}'"
                                    class="flex w-full items-center rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                    {{ $item }}
                                </button>
                            @endforeach

                        </x-slot>
                    </x-ui.dropdown>
                </div>
            @endif
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex items-center gap-2">

            <button type="submit"
                class="inline-flex items-center justify-center rounded-2xl bg-green-700 px-5 py-3 text-sm font-semibold text-white hover:bg-green-800 transition shadow-lg shadow-green-700/20">
                Terapkan
            </button>

            <a href="{{ $action }}"
                class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Reset
            </a>
        </div>
    </form>
</div>