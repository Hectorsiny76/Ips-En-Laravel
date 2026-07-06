<?php

use Livewire\Component;
use Livewire\Attributes\Session;

new class extends Component
{
    #[Session]
    public $activeTab = 'user::livewire.tabs-index.tabs.buscar-est';

    public function setTab($component)
    {
        $this->activeTab = $component;
    }
};
?>

<div class="text-xs lg:text-lg">
    <div class="flex">
        <button
            wire:click="setTab('user::livewire.tabs-index.tabs.buscar-est')"
            @class(['pl-1 pr-2 border border-green-800 rounded-tl-md transition-colors',
                    'border-green-700 bg-green-800 text-white dark:bg-gray-300 dark:text-gray-900' => $activeTab === 'user::livewire.tabs-index.tabs.buscar-est',
                    'bg-white text-gray-500 hover:bg-green-700 hover:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-white' => $activeTab !== 'user::livewire.tabs-index.tabs.buscar-est',
                    ])
        >Establecimientos</button>
        <button
            wire:click="setTab('user::livewire.tabs-index.tabs.buscar-clasificaciones')"
            @class(['px-2 border border-green-800 transition-colors',
                    'border-green-700 bg-green-800 text-white dark:bg-gray-300 dark:text-gray-900' => $activeTab === 'user::livewire.tabs-index.tabs.buscar-clasificaciones',
                    'bg-white text-gray-500 hover:bg-green-700 hover:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-white' => $activeTab !== 'user::livewire.tabs-index.tabs.buscar-clasificaciones',
                    ])
        >Clasificaciones</button>
        <button
            wire:click="setTab('user::livewire.tabs-index.tabs.despliegues')"
            @class(['pl-1 pr-2 border border-green-800 rounded-tr-md transition-colors',
                    'border-green-700 bg-green-800 text-white dark:bg-gray-300 dark:text-gray-900' => $activeTab === 'user::livewire.tabs-index.tabs.despliegues',
                    'bg-white text-gray-500 hover:bg-green-700 hover:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-white' => $activeTab !== 'user::livewire.tabs-index.tabs.despliegues',
                    ])
        >Despliegues</button>
    </div>
    <div class="border border-green-800 rounded-bl-md rounded-br-md rounded-tr-md p-2" wire:transition>
        <livewire:dynamic-component :is="$activeTab" :key="$activeTab"/>
    </div>
</div>
