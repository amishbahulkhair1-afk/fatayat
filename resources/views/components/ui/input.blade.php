@props([
    'name' => null,
    'label' => null,
    'type' => 'text',
])

<div class="space-y-2">
    @if ($label)
        <label @if ($name) for="{{ $name }}" @endif
            class="text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}"
        @if ($name) name="{{ $name }}"
            id="{{ $name }}" @endif
        {{ $attributes->merge([
            'class' =>
                'w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm hover:border-green-300 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200',
        ]) }}>

    @if ($name)
        @error($name)
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    @endif
</div>
