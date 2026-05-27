<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Microservicio;
use App\Models\Clasificacione;


new #[Layout('admin_layout.master')] class extends Component
{

    #[Validate('required|string|max:255')]
    public $categoria = '';

    #[Validate('required|string|max:255')]
    public $subcategoria = '';

    #[Validate('required|string|max:255')]
    public $servicio = '';

    #[Validate('required|string|max:255')]
    public $microservicio = '';

    public function save()
    {
        $this->validate();

        $categoria = Categoria::create(['nombre' => $this->categoria]);

        $subcategoria = Subcategoria::create(['nombre' => $this->subcategoria]);

        $servicio = Servicio::create(['nombre' => $this->servicio]);

        $microservicio = Microservicio::create(['nombre' => $this->microservicio]);

        Clasificacione::create([
            'categoria_id'=>$categoria->id,
            'subcategoria_id' => $subcategoria->id,
            'servicio_id' => $servicio->id,
            'microservicio_id' => $microservicio->id,
        ]);

        return redirect()->route('admin.clasificaciones.index')->with('success', '¡Se ha agregado una nueva clasificación correctamente!');
    }

};
?>

@section('title', 'Crear Clasificación desde Cero')

@section('page-title', 'Crear Clasificación desde Cero')

<div class="overflow-y-auto">

    <x-div-edit-create-title>Crear una Clasificación desde Cero</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form wire:submit="save" method="POST">
            <div class="mb-6">
                <x-input-form-label for="categoria">Categoria</x-input-form-label>

                <x-input-form
                    type="text"
                    name="categoria"
                    placeholder="Gestion de Base De Datos"
                    value=""
                    id="categoria"
                    wire:model="categoria"
                    required/>

                <x-input-form-label for="subcategoria">Subcategoria</x-input-form-label>

                <x-input-form
                    type="text"
                    name="subcategoria"
                    placeholder="Manejo de Base De Datos"
                    value=""
                    id="subcategoria"
                    wire:model="subcategoria"
                    required/>

                <x-input-form-label for="servicio">Servicio</x-input-form-label>

                <x-input-form
                    type="text"
                    name="servicio"
                    placeholder="Soportar Hand Held"
                    value=""
                    id="servicio"
                    wire:model="servicio"
                    required/>

                <x-input-form-label for="microservicio">Microservicio</x-input-form-label>

                <x-input-form
                    type="text"
                    name="microservicio"
                    placeholder="Reparar DB"
                    value=""
                    id="microservicio"
                    wire:model="microservicio"
                    required/>

            </div>
            <x-form-create-buttons href="{{ route('admin.clasificaciones.index') }}"/>
        </form>
    </div>

</div>
