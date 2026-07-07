@props(['titulo' => 'Mi titulo', 'opened' => false, 'primary' => true])

<div x-data="{
          show: '{{$opened}}',
        }"
>

    <div
        @class([
            'border border-transparent p-2',
            'bg-gradient-to-r from-green-700 to-green-900' => $primary,
            'bg-gradient-to-r from-orange-500 to-orange-700' => !$primary,
        ])
        :class="{
        'rounded-tr-xl rounded-tl-xl': show,
        'rounded-md': !show,
        }">

        <button type="button" class="text-center text-white flex w-full justify-between" @click = "show = !show">

            <h1 class="text-sm lg:text-lg font-bold text-white">{{$titulo}}</h1>

            <template x-if="show">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 lg:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>
            </template>

            <template x-if="!show">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 lg:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </template>

        </button>
    </div>

    <div class="p-2 border rounded-b-xl grid grid-flow-cols gap-2" x-show="show" x-transition>
        {{$slot ?? ''}}
    </div>

</div>
