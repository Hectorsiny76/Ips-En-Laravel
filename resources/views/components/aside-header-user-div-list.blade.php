
<div
    wire:transition
    {{$attributes->merge(['class' => 'flex flex-col divide-y-2 divide-primary-800 dark:divide-primary-900 p-1 text-base dark:text-gray-300'])}}
>
    {{$slot}}
</div>
