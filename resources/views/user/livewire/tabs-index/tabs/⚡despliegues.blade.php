<?php

use Livewire\Component;
use App\Models\Despliegue;

new class extends Component
{
    public $despliegues = [];

    public function mount()
    {
        $this->despliegues = Despliegue::with('area')
            ->orderBy('inicio', 'desc')
            ->get();
    }

};
?>

<div>

    <table class="border-collapse border w-full">
        <thead>
        <tr class="text-xs lg:text-lg">
            <th>
                Titulo
            </th>
            <th>
                Desc
            </th>
            <th>
                Area
            </th>
            <th>
                Inicio
            </th>
            <th>
                Fin
            </th>
        </tr>
        </thead>
        <tbody class="text-xs lg:text-lg">
            @forelse($despliegues as $despliegue)
                <tr>
                    <td>{{$despliegue->titulo}}</td>
                    <td>{{$despliegue->descripcion}}</td>
                    <td>{{$despliegue->area->nombre}}</td>
                    <td>{{$despliegue->inicio}}</td>
                    <td>{{$despliegue->fin}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay nada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
