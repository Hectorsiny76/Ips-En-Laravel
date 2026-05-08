@props(['label', 'value', 'icon' => null])

<div class="flex items-center space-x-3 p-4 rounded-lg bg-gray-50 border border-gray-100 transition-all hover:bg-white hover:border-green-200 hover:shadow-sm">
    @if($icon)
        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-green-100 text-green-600">
            {!! $icon !!}
        </div>
    @endif
    <div class="flex-grow">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $label }}</p>
        <p class="text-base font-semibold text-gray-800">{{ $value ?? 'N/A' }}</p>
    </div>
</div>
