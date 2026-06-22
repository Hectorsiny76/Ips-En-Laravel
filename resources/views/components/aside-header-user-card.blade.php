@props(['titulo' => 'Mi titulo'])

<div
    {{$attributes->merge(['class' => 'bg-gradient-to-r from-green-700 to-green-900 border-transparent rounded-tr-xl rounded-tl-xl flex py-2 w-full items-center justify-center'])}}
>
    <h1 class="text-sm lg:text-lg font-bold text-white">{{$titulo}}</h1>
</div>
