@props(['href', 'active' => false])

@php

$classes = $active
    ? 'my-1 transition-all duration-200 hover:scale-105 rounded-md bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-700'
    : 'my-1 transition-all duration-200 hover:scale-105 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700';

@endphp


<li {{$attributes->merge(['class' => $classes])}}>
    <a href="{{ $href }}" {{$attributes->merge(['class' => 'py-1  block w-full h-full text-base'])}}> {{ $slot }} </a>
</li>
