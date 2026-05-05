
@extends('admin_layout.master')

@section('title', 'Lista de Programas Piloto')

@section('page-title', 'Lista de Programas Piloto')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Programas Piloto Actuales"
        url="{{route('admin.programas-piloto.create')}}"
        button="Agregar un nuevo programa piloto"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Fila
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Titulo
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Descripción Corta
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Establecimientos relacionados
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($pilotoProgramas as $pilotoPrograma)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$pilotoPrograma->titulo}}
                    </td>
                    <td>
                        {{$pilotoPrograma->descripcion_corta}}
                    </td>
                    <td>
                        {{$pilotoPrograma->establecimientos_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.programas-piloto.edit', $pilotoPrograma->id)}}"
                        formaction="{{ route('admin.programas-piloto.destroy', $pilotoPrograma->id) }}"
                        formconfirm="¿Esta seguro de eliminar esta duo de establecimientos de la lista?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

