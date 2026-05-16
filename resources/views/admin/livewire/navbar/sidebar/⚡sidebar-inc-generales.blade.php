<?php

use Livewire\Component;
use App\Models\Foliotipo;

new class extends Component {
    public $generales = [];

    public function mount()
    {
        $termino1 = 'general';

        $termino2 = 'grl';

        $general = Foliotipo::with('folios')->where(function ($q) use ($termino1, $termino2) {
            $q->whereRaw('LOWER(tipo) like ?', "%{$termino1}%")
                ->orWhereRaw('LOWER(tipo) like ?', "%{$termino2}%");
        })->first();

        $this->generales = $general->folios;
    }
};
?>

<div>
    <h1 class="w-full text-center mb-2 text-bold text-xl">Incidentes Generales</h1>

    <ul>
        @foreach($this->generales as $grl)
            <div class="p-2 mb-2 border border-gray-600 rounded-md">
                <li>
                    {{$grl->numero ?? 'Sin Numero'}}
                </li>
                <li>
                    {{$grl->titulo ?? 'Sin Titulo'}}
                </li>
                <li>
                    {{$grl->descripcion ?? 'Sin Descripción'}}
                </li>
            </div>
        @endforeach
    </ul>

</div>
