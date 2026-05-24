<?php

use Livewire\Component;

new class extends Component
{
    public $activeTab = 'admin::livewire.tabs.tab-search';

    public function setTab($component)
    {
        $this->activeTab = $component;

    }

};
?>

<div class="w-full pt-4">
    <div class="flex border-b pt-2">
        <button class="pr-2 border rounded-tl-md border-gray-700 bg-gray-800 text-white hover:bg-gray-300 hover:text-gray-900" wire:click="setTab('admin::livewire.tabs.tab-search')">Buscador</button>
        <button class="pr-2 border rounded-tr-md border-gray-700 bg-gray-800 text-white hover:bg-gray-300 hover:text-gray-900" wire:click="setTab('admin::livewire.tabs.tab-clasifications')">Clasificaciones</button>
    </div>

    <div>
        <livewire:dynamic-component :is="$activeTab" :key="$activeTab"/>
    </div>

</div>
