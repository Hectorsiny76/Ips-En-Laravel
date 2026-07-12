@props(['title' => ''])

<div {{$attributes->merge(['class'=>'text-sm lg:text-xl font-bold hover:text-primary-800 transition-colors dark:text-gray-200 dark:hover:text-primary-800'])}}>
    <li class="cursor-pointer" @click="$copy('{{$title}}')">
        {{$title}}
    </li>
</div>
