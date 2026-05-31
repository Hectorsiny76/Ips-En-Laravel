@props(['cancel' => false, 'href' => ''])

<div {{$attributes->merge(['class'=>" flex items-center justify-between mb-4"])}}>
    <h1 {{$attributes->merge(['class'=>"dark:text-white text-xl font-semibold flex-shrink-0"])}}>{{$slot}}</h1>

    @if($cancel)
        <a href="{{$href}}" {{$attributes->merge(['class'=>"px-6 py-2 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"])}}>
            Cancelar
        </a>
    @endif

</div>
