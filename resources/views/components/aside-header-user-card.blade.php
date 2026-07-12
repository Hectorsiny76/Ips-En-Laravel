@props(['titulo' => 'Mi titulo'])

<div
    {{$attributes->merge(['class' => 'bg-gradient-to-r from-primary-700 to-primary-900 dark:from-primary-900 dark:to-primary-900 dark:text-gray-200 text-white border-transparent rounded-tr-xl rounded-tl-xl flex p-2 w-full select-none'])}}
>
    <h1 class="text-sm lg:text-lg font-bold">{{$titulo}}</h1>
</div>
