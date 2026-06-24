<?php

use App\Models\Foliotipo;
use Livewire\Component;

new class extends Component {
    public $problemas = [];

    public function mount()
    {
        $opcion1 = 'problemas';
        $opcion2 = 'problem';

        $problema = Foliotipo::search($opcion1, $opcion2);

        $this->problemas = $problema->folios;
    }
};
?>

<x-livewire-parent-div>
    <x-aside-header-user-card titulo="⚠️ Problemas"/>

    <x-livewire-content-div>
        <x-aside-header-user-div-list>
            @forelse($this->problemas as $problema)
                <x-aside-user-card-ul>
                    <x-aside-user-card-ul-li-title title="{{$problema->numero ?? ''}}"/>
                    <x-aside-user-card-ul-li class="font-semibold">{{$problema->titulo ?? ''}}</x-aside-user-card-ul-li>
                    <x-aside-user-card-ul-li>{{$problema->descripcion ?? ''}}</x-aside-user-card-ul-li>
                </x-aside-user-card-ul>
            @empty
                <h1>No hay nada</h1>
            @endforelse
        </x-aside-header-user-div-list>
    </x-livewire-content-div>

</x-livewire-parent-div>
