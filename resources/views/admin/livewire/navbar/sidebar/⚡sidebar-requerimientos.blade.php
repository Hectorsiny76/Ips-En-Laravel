<?php

use Livewire\Component;
use App\Models\Foliotipo;

new class extends Component
{
    public $requerimientos = [];

    public function mount()
    {
        $termino1 = 'requerimiento';

        $termino2 = 'ritm';

        $requerimiento = Foliotipo::with('folios')->where(function ($q) use($termino1, $termino2){
            $q->whereRaw('LOWER(tipo) like ?', "%{$termino1}%")
                ->orWhereRaw('LOWER(tipo) like ?', "%{$termino2}%");
        })->first();

        $this->requerimientos = $requerimiento->folios;
    }
};
?>

<div>
    <h1 class="text-bold text-xl">Requerimientos</h1>

    <ul>
        @foreach($this->requerimientos as $rit)
            <li>
                {{$rit->titulo ?? 'bada'}}
            </li>
        @endforeach
    </ul>

</div>
