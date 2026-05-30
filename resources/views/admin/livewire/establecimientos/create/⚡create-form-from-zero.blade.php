<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Establecimientotipo;
use App\Models\Estado;
use App\Models\Mercadogerente;
use App\Models\Mercado;
use App\Models\Campo;
use App\Models\Campogerente;
use App\Models\Establecimiento;
use App\Models\Tiendaformato;
use App\Models\Cluster;
use App\Models\Tidelprograma;

new #[Layout('admin_layout.master')]
class extends Component {

    // Tipo de establecimiento

    public $estTipo = null;

    // Selecciones

    public $selectedEstado = null;

    public $selectedMercadoGerente = null;

    public $selectedMercado = null;

    public $selectedCampo = null;

    public $selectedCampoGerente = null; // Id del gerente de campo

    // Opciones

    public $mercadoGerentes = [];

    public $mercados = [];

    public $campos = [];

    public $campoGerentes = [];

    // Datos del establecimiento

    public $datos = [
        'nombre' => '',
        'numero' => '',
        'cajas_tpvs' => '',
        'idred' => '',
        'tidelprograma_id' => null,
        'tiendaformato_id' => null,
        'cluster_id' => null,
        'centrodecostos' => null,
        'tel' => null,
        'correo' => null,
    ];

    public function mount($id)
    {
        $this->estTipo = Establecimientotipo::findOrFail($id);
    }

    public function updatedSelectedEstado($estadoId)
    {

        if(blank($estadoId)){

            $this->reset(['selectedEstado','selectedMercadoGerente','selectedMercado', 'selectedCampo', 'selectedCampoGerente', 'mercadoGerentes', 'mercados', 'campos', 'campoGerentes']);

            return;
        }

        $this->mercadoGerentes = Mercadogerente::where('estado_id', $estadoId)->get();

        $this->reset(['selectedMercadoGerente','selectedMercado', 'selectedCampo', 'selectedCampoGerente', 'mercados', 'campos', 'campoGerentes']);
    }

    public function updatedSelectedMercadoGerente($mercadoGerenteId)
    {

        if(blank($mercadoGerenteId)){
            $this->reset(['selectedMercadoGerente','selectedMercado', 'selectedCampo', 'selectedCampoGerente', 'mercados', 'campos', 'campoGerentes']);

            return;
        }

        $this->mercados = Mercado::where('mercadogerente_id', $mercadoGerenteId)
            ->where('establecimientotipo_id', $this->estTipo->id)
            ->get();

        $this->reset(['selectedMercado','selectedCampo', 'selectedCampoGerente', 'campos', 'campoGerentes']);
    }

    public function updatedSelectedMercado($mercadoId)
    {

        if(blank($mercadoId)){
            $this->reset(['selectedMercado', 'selectedCampo', 'selectedCampoGerente', 'campos', 'campoGerentes']);

            return;
        }

        $this->campos = Campo::where('mercado_id', $mercadoId)->get();

        $this->reset(['selectedCampo','selectedCampoGerente', 'campoGerentes']);
    }

    public function updatedSelectedCampo($campoId)
    {

        if(blank($campoId)){
            $this->reset(['selectedCampo', 'selectedCampoGerente','campoGerentes']);

            return;
        }

        $this->campoGerentes = Campogerente::where('campo_id', $campoId)->get();

        $this->reset(['selectedCampoGerente']);
    }

    public function rules()
    {
        $rules = [
            'selectedCampoGerente' => 'required|numeric|exists:campogerentes,id',
            'datos.nombre' => 'required|string|max:255',
            'datos.numero' => 'required|string|min:1|max:10',
            'datos.cajas_tpvs' => 'required|numeric|min:1',
            'datos.idred' => 'required|ip',
        ];

        $validacionesXEstablecimiento = [
            'tienda' => [
                'datos.tiendaformato_id' => 'required|numeric|exists:tiendaformatos,id',
                'datos.tidelprograma_id' => 'nullable|numeric|exists:tidelprogramas,id',
                'datos.cluster_id' => 'required|numeric|exists:clusters,id',
            ],
            'estacion' => [
                'datos.centrodecostos' => 'required|numeric|min:1|unique:establecimientos,centrodecostos',
                'datos.tel' => 'required|min:10|max:15',
                'datos.correo' => 'required|string|email',
            ]
        ];

        $rules = array_merge($rules, $validacionesXEstablecimiento[Str::slug($this->estTipo->nombre)] ?? []);

        return $rules;

    }

    public function save()
    {
        $validacion = $this->validate();

        $campogerente = Campogerente::findOrFail($this->selectedCampoGerente);

        $campogerente->establecimientos()->create($validacion['datos']);

        return redirect()->route('admin.establecimientotipo.show', $this->estTipo->id)->with('success', 'El establecimiento '.$this->datos['nombre'].' se ha creado correctamente.');
    }

    public function render()
    {
        return view('admin.livewire.establecimientos.create.⚡create-form-from-zero', [
                'estados' => Estado::all(),
                'estTipo' => $this->estTipo,
                'tiendaformatos' => Tiendaformato::all(),
                'clusters' => Cluster::all(),
                'tidelprogramas' => Tidelprograma::doesntHave('establecimiento')->pluck('ip', 'id'),
            ]);
    }

};
?>

@section('title', 'Crear '.$estTipo->nombre.' desde Cero')

@section('page-title', 'Crear '.$estTipo->nombre.' desde Cero')

<x-livewire-parent-div>

    <x-div-edit-create-title :cancel="true" href="{{route('admin.establecimientotipo.show', $this->estTipo->id)}}">
        Crear un@ {{$estTipo->nombre}} desde Cero
    </x-div-edit-create-title>

    <x-livewire-content-div>
        <x-dynamic-select-create-form-shallow model="selectedEstado" label="Estado" :options="$estados"/>

        @if(count($mercadoGerentes) > 0)
            <x-dynamic-select-create-form-shallow model="selectedMercadoGerente" label="Gerente de Mercado" :options="$mercadoGerentes"/>
        @endif

        @if(count($mercados) > 0)
            <x-dynamic-select-create-form-shallow model="selectedMercado" :numero="true" label="Mercado" :options="$mercados"/>
        @endif

        @if(count($campos) > 0)
            <x-dynamic-select-create-form-shallow model="selectedCampo" :numero="true" label="Campo" :options="$campos"/>
        @endif

        @if(count($campoGerentes) > 0)
            <x-dynamic-select-create-form-shallow model="selectedCampoGerente" label="Gerente de campo" :options="$campoGerentes"/>
        @endif

        @if($selectedCampoGerente)

            <x-form-errors/>

            <div class="border-t border-gray-400 my-6 pb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Agua Caliente"
                    wire:model="datos.nombre"
                    required/>

                <x-input-form-label for="numero">Numero</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="192"
                    wire:model="datos.numero"
                    min="1"
                    required/>

                <x-input-form-label for="cajas_tpvs">
                    @if(Str::slug($estTipo->nombre) == 'tienda')
                        Cajas
                    @elseif(Str::slug($estTipo->nombre) == 'estacion')
                        TPV's
                    @endif
                </x-input-form-label>

                <x-input-form
                    type="number"
                    name="cajas_tpvs"
                    placeholder="4"
                    wire:model="datos.cajas_tpvs"
                    min="1"
                    required/>

                <x-input-form-label for="idred">Id de Red</x-input-form-label>

                <x-input-form
                    type="text"
                    name="idred"
                    placeholder="8.8.8"
                    wire:model="datos.idred"
                    required/>

                @includeIf('admin.establecimientos.partials-create.'.Str::slug($estTipo->nombre))

                <x-form-create-buttons click="save" href="{{route('admin.establecimientotipo.show', $this->estTipo->id)}}"/>

            </div>

        @endif
    </x-livewire-content-div>

</x-livewire-parent-div>
