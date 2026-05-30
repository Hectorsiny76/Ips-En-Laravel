<div {{$attributes->merge(['class'=>"bg-white shadow rounded-lg"])}}>
    <table class="min-w-full divide-y divide-gray-200 relative">
        {{$slot}}
    </table>
</div>
