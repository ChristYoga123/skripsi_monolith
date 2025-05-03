@props(['id', 'type' => 'text', 'label' => null, 'required' => false, 'data' => null, 'placeholder' => null])
<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        {{ $label ? $label : ucwords(str_replace('_', ' ', $id)) }}
        {!! $required ? '<span class="text-red-600">*</span>' : '' !!}
    </label>
    <input id="{{ $id }}" type="{{ $type }}" name="{{ $id }}"
        value="{{ $data ? $data : old($id) }}" {{ $required ? 'required' : '' }}
        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white transition-all duration-200 @error($id) border-red-500 @enderror"
        placeholder="{{ $placeholder }}">

    @error($id)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
