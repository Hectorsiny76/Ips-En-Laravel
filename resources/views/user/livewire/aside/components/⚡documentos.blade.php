<?php

use Livewire\Component;
use App\Models\Archivo;

new class extends Component
{
    public $Documentos = [];

    public function mount()
    {
        $this->Documentos = Archivo::all();
    }
};
?>

<div class="w-full p-2">
    <div class="flex w-full items-center justify-center">
        <h1>Documentos</h1>
    </div>
    
    <div class="flex-1 w-full items-center">
        <ul>
        @foreach($Documentos as $documento)
            <li>{{ $documento->titulo }}</li>
        @endforeach
    </ul>
    </div>
</div>