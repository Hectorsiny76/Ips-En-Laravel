<?php

use Livewire\Component;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    public $documentos = [];

    public function mount()
    {
        $this->documentos = Archivo::with('archivotipo')->get();
    }

    public function downloadFile($filePath, $title)
    {
        $disk = 'local';

        if ($filePath == null || !Storage::disk($disk)->exists($filePath)) {
            session()->flash('error', 'No se encontró el archivo a buscar.');
            return;
        }

        session()->flash('success', 'Descargando archivo...');
        return Storage::disk($disk)->download($filePath, $title);
    }
};
?>

<div class="w-full p-4">
    <div class="flex w-full items-center justify-center">
        <h1>Documentos</h1>
    </div>

    <div class="flex-1 w-full items-center border-2 border-gray-800 rounded p-2 mt-4">
        <ul class="list-disc list-inside">
            <div class="border-2  border-gray-500 rounded-md flex flex-col">
                @foreach($this->documentos as $doc)
                    <div class="p-2 flex-1">
                        @if($doc->archivotipo->es_link)
                            <div class="w-full p-2 flex items-center justify-center">
                                <a class="hover:text-blue-600 dark:text-blue-700" href="{{$doc->ruta}}">{{$doc->titulo}}</a>
                            </div>
                        @else
                            <button class="text-sm text-center w-full py-2 border rounded-md dark:border-blue-900 dark:hover:bg-blue-800 border-blue-700 hover:text-white hover:bg-blue-700"
                                    wire:click.prevent="downloadFile('{{$doc->ruta}}', '{{$doc->titulo}}')">
                                {{$doc->titulo}}
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
    </ul>
    </div>
</div>
