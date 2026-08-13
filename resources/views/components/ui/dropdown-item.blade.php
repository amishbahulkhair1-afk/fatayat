@props([
    'href' => null,
    'danger' => false,
])

@php
    $classes = $danger
        ? 'flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition'
        : 'flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition';
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif