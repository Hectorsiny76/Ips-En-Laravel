<?php

use Livewire\Component;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    private $docString = 'doc';
    private $linkBool = true;

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

    public function render()
    {
        $documentos = Archivo::with('archivotipo')->orderBy('archivotipo_id')->get();

        $docs = Archivo::whereHas('archivotipo', function ($query) {
           $query->where('nombre','ilike', $this->docString);
        })->get();

        $links = Archivo::whereHas('archivotipo', function ($query) {
            $query->where('es_link', $this->linkBool);
        })->get();

        return view ('user.livewire.aside.components.⚡documentos',[
            'docs' => $docs,
            'links' => $links
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-session-alert/>

    <x-aside-header-user-card titulo="📋 Archivos"/>

    <div class="grid grid-flow-cols gap-2 w-full text-xs lg:text-lg p-2">

        <x-index-user-table-card-dropdown :primary="false" titulo="Documentos" :opened="true">

            @forelse($docs as $doc)

                <x-index-user-button-docs>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <button class="w-full text-left pl-1"
                            wire:click.prevent="downloadFile('{{$doc->ruta}}', '{{$doc->titulo}}')">
                        {{$doc->titulo}}
                    </button>
                </x-index-user-button-docs>

            @empty

                <p>Nada</p>

            @endforelse

        </x-index-user-table-card-dropdown>

        <x-index-user-table-card-dropdown :primary="false" titulo="Links" :opened="true">

            @forelse($links as $link)

                <x-index-user-button-docs :link="true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    <a
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full pl-1"
                        href="{{$link->ruta}}">
                        {{$link->titulo}}
                    </a>
                </x-index-user-button-docs>

            @empty

                <p>Nada</p>

            @endforelse

        </x-index-user-table-card-dropdown>

    </div>

</x-livewire-parent-div>
