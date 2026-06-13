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

<x-livewire-parent-div>
    <div class="flex border-b pt-2">
        <button
            wire:click="setTab('admin::livewire.tabs.tab-search')"
            @class(['pr-2 border rounded-tl-md',
                    'border-gray-700 bg-gray-800 text-white dark:bg-gray-300 dark:text-gray-900' => $activeTab === 'admin::livewire.tabs.tab-search',
                    'bg-gray-300 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white' => $activeTab !== 'admin::livewire.tabs.tab-search',
                    ])
        >Buscador</button>
        <button
            wire:click="setTab('admin::livewire.tabs.tab-clasifications')"
            @class(['pr-2 border rounded-tr-md',
                    'border-gray-700 bg-gray-800 text-white dark:bg-gray-300 dark:text-gray-900' => $activeTab === 'admin::livewire.tabs.tab-clasifications',
                    'bg-gray-300 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white' => $activeTab !== 'admin::livewire.tabs.tab-clasifications',
                    ])
        >Clasificaciones</button>
    </div>

    <div>
        <livewire:dynamic-component :is="$activeTab" :key="$activeTab"/>
    </div>

</x-livewire-parent-div>
