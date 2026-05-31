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

    #[Validate('required|numeric|min:1')]
    public $numcaja;

    public Cajatipoestablecimiento $estCajaTipo;

    public function mount(Cajatipoestablecimiento $estCajaTipo)
    {
        $this->estCajaTipo = $estCajaTipo;

        $this->numcaja = $estCajaTipo->numcaja;
    }

    #[On('dropdown-selected')]
    public function updateDropdownField($field, $id)
    {
        $this->$field = $id;
    }

    public function save()
    {
        $this->validate();

        $this->estCajaTipo->update([
            'establecimiento_id'=>$this->establecimiento_id,
            'cajatipo_id' => $this->cajatipo_id,
            'numcaja' => $this->numcaja,
        ]);

        return redirect()->route('admin.cajatipo-establecimiento.index')->with('success', '¡Se ha agregado una nueva relación correctamente!');
    }

    public function render()
    {
        return view('admin.livewire.cajatipo-establecimiento.⚡edit-form');
    }
};
?>

<x-livewire-parent-div>
    <form wire:submit="save">
        @csrf
        <x-livewire-content-div>
            <x-form-errors/>
            <x-input-form-label for="">Establecimiento</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Establecimiento"
                searchColumn="nombre"
                fieldToUpdate="establecimiento_id"
                placeholder="Busca un establecimiento por su nombre"
                initialId="{{$this->estCajaTipo->establecimiento->id}}"
                initialName="{{$this->estCajaTipo->establecimiento->nombre}}"
            />

            <x-input-form-label for="">Tipo de Caja</x-input-form-label>

            <livewire:admin::livewire.global.searchable-dropdown
                model="App\Models\Cajatipo"
                searchColumn="nombre"
                fieldToUpdate="cajatipo_id"
                placeholder="Busca un tipo de caja"
                initialId="{{$this->estCajaTipo->cajatipo->id}}"
                initialName="{{$this->estCajaTipo->cajatipo->nombre}}"
            />

            <x-input-form-label for="">Número de caja</x-input-form-label>

            <x-input-form
                type="number"
                name="numcaja"
                min="1"
                wire:model="numcaja"
                required
            />

        </x-livewire-content-div>
        <x-form-create-buttons href="{{ route('admin.cajatipo-establecimiento.index') }}"/>
    </form>
</x-livewire-parent-div>
