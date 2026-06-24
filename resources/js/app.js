import './bootstrap';

document.addEventListener('alpine:init', () => {
    window.Alpine.magic('copy', () => (text) => {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'absolute';
        textArea.style.left = '-999999px';
        document.body.prepend(textArea);
        textArea.select();

        try {
            document.execCommand('copy');

            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    message: '¡Copiado al portapapeles!',
                    type: 'success'
                }
            }));
        } catch (e) {
            console.error('¡Error al intentar copiar!',e);
        } finally {
            textArea.remove();
        }
    });
});

// import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

// Livewire.start();

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
