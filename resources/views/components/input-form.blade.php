@props(['type','name', 'placeholder', 'value'=>''])

<input
    type="{{$type}}"
    name="{{$name}}"
    placeholder="{{$placeholder}}"
    value="{{$value}}"
    {{$attributes->merge( ['class'=>"w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"])}}
        {{$slot}}>
