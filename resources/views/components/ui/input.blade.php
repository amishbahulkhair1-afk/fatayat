@props(['label' => null, 'name', 'type' => 'text'])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge([
            'class' =>
                'w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition',
        ]) }}>

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
