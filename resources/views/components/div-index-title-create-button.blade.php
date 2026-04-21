@props(['url', 'title', 'button'])

<div class="flex justify-between">
    <h1 class="text-xl font-semibold mb-4 flex-shrink-0">{{$title}}</h1>
    <a href="{{$url}}" class="bg-indigo-300  px-4 py-2 rounded">{{$button}}</a>
</div>
