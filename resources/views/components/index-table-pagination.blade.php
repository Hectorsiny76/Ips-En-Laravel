@props(['variable'])

<div {{$attributes->merge(['class'=>"text-xs lg:text-lg"])}}>
    {{ $variable->links() }}
</div>
