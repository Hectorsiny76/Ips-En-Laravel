<div {{$attributes->merge(['class'=>"bg-white dark:bg-gray-800 shadow"])}}>
    <table class="min-w-full divide-y rounded-lg dark:border dark:border-gray-600  divide-gray-200 relative">
        {{$slot}}
    </table>
</div>
