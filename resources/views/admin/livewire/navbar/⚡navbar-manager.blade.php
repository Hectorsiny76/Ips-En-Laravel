<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="dark:text-gray-300 flex justify-between">
    <div class="flex-1 border-r">
        <button wire:click="$dispatch('update-sidebar', {component: 'admin::livewire.navbar.sidebar.sidebar-documentos'})" class="w-full p-2 transition-all duration-200 hover:scale-105">
            Documentos
        </button>
    </div>
    <div class="flex-1 border-r">
        <button wire:click="$dispatch('update-sidebar', {component: 'admin::livewire.navbar.sidebar.sidebar-requerimientos'})" class="w-full p-2 transition-all duration-200 hover:scale-105">
            Requerimientos
        </button>
    </div>
    <div class="flex-1 border-r">
        <button wire:click="$dispatch('update-sidebar', {component: 'admin::livewire.navbar.sidebar.sidebar-inc-generales'})" class="w-full p-2 transition-all duration-200 hover:scale-105">
            Generales
        </button>
    </div>
    <div class="flex-1">
        <button wire:click="$dispatch('update-sidebar', {component: 'admin::livewire.navbar.sidebar.sidebar-problemas'})" class="w-full p-2 transition-all duration-200 hover:scale-105">
            Problemas
        </button>
    </div>
</div>
