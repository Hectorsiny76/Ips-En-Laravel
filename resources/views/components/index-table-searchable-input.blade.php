@props(['title', 'variable'])

<div {{$attributes->merge(['class'=>"mb-4"])}}>
    <x-input-form-label for="searchableInput">{{$title}}</x-input-form-label>

    <x-input-form
        type="text"
        name="searchableInput"
        placeholder="Escribe algo para comenzar a buscar..."
        value=""
        wire:model.live.debounce="{{$variable}}"
        id="searchableInput"
    />

</div>
