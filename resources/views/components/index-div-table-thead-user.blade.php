@props(['primary' => true])

<thead @class([
    'dark:bg-gray-700 text-white rounded-lg dark:text-gray-200 sticky top-0 z-10 select-none',
    'bg-gradient-to-r from-orange-500 to-orange-700' => ! $primary,
    'bg-gradient-to-r from-green-700 to-green-900' => $primary
    ])>
    <tr>
        {{$slot}}
    </tr>
</thead>
