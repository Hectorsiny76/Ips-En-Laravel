@props(['href'])

<li {{$attributes->merge(['class' => 'my-1 transition-all duration-200 hover:scale-105 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700'])}}>
    <a href="{{ $href }}" {{$attributes->merge(['class' => 'py-1  block w-full h-full text-base'])}}> {{ $slot }} </a>
</li>
