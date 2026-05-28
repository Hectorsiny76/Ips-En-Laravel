@props(['href', 'click' => ''])

<div {{$attributes->merge(['class'=>"flex justify-center space-x-3 mt-8 pt-4 border-t border-gray-500"])}}>
    <a href="{{$href}}" {{$attributes->merge(['class'=>"px-6 py-2 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"])}}>
        Cancelar
    </a>
    <button
        type="submit"
        wire:click="{{$click}}"
        {{$attributes->merge(['class'=>"px-6 py-2 text-lg font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"])}}>
        Crear
    </button>
</div>
