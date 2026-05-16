<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public $activeComponent = 'admin::livewire.navbar.sidebar.sidebar-documentos';

    #[On('update-sidebar')]
    public function loadNewComponent($component)
    {

        if($this->activeComponent === $component){
            $this->activeComponent = null;
        } else {
            $this->activeComponent = $component;
        }
    }
};
?>

<div class="w-full bg-gray-100 p-4">
    @if($activeComponent)
        <livewire:dynamic-component :is="$activeComponent" :key="$activeComponent" />
    @else
        <div class="w-full flex border-2 items-center justify-center border-double border-gray-700 rounded-md">
            <h1 class="p-4">¡Presiona un botón para ver su contendido!</h1>
        </div>
    @endif
</div>
