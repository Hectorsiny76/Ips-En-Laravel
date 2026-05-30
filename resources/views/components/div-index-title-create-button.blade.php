@props(['url', 'title', 'create' => true, 'button'])

<div class="flex justify-between py-2">
    <h1 class="text-xl font-semibold py-2 flex-shrink-0">{{$title}}</h1>
    @if($create)
        <a href="{{$url}}" class="bg-indigo-300  px-4 py-2 rounded">{{$button}}</a>
    @endif
</div>
