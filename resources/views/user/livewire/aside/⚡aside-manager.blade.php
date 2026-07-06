<?php

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Session;

new class extends Component
{
    #[Session]
    public $componenteActivo = 'user::livewire.aside.components.inc-generales';

    #[On('Cargar-componente')]
    public function cargarNuevoComponente($componente)
    {
        $this->componenteActivo = $componente;
    }
};
?>

<div class="h-full" wire:transition>
    <livewire:dynamic-component :is="$componenteActivo" :key="$componenteActivo" />
</div>
