@props(['name', 'value', 'label'])

<label for="{{ $name }}" class="flex items-center cursor-pointer relative mb-4">
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        class="sr-only"
        {{ $value == true ? 'checked' : '' }}
    >
    <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full"></div>
    <span class="ml-3 text-gray-900 text-sm font-medium">{{ $label }}</span>
</label>
<x-form.error name="{{ $name }}"/>
