@props(['dispatch' => '', 'title', 'icon', 'link' => false, 'href' => ''])

<div class=" border border-green-700 rounded-lg {{!$link ? '' : 'py-2' }} shadow-xl/20 m-0.5 hover:bg-green-700 transition-colors duration-300">
    @if(!$link)
        <button wire:click="{{$dispatch}}"
                class="p-2 w-full h-full">
            <span class="icon">{{$icon}}</span> {{$title}}
        </button>
    @else
        <a href="{{$href}}"
           target="_blank"
           rel="noopener noreferrer"
           class="p-2 w-full h-full"><span class="icon">{{$icon}}</span> {{$title}}</a>
    @endif
</div>
