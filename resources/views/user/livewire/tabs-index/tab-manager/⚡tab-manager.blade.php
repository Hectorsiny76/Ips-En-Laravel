<?php

use Livewire\Component;
use Livewire\Attributes\Session;

new class extends Component
{
    #[Session]
    public $activeTab = 'user::livewire.tabs-index.tabs.buscar-est';

    public $activeStyles = 'bg-primary-800 text-white dark:bg-primary-900 dark:text-gray-200';

    public $inactiveStyles = 'bg-white text-gray-400 hover:bg-primary-700 hover:text-white dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600';

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
            @class(['pl-1 pr-2 border border-primary-900 rounded-tl-md transition-colors',
                    $activeStyles => $activeTab === 'user::livewire.tabs-index.tabs.buscar-est',
                    $inactiveStyles => $activeTab !== 'user::livewire.tabs-index.tabs.buscar-est',
                    ])
        >Establecimientos</button>
        <button
            wire:click="setTab('user::livewire.tabs-index.tabs.buscar-clasificaciones')"
            @class(['px-2 border border-primary-900 transition-colors',
                    $activeStyles => $activeTab === 'user::livewire.tabs-index.tabs.buscar-clasificaciones',
                    $inactiveStyles => $activeTab !== 'user::livewire.tabs-index.tabs.buscar-clasificaciones',
                    ])
        >Clasificaciones</button>
        <button
            wire:click="setTab('user::livewire.tabs-index.tabs.despliegues')"
            @class(['pl-1 pr-2 border border-primary-900 rounded-tr-md transition-colors',
                    $activeStyles => $activeTab === 'user::livewire.tabs-index.tabs.despliegues',
                    $inactiveStyles => $activeTab !== 'user::livewire.tabs-index.tabs.despliegues',
                    ])
        >Despliegues</button>
    </div>
    <div class="border border-primary-900 dark:border-primary-900 rounded-bl-md rounded-br-md rounded-tr-md p-2" wire:transition>
        <livewire:dynamic-component :is="$activeTab" :key="$activeTab"/>
    </div>
</div>
