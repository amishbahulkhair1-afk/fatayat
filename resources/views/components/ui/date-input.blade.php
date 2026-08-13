@props(['name', 'label' => null, 'value' => null, 'required' => false])

<div class="space-y-2">

    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <div x-data x-init="flatpickr($refs.input, {
        locale: 'id',
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'd F Y',
        allowInput: true
    })" class="relative">

        <input x-ref="input" type="text" id="{{ $name }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" @if ($required) required @endif
            class="w-full rounded-2xl border border-gray-200 bg-white pl-4 pr-12 py-3 text-sm font-medium text-gray-700 shadow-sm hover:border-green-300 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200"
            <button type="button" @click="$refs.input._flatpickr.open()"
            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-green-600 transition-all duration-200 hover:scale-110"
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">

        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        </button>
    </div>

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
