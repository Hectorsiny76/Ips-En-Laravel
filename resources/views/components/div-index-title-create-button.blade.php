@props(['url', 'title', 'create' => true, 'button'])

<div class="flex justify-between py-2">
    <h1 class="text-xl font-semibold py-2 flex-shrink-0 dark:text-white">{{$title}}</h1>
    @if($create)
        <a href="{{$url}}" class="bg-indigo-300 dark:bg-indigo-900/50 dark:hover:bg-indigo-700/50 dark:focus:border dark:focus:border-gray-400 border border-transparent dark:text-gray-300 px-4 py-2 rounded">{{$button}}</a>
    @endif
</div>
