@props(['type','name' => '', 'placeholder' => '', 'value'=>''])

<input
    type="{{$type}}"
    name="{{$name}}"
    placeholder="{{$placeholder}}"
    value="{{$value}}"
    {{$attributes->merge( ['class'=>"text-xs lg:text-lg w-full dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm"])}}

    {{$slot}}
>
