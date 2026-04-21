<div {{$attributes->merge(['class'=>"flex-1 overflow-auto bg-white shadow rounded-lg"])}}>
    <table class="min-w-full divide-y divide-gray-200 relative">
        {{$slot}}
    </table>
</div>
