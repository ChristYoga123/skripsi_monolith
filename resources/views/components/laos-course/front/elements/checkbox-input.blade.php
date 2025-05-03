@props(['id', 'label' => null, 'data' => null, 'required' => false])
<!-- Remember Me -->
<div class="flex items-center">
    <input id="{{ $id }}" type="checkbox" name="{{ $id }}"
        class="w-4 h-4 text-green-600 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-green-500">
    <label for="{{ $id }}" class="ml-2 block text-sm text-gray-700 dark:text-gray-300"
        {{ $required ? 'required' : '' }}>
        {{ $label ? $label : ucwords(str_replace('_', ' ', $id)) }}
        {!! $required ? '<span class="text-red-600">*</span>' : '' !!}
    </label>
</div>
