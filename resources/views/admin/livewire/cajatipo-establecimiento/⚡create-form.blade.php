<?php

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Cajatipoestablecimiento;

new class extends Component {

    #[Validate('required|exists:establecimientos,id')]
    public $establecimiento_id;

    #[Validate('required|exists:cajatipos,id')]
    public $cajatipo_id;

    public $numcaja;

    #[On('dropdown-selected')]
    public function updateDropdownField($field, $id)
    {
        $this->$field = $id;
    }

    public function save()
    {
        $this->validate();

        Cajatipoestablecimiento::create([
            'establecimiento_id'=>$this->establecimiento_id,
            'cajatipo_id' => $this->cajatipo_id,
            'numcaja' => $this->numcaja,
        ]);

        return redirect()->route('admin.cajatipo-establecimiento.index')->with('success', '¡Se ha agregado una nueva relación correctamente!');
    }

    public function render()
    {
        return view('admin.livewire.cajatipo-establecimiento.⚡create-form');
    }
};
?>

<div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
    <form wire:submit="save">
        @csrf
        <div class="mb-6">
            <x-form-errors/>
            <x-input-form-label for="">Establecimiento</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Establecimiento"
                searchColumn="nombre"
                fieldToUpdate="establecimiento_id"
                placeholder="Busca un establecimiento por su nombre"
            />

            <x-input-form-label for="">Tipo de Caja</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Cajatipo"
                searchColumn="nombre"
                fieldToUpdate="cajatipo_id"
                placeholder="Busca un tipo de caja"
            />

            <x-input-form-label for="">Número de caja</x-input-form-label>

            <x-input-form
                type="number"
                name="numcaja"
                min="1"
                wire:model="numcaja"
                required
            />

        </div>
        <x-form-create-buttons href="{{ route('admin.cajatipo-establecimiento.index') }}"/>
    </form>
</div>
