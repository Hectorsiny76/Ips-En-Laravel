<?php

use Livewire\Component;
use App\Models\Foliotipo;

new class extends Component
{
    public $problemas = [];

    public function mount()
    {
        $termino1 = 'problema';

        $termino2 = 'prb';

        $problema = Foliotipo::with('folios')->where(function ($q) use($termino1, $termino2){
            $q->whereRaw('LOWER(tipo) like ?', "%{$termino1}%")
                ->orWhereRaw('LOWER(tipo) like ?', "%{$termino2}%");
        })->first();

        $this->problemas = $problema->folios;
    }
};
?>

<div>
    <h1 class="w-full text-center mb-2 text-bold text-xl">Problemas</h1>

    <ul>
        @foreach($this->problemas as $prob)
            <div class="p-2 mb-2 border border-gray-600 rounded-md">
                <li>
                    {{$prob->numero ?? 'Sin Numero'}}
                </li>
                <li>
                    {{$prob->titulo ?? 'Sin Titulo'}}
                </li>
                <li>
                    {{$prob->descripcion ?? 'Sin Descripción'}}
                </li>
            </div>
        @endforeach
    </ul>

</div>
