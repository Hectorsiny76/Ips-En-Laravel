<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public $componenteActivo = 'user::livewire.aside.components.documentos'; 


    #[On('Cargar-componente')]
    public function cargarNuevoComponente($componente)
    {
        $this->componenteActivo = $componente;
    }
};
?>

<div>
    <livewire:dynamic-component :is="$componenteActivo" :key="$componenteActivo" />
</div>