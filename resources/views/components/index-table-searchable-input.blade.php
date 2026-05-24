@props(['title', 'variable'])

<div {{$attributes->merge(['class'=>"mb-4"])}}>
    <x-input-form-label for="estados">{{$title}}</x-input-form-label>

    <x-input-form
        type="text"
        name="estados"
        placeholder="Escribe algo para comenzar a buscar..."
        value=""
        wire:model.live.debounce="{{$variable}}"
        id="estados"
    />

</div>
