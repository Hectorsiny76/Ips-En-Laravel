@props(['primary' => true])

<thead @class([
    'text-white rounded-lg dark:text-gray-200 sticky top-0 z-10 select-none',
    'bg-gradient-to-r from-secondary-600 to-secondary-700 dark:from-secondary-900 dark:to-secondary-900' => ! $primary,
    'bg-gradient-to-r from-primary-700 to-primary-900 dark:from-primary-900 dark:to-primary-900' => $primary
    ])>
    <tr>
        {{$slot}}
    </tr>
</thead>
