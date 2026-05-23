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

<div class="w-full">
    <div class="flex border-b">
        <button class="pr-2 border rounded-md border-gray-700 hover:text-blue-900" wire:click="setTab('admin::livewire.tabs.tab-search')">Buscador</button>
        <button class="pr-2 border rounded-md border-gray-700 hover:text-blue-900" wire:click="setTab('admin::livewire.tabs.tab-clasifications')">Clasificaciones</button>
    </div>

    <div>
        <livewire:dynamic-component :is="$activeTab" :key="$activeTab"/>
    </div>

</div>
