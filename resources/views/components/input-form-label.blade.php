@props(['for'])

<label for="{{$for}}" {{$attributes->merge(['class'=>"block text-lg font-medium text-gray-700 my-2"])}}>{{$slot}}</label>
