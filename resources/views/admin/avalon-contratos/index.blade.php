@extends('admin_layout.master')

@section('title', 'Lista de Contratos Ávalon')

@section('page-title', 'Lista de Contratos Ávalon')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Contratos Ávalon existentes"
        url="{{route('admin.avalon-contratos.create')}}"
        button="Agregar un nuevo Contrato Ávalon"
    />

    <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    Numero
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Estatus
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Estación
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
            @foreach($avaloncontratos as $avaloncontrato)
                <tr>
                    <td>
                        {{$avaloncontrato->numero}}
                    </td>
                    <td @class(['text-red-700'=>$avaloncontrato->estatus->id == 1, 'text-green-700'=>$avaloncontrato->estatus->id == 2])>
                        {{$avaloncontrato->estatus->nombre}}
                    </td>
                    <td>
                        {{$avaloncontrato->establecimiento?->nombre ?? 'Sin asignar'}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.avalon-contratos.edit', $avaloncontrato->id)}}"
                        formaction="{{route('admin.avalon-contratos.destroy', $avaloncontrato->id)}}"
                        formconfirm="¿Está seguro de que desea eliminar este contrato?"
                        />
                </tr>
            @endforeach
            </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

