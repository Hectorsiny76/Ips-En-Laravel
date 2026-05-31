@props(['title', 'variable'])

<div {{$attributes->merge(['class'=>"mb-4"])}}>
    <x-input-form-label for="searchableInput" class="dark:text-gray-300">{{$title}}</x-input-form-label>

    <x-input-form
        type="text"
        name="searchableInput"
        placeholder="Escribe algo para comenzar a buscar..."
        value=""
        wire:model.live.debounce="{{$variable}}"
        id="searchableInput"
        class="dark:text-gray-400 dark:bg-gray-800"
    />

</div>
