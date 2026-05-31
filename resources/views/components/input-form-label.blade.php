@props(['for'])

<label for="{{$for}}" {{$attributes->merge(['class'=>"block text-lg font-medium dark:text-gray-200 text-gray-700 my-2"])}}>{{$slot}}</label>
