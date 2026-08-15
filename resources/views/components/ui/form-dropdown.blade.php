@props(['name', 'label' => null, 'selected' => null, 'placeholder' => '-- Pilih --', 'required' => false])

<div class="space-y-2" x-data="{ open: false, value: '{{ old($name, $selected) }}' }">
    @if ($label)
        <label class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <input type="hidden" name="{{ $name }}" :value="value"
        @if ($required) required @endif>

    <button type="button" @click="open = !open"
        class="w-full flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200">

        <span x-text="value ? value : '{{ $placeholder }}'"></span>

        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" x-transition @click.outside="open = false"
        class="absolute z-50 mt-2 w-full rounded-2xl border border-gray-200 bg-white p-2 shadow-xl"
        style="display: none;">

        <button type="button" @click="value = ''; open = false"
            class="flex w-full items-center rounded-xl px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 transition">
            {{ $placeholder }}
        </button>

        {{ $slot }}
    </div>

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
