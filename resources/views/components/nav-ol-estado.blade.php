<nav {{$attributes->merge(['class'=>"flex text-sm text-gray-500 font-medium mb-6"])}} aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">

        <li class="inline-flex items-center">
            <a href="{{ route('admin.estados.index') }}" class="hover:text-indigo-600 transition-colors">
                Estados
            </a>
        </li>

        {{$slot}}
    </ol>
</nav>
