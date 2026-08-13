@props(['name', 'label' => null])

<div class="space-y-2">

    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <div class="relative">

        <select id="{{ $name }}" name="{{ $name }}"
            {{ $attributes->merge([
                'class' =>
                    'w-full appearance-none rounded-3xl border border-green-200 bg-white px-5 py-3.5 pr-12 text-sm font-medium text-gray-700 shadow-sm transition duration-200 hover:border-green-300 hover:shadow-md focus:border-green-500 focus:ring-4 focus:ring-green-100',
            ]) }}>

            {{ $slot }}

        </select>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-green-600">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror

</div>
