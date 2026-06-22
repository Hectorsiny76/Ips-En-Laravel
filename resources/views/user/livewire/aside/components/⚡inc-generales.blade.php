<?php

use Livewire\Component;
use App\Models\Foliotipo;

new class extends Component
{
    public $generales = [];

    public function mount()
    {
        $opcion1 = 'general';
        $opcion2 = 'generales';

        $tipo = Foliotipo::search($opcion1, $opcion2);

        $this->generales = $tipo->folios;
    }
};
?>

<x-livewire-parent-div>
    <x-aside-header-user-card titulo="❗ Incidentes Generales"/>

    <x-livewire-content-div>
        <x-aside-header-user-div-list>
            @forelse($this->generales as $general)
                    <ul class="text-xs lg:text-lg p-2">

                        <li>{{$general->numero ?? ''}}</li>
                        <li>{{$general->titulo ?? 'Sin titulo'}}</li>
                        <li>{{$general->descripcion ?? ''}}</li>

                    </ul>
            @empty
                <div>
                    Sin generales
                </div>
            @endforelse
        </x-aside-header-user-div-list>
    </x-livewire-content-div>

</x-livewire-parent-div>
