@props(['title', 'variable', 'userSide' => false])

<div {{$attributes->merge(['class'=>"mb-4 text-xs lg:text-lg"])}}>
    <x-input-form-label for="searchableInput" class="dark:text-gray-300">{{$title}}</x-input-form-label>

    <x-input-form
        type="text"
        name="searchableInput"
        placeholder="Escribe algo para comenzar a buscar..."
        value=""
        wire:model.live.debounce="{{$variable}}"
        id="searchableInput"
        class="dark:text-gray-400 dark:bg-gray-800"
        @class([
            'focus:ring-primary-700 focus:border-primary-700' => $userSide,
            'focus:ring-sky-700 focus:border-sky-700' => !$userSide,
            ])
    />

</div>
