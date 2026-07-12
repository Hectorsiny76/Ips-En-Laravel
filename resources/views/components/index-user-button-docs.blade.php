@props(['link' => false])


<div
    {{$attributes->class([
        'py-1 w-full flex items-center text-sm lg:text-lg text-left
        border-transparent
        transition-all duration-100
        hover:border-primary-700 hover:font-semibold
        dark:hover:text-primary-600 dark:hover:border-primary-600',
        'border-b hover:text-primary-800' => $link,
        'border hover:rounded-md hover:text-primary-100 hover:bg-primary-600 dark:hover:bg-primary-900' => !$link,
        ])}}
>
    {{$slot}}
</div>
