@props(['copy' => false])


<td
    {{ $attributes->class([
        'truncate px-1 py-3 whitespace-nowrap text-left text-xs lg:text-base lg:font-medium',
        'cursor-pointer hover:text-primary-800 hover:font-semibold dark:hover:text-primary-800 transition-all duration-300' => $copy,
        ])
    }}
>
    {{$slot}}
</td>
