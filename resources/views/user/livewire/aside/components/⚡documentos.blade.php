<?php

use Livewire\Component;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    public $documentos = [];

    public function mount()
    {
        $this->documentos = Archivo::with('archivotipo')->orderBy('archivotipo_id')->get();
    }

    public function downloadFile($filePath, $title)
    {
        $disk = 'local';

        if ($filePath == null || !Storage::disk($disk)->exists($filePath)) {
            session()->flash('error', 'No se encontró el archivo.');
            return;
        }

        session()->flash('success', 'Descargando archivo...');
        return Storage::disk($disk)->download($filePath, $title);
    }
};
?>

<x-livewire-parent-div>

    <x-session-alert/>

    <x-aside-header-user-card titulo="📋 Documentos"/>

    <div class="flex-1 w-full text-xs lg:text-lg p-2">
        @foreach($this->documentos as $doc)
                <div class="flex-1 p-1">
                    @if($doc->archivotipo->es_link)
                        <x-index-user-button-docs :link="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>
                            <a
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-full pl-1"
                                href="{{$doc->ruta}}">
                                {{$doc->titulo}}
                            </a>
                        </x-index-user-button-docs>
                    @else
                        <x-index-user-button-docs>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            <button class="w-full text-left pl-1"
                                    wire:click.prevent="downloadFile('{{$doc->ruta}}', '{{$doc->titulo}}')">
                                {{$doc->titulo}}
                            </button>
                        </x-index-user-button-docs>
                    @endif
                </div>
        @endforeach
    </div>
</x-livewire-parent-div>
