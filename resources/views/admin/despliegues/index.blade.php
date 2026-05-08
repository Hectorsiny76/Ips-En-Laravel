
@extends('admin_layout.master')

@section('title', 'Áreas')

@section('page-title', 'Áreas')

@section('content')

    <x-div-index-title-create-button
        title="Estos son despliegues actuales"
        url="{{route('admin.despliegues.create')}}"
        button="Agregar un nuevo Despliegue"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Titulo
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Descripcion
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Area
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Inicio
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Fin
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($despliegues as $despliegue)
                <tr>
                    <td>
                        {{$despliegue->titulo}}
                    </td>
                    <td>
                        {{$despliegue->descripcion}}
                    </td>
                    <td>
                        {{$despliegue->area->nombre}}
                    </td>
                    <td>
                        {{$despliegue->inicio}}
                    </td>
                    <td>
                        {{$despliegue->fin}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.despliegues.edit', $despliegue->id)}}"
                        formaction="{{ route('admin.despliegues.destroy', $despliegue->id) }}"
                        formconfirm="¿Esta seguro de eliminar este despliegue?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

