@props(['variable'])

<div {{$attributes->merge(['class'=>"my-4"])}}>
    {{ $variable->links() }}
</div>
