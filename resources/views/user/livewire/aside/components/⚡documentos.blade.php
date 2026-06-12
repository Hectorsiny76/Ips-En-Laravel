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

<div class="w-full p-4">
    <div class="flex w-full items-center justify-center">
        <h1>Documentos</h1>
    </div>
    
    <div class="flex-1 w-full items-center border-2 border-gray-800 rounded p-2 mt-4">
        <ul class="list-disc list-inside">
        @foreach($Documentos as $documento)
            <li class="text-gray-800 border-b border-gray-800 py-2">{{ $documento->titulo }}</li>
        @endforeach
    </ul>
    </div>
</div>