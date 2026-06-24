@props(['title' => ''])

<div {{$attributes->merge(['class'=>'text-sm lg:text-xl font-bold'])}}>
    <li class="cursor-pointer" @click="$copy('{{$title}}')">
        {{$title}}
    </li>
</div>
