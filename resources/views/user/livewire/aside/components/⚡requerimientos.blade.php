<?php

use Livewire\Component;
use App\Models\Foliotipo;

new class extends Component
{
    public $requerimientos = [];

    public function mount()
    {
        $opcion1 = 'requerimiento';
        $opcion2 = 'ritm';

        $requerimiento = Foliotipo::search($opcion1, $opcion2);

        $this->requerimientos = $requerimiento->folios;
    }
};
?>

<x-livewire-parent-div>
    <x-aside-header-user-card titulo="📑 RITM"/>
    <x-livewire-content-div>
        <x-aside-header-user-div-list>
            @forelse($this->requerimientos as $ritm)
                <x-aside-user-card-ul>
                   <x-aside-user-card-ul-li-title title="{{$loop->iteration}} - {{$ritm->titulo}}" class="font-semibold"/>
                </x-aside-user-card-ul>
            @empty
                <x-index-aside-forelse-empty title="No hay requerimientos registrados"/>
            @endforelse
        </x-aside-header-user-div-list>
    </x-livewire-content-div>
</x-livewire-parent-div>
