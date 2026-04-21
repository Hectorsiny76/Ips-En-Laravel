@props(['href'])

<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

    <a href="{{$href}}" class="text-blue-600 hover:text-blue-900 mr-4 font-bold">
        {{$slot}}
    </a>

</td>
