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
                    <x-aside-user-card-ul>

                        <x-aside-user-card-ul-li-title>{{$general->numero ?? ''}}</x-aside-user-card-ul-li-title>
                        <x-aside-user-card-ul-li class="font-semibold">{{$general->titulo ?? 'Sin titulo'}}</x-aside-user-card-ul-li>
                        <x-aside-user-card-ul-li>{{$general->descripcion ?? ''}}</x-aside-user-card-ul-li>

                    </x-aside-user-card-ul>
            @empty
                <div>
                    Sin generales
                </div>
            @endforelse
        </x-aside-header-user-div-list>
    </x-livewire-content-div>

</x-livewire-parent-div>
