<?php

use Livewire\Component;
use App\Models\Foliotipo;

new class extends Component
{
    public function render()
    {
        $opcion1 = 'general';
        $opcion2 = 'generales';

        $tipo = Foliotipo::search($opcion1, $opcion2);

        $generales = $tipo->folios;

        return view('user.livewire.aside.components.⚡inc-generales', [
           'generales' => $generales
        ]);
    }
};
?>

<x-livewire-parent-div class="h-full">

    <x-session-alert/>

    <x-aside-header-user-card titulo="❗ Incidentes Generales"/>

    <x-livewire-content-div class="h-full">
        <x-aside-header-user-div-list class="h-full">
            @forelse($generales as $general)
                    <x-aside-user-card-ul>

                        <x-aside-user-card-ul-li-title title="{{$general->numero ?? ''}}"></x-aside-user-card-ul-li-title>
                        <x-aside-user-card-ul-li class="font-semibold">{{$general->titulo ?? 'Sin titulo'}}</x-aside-user-card-ul-li>
                        <x-aside-user-card-ul-li>{{$general->descripcion ?? ''}}</x-aside-user-card-ul-li>

                    </x-aside-user-card-ul>
            @empty
                <x-index-aside-forelse-empty title="No hay generales reportados."/>
            @endforelse
        </x-aside-header-user-div-list>
    </x-livewire-content-div>

</x-livewire-parent-div>
