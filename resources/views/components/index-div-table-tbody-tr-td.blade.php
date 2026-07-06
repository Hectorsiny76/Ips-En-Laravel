@props(['copy' => false])


<td
    @class([
        'truncate px-1 py-3 whitespace-nowrap text-left text-xs lg:text-base lg:font-medium',
        'cursor-pointer hover:text-green-800 transition-colors duration-300' => $copy,
    ])
>
    {{$slot}}
</td>
