@props(['href'])

<li>
    <div class="flex items-center">
        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        <a href="{{$href}}" class="hover:text-indigo-600 transition-colors">
            {{$slot}}
        </a>
    </div>
</li>
