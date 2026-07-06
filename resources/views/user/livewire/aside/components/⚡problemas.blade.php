<?php

use App\Models\Foliotipo;
use Livewire\Component;

new class extends Component {
    public function render()
    {
        $opcion1 = 'problemas';
        $opcion2 = 'problem';

        $problema = Foliotipo::search($opcion1, $opcion2);

        $problemas = $problema->folios;

        return view('user.livewire.aside.components.⚡problemas',
            [
               'problemas' => $problemas
            ]);
    }
};
?>

<x-livewire-parent-div>
    <x-aside-header-user-card titulo="⚠️ Problemas"/>

    <x-livewire-content-div>
        <x-aside-header-user-div-list>
            @forelse($problemas as $problema)
                <x-aside-user-card-ul>
                    <x-aside-user-card-ul-li-title title="{{$problema->numero ?? ''}}"/>
                    <x-aside-user-card-ul-li class="font-semibold">{{$problema->titulo ?? ''}}</x-aside-user-card-ul-li>
                    <x-aside-user-card-ul-li>{{$problema->descripcion ?? ''}}</x-aside-user-card-ul-li>
                </x-aside-user-card-ul>
            @empty
                <x-index-aside-forelse-empty title="No hay problemas reportados."/>
            @endforelse
        </x-aside-header-user-div-list>
    </x-livewire-content-div>

</x-livewire-parent-div>
