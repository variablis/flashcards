@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 text-blue-600 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700'
            : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700';
$classes2 = ($active ?? false)
            ? 'flex-shrink-0 w-6 h-6 text-blue-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white'
            : 'flex-shrink-0 w-6 h-6 text-gray-300 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <svg aria-hidden="true" class="{{ $classes2 }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="3"/></svg>
    <span class="ml-3">{{ $slot }}</span>
</a>