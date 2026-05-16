<?php

use Livewire\Component;
use App\Models\Archivo;

new class extends Component
{
    public $documentos = [];

    public function mount()
    {
        $this->documentos = Archivo::all();
    }
};
?>

<div>
    <h1 class="text-bold text-xl">Documentos</h1>

    <ul>
        @foreach($this->documentos as $documento)
            <li>
                {{$documento->titulo}}
            </li>
        @endforeach
    </ul>

</div>
