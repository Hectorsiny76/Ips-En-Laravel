
<div
    wire:transition
    {{$attributes->merge(['class' => 'flex flex-col divide-y-2 divide-gray-200 p-1 text-base dark:text-gray-300'])}}
>
    {{$slot}}
</div>
