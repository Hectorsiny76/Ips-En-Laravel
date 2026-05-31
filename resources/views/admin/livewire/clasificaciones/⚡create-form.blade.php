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

    #[On('dropdown-selected')]
    public function updateDropdownField($field, $id)
    {
        $this->$field = $id;
    }

    public function save()
    {
        $this->validate();

        Clasificacione::create([
            'categoria_id'=>$this->categoria_id,
            'subcategoria_id' => $this->subcategoria_id,
            'servicio_id' => $this->servicio_id,
            'microservicio_id' => $this->microservicio_id,
        ]);

        return redirect()->route('admin.clasificaciones.index')->with('success', '¡Se ha agregado una nueva clasificación correctamente!');
    }

    public function render()
    {
        return view('admin.livewire.clasificaciones.⚡create-form');
    }
};
?>

<x-livewire-parent-div>
    <form wire:submit="save">
        @csrf
        <x-div-form-create-edit>
            <x-form-errors/>
            <x-input-form-label for="">Categoria</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Categoria"
                searchColumn="nombre"
                fieldToUpdate="categoria_id"
                placeholder="Busca una categoria"
            />

            <x-input-form-label for="">Subategoria</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Subcategoria"
                searchColumn="nombre"
                fieldToUpdate="subcategoria_id"
                placeholder="Busca una subcategoria"
            />

            <x-input-form-label for="">Servicio</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Servicio"
                searchColumn="nombre"
                fieldToUpdate="servicio_id"
                placeholder="Busca un servicio"
            />

            <x-input-form-label for="">Microservicio</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Microservicio"
                searchColumn="nombre"
                fieldToUpdate="microservicio_id"
                placeholder="Busca un microservicio"
            />

        </x-div-form-create-edit>
        <x-form-create-buttons href="{{ route('admin.clasificaciones.index') }}"/>
    </form>
</x-livewire-parent-div>
