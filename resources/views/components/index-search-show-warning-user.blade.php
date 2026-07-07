@props(['programas' => [], 'mensaje' => 'Ácercate con un supervisor.'])

<div x-data="{showWarning: $wire.entangle('showWarningModal')}">

    <button type="button" @click="showWarning = true" class="w-full bg-red-500 text-white border rounded-md border-transparent text-sm lg:text-lg">

        <div class="flex items-center justify-around motion-safe:animate-pulse hover:animate-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-4 lg:size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
            </svg>

            <p>Establecimiento en Piloto</p>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-4 lg:size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
            </svg>
        </div>

    </button>

    <div x-show="showWarning" x-transition x-cloak class="z-50 fixed inset-0 flex items-center justify-center bg-black/75">
        <div
            @click.away="showWarning = false"
            class="bg-white p-6 border border-transparent rounded-md"
        >
            <div class="border-red-700 border-2 p-3 border-double rounded-md w-full flex flex-col items-center">
                <div class="text-base lg:text-xl font-bold flex flex-col items-center select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="text-red-700 size-6 lg:size-8 motion-safe:animate-pulse">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                    <h3>Este establecimiento pertenece a uno o más programas piloto:</h3>
                </div>

                <ul>
                    @foreach($programas as $programa)
                        <li class="font-semibold underline">{{$programa->titulo}}</li>
                    @endforeach
                </ul>

                <p class="text-gray-600 select-none text-xs lg:text-base">{{$mensaje}}</p>
            </div>

        </div>
    </div>

</div>
