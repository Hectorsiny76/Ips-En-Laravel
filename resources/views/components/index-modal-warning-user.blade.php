<div x-data="{
            showWarning: false,
            titulo: 'Este establecimiento pertenece a uno o más programas piloto',
            lista: null,
            mensaje: 'Antes de proceder, si tienes dudas, ácercate con un supervisor.',
     }"
     @open-warning-modal.window="
        showWarning = true;
        lista = $event.detail?.lista || lista;
        titulo = $event.detail?.titulo || titulo;
        mensaje = $event.detail?.mensaje || mensaje;
     "
>
    <div x-show="showWarning"
         x-transition.delay.300ms
         x-cloak
         class="z-[99] fixed inset-0 flex items-center justify-center bg-black/75">
        <div
            @click.away="showWarning = false"
            class="bg-white dark:bg-gray-800 p-6 border border-transparent rounded-md"
        >
            <div
                class="border-terciary-700 dark:border-terciary-900 border-2 p-3 border-double rounded-md w-full flex flex-col items-center">
                <div
                    class="text-base dark:text-gray-300 lg:text-xl font-bold flex flex-col items-center select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="text-terciary-700 dark:text-terciary-900 size-6 lg:size-8 motion-safe:animate-pulse">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                    <h3 x-text="titulo"></h3>
                </div>

                <ul class="dark:text-gray-300">
                    <template x-for="objeto in lista">
                        <li class="font-semibold underline" x-text="objeto"></li>
                    </template>
                </ul>

                <p class="text-gray-600 dark:text-gray-500 select-none text-xs lg:text-base" x-text="mensaje"></p>
            </div>
        </div>
    </div>
</div>
