<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="drop-shadow-mg flex justify-around p-2">
    <div
        class="border border-green-700 rounded-lg p-2 m-2 shadow-xl/20 hover:bg-green-600 transition-colors duration-300">
        <button wire:click="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.documentos'})"
            class="border-amber-950"><span class="icon">👥</span> Documentos</button>
    </div>

    <div class="border border-green-700 rounded-lg p-2 m-2 shadow-xl/20">
        <button wire:click="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.inc-generales'})"
            class="border-amber-950"><span class="icon">🔼</span> Generales</button>
    </div>

    <div class="border border-green-700 rounded-lg p-2 m-2 shadow-xl/20">
        <button wire:click="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.problemas'})"
            class="border-amber-950"><span class="icon">📋</span> Problemas</button>
    </div>

    <div class="border border-green-700 rounded-lg p-2 m-2 shadow-xl/20">
        <button wire:click="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.requerimientos'})"
            class="border-amber-950"><span class="icon">📑</span> RITM</button>
    </div>     
</div>