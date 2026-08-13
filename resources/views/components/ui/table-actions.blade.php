@props(['edit', 'delete', 'confirm' => 'Yakin hapus data ini?'])

<x-ui.dropdown width="44">

    <x-slot name="trigger">
        <button type="button"
            class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition">
            ⋮
        </button>
    </x-slot>

    <x-slot name="content">

        <x-ui.dropdown-item :href="$edit">
            ✏️ Edit
        </x-ui.dropdown-item>

        <form action="{{ $delete }}" method="POST" onsubmit="return confirm('{{ $confirm }}')">
            @csrf
            @method('DELETE')

            <x-ui.dropdown-item danger type="submit">
                🗑️ Hapus
            </x-ui.dropdown-item>
        </form>

    </x-slot>
</x-ui.dropdown>
