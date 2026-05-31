<div wire:key="alert-{{ rand() }}">
    @if(session('success'))
        <div x-data="{show:true}"
             x-show="show"
             x-init="setTimeout(()=> show = false, 5000)"
             class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 flex items-center justify-between p-4 min-w-[320px] text-sm dark:border-green-600 dark:bg-green-900 dark:text-green-500 text-green-800 border border-green-300 rounded-lg bg-green-50 shadow-xl transition-all duration-300"
             role="alert"
        >
            <div>
                <span class="font-medium">Hecho!</span> {{session('success')}}
            </div>
            <button @click="show = false" class="dark:text-green-400 dark:hover:text-green-200  text-green-900 hover:text-green-950 font-bold ml-4">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{show:true}"
             x-show="show"
             x-init="setTimeout(()=> show = false, 5000)"
             class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 flex items-center justify-between p-4 min-w-[320px] text-sm dark:border-red-600 dark:bg-red-900 dark:text-red-500 text-red-800 border border-red-300 rounded-lg bg-red-50 shadow-xl transition-all duration-300"
             role="alert"
        >
            <div>
                <span class="font-bold">Alto!</span> {{session('error')}}
            </div>
            <button @click="show = false" class="dark:text-red-400 dark:hover:text-red-200 text-red-900 hover:text-red-950 font-bold ml-4">&times;</button>
        </div>
    @endif
</div>
