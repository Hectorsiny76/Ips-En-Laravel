@props(['link' => false])


<div
    {{$attributes->class([
        'py-1 w-full flex items-center text-sm lg:text-lg text-left
        border-transparent
        transition-all duration-100',
        'border-b hover:border-green-300/50 hover:font-semibold hover:text-green-800' => $link,
        'border hover:border-green-300/50 hover:font-semibold hover:rounded-md hover:text-green-700 hover:bg-green-200/50' => !$link,
        ])}}
>
    {{$slot}}
</div>
