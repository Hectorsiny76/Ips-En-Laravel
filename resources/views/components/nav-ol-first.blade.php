@props(['href', 'nombre'])

<nav {{$attributes->merge(['class'=>"flex text-sm text-gray-500 dark:text-gray-400 font-medium mb-6"])}} aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">

        <li class="inline-flex items-center">
            <a href="{{$href}}" class="hover:text-indigo-600 dark:hover:text-gray-200 transition-colors">
                {{$nombre}}
            </a>
        </li>

        {{$slot}}
    </ol>
</nav>
