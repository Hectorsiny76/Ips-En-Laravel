<div {{$attributes->merge(['class'=>"bg-white overflow-auto dark:bg-gray-800 shadow"])}}>
    <table class="min-w-full divide-y rounded-lg dark:border dark:border-gray-600 divide-gray-200 relative table-fixed">
        {{$slot}}
    </table>
</div>
