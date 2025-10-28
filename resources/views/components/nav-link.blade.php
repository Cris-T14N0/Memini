@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-3 py-2 border-b-2 border-indigo-500 dark:border-indigo-400 text-sm font-semibold leading-6 text-indigo-600 dark:text-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200 ease-in-out'
        : 'inline-flex items-center px-3 py-2 border-b-2 border-transparent text-sm font-medium leading-6 text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:border-indigo-500 dark:hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>