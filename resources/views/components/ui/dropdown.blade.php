@props([
    'width' => '48',
    'align' => 'right',
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'left-0 origin-top-left',
        default => 'right-0 origin-top-right',
    };
@endphp

<div x-data="{ open: false }" class="relative">

    <!-- Trigger -->
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <!-- Dropdown Content -->
    <div x-show="open" @click.outside="open = false" @click="open = false"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 w-{{ $width }} rounded-2xl border border-gray-200 bg-white p-2 shadow-xl {{ $alignmentClasses }}"
        style="display: none;">
        {{ $content }}
    </div>
</div>
