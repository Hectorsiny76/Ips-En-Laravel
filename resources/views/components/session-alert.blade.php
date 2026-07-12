<div wire:key="toast-{{ rand() }}">
    <!--
        -My little Toast-
        Aquí se reutiliza el toast que es desplegado por los mensajes de tipo session y de flash.
    -->
    <div
        x-data="{
              show: false,
              message: '',
              type: 'success', // Default

              initToast() {
                   let successMsg = '{{session('success')}}';
                   let errorMsg = '{{session('error')}}';

                   if(successMsg) {
                        this.fire(successMsg, 'success');
                   } else if (errorMsg) {
                        this.fire(errorMsg, 'error');
                   }
              },

              fire(msg, msgType) {
                   this.message = msg;
                   this.type = msgType;
                   this.show = true;
                   setTimeout(()=> this.show = false, 3000);
              }
         }"
         x-init="initToast()"
         @notify.window="fire($event.detail.message, $event.detail.type)"
         x-show="show"
         x-transition.opacity.duration.300ms
         x-cloak
         :class="{
              'dark:border-primary-600 dark:bg-primary-900 dark:text-primary-200 text-primary-800 border border-primary-300 bg-primary-50': type === 'success',
              'dark:border-terciary-600 dark:bg-terciary-900 dark:text-terciary-200 text-terciary-800 border border-terciary-300 bg-terciary-50': type === 'error',
         }"
         class="text-xs lg:text-lg fixed top-6 left-1/2 transform -translate-x-1/2 z-50 flex items-center rounded-lg justify-between p-4 min-w-[160px] shadow-xl transition-all duration-300"
         role="alert"
        >
            <div>
                <span class="font-medium" x-text="type.toUpperCase()"></span> <span x-text="message"></span>
            </div>
        <button
            @click="show = false"
            :class="{
                'dark:text-green-400 dark:hover:text-green-200  text-green-900 hover:text-green-950': type === 'success',
                'dark:text-red-400 dark:hover:text-red-200 text-red-900 hover:text-red-950': type === 'error',
            }"
            class="font-bold ml-4"
        >&times;</button>
    </div>
</div>
