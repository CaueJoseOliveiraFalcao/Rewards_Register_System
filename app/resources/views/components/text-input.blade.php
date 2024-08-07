@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'p-3 border-gray-300 dark:border-gray-700  rounded-md ']) !!}>
