<?php

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Clasificacione;

new class extends Component {

    #[Validate('required|exists:categorias,id')]
    public $categoria_id;

    #[Validate('required|exists:subcategorias,id')]
    public $subcategoria_id;

    #[Validate('required|exists:servicios,id')]
    public $servicio_id;

    #[Validate('required|exists:microservicios,id')]
    public $microservicio_id;

    public Clasificacione $clasificacion;

    public function mount(Clasificacione $clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }

    #[On('dropdown-selected')]
    public function updateDropdownField($field, $id)
    {
        $this->$field = $id;
    }

    public function save()
    {
        $this->validate();

        $this->clasificacion->update([
            'categoria_id' => $this->categoria_id,
            'subcategoria_id' => $this->subcategoria_id,
            'servicio_id' => $this->servicio_id,
            'microservicio_id' => $this->microservicio_id,
        ]);

        return redirect()->route('admin.clasificaciones.index')->with('success', '¡Se ha actualizado la clasificación correctamente!');
    }

    public function render()
    {
        return view('admin.livewire.clasificaciones.⚡edit-form');
    }
};
?>

<div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
    <form wire:submit="save">
        @csrf
        <div class="mb-6">
            <x-form-errors/>
            <x-input-form-label for="">Categoria</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Categoria"
                searchColumn="nombre"
                fieldToUpdate="categoria_id"
                placeholder="Busca una categoria"
                initialId="{{$this->clasificacion->categoria->id}}"
                initialName="{{$this->clasificacion->categoria->nombre}}"
            />

            <x-input-form-label for="">Subategoria</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Subcategoria"
                searchColumn="nombre"
                fieldToUpdate="subcategoria_id"
                placeholder="Busca una subcategoria"
                initialId="{{$this->clasificacion->subcategoria->id}}"
                initialName="{{$this->clasificacion->subcategoria->nombre}}"
            />

            <x-input-form-label for="">Servicio</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Servicio"
                searchColumn="nombre"
                fieldToUpdate="servicio_id"
                placeholder="Busca un servicio"
                initialId="{{$this->clasificacion->servicio->id}}"
                initialName="{{$this->clasificacion->servicio->nombre}}"
            />

            <x-input-form-label for="">Microservicio</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Microservicio"
                searchColumn="nombre"
                fieldToUpdate="microservicio_id"
                placeholder="Busca un microservicio"
                initialId="{{$this->clasificacion->microservicio->id}}"
                initialName="{{$this->clasificacion->microservicio->nombre}}"
            />

        </div>
        <x-form-update-buttons href="{{ route('admin.clasificaciones.index') }}"/>
    </form>
</div>
