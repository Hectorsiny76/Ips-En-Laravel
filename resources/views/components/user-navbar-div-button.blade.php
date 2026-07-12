@props(['dispatch' => '', 'title', 'icon', 'link' => false, 'href' => ''])

<div class="transition-colors duration-300 shadow-xl/20 m-0.5 rounded-lg {{!$link ? '' : 'py-2' }} border-2 border-primary-700 hover:bg-primary-700 dark:border-primary-800 dark:hover:bg-primary-800">
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
