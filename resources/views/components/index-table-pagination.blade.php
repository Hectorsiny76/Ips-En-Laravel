@props(['variable'])

<div {{$attributes->merge(['class'=>""])}}>
    {{ $variable->links() }}
</div>
