
@extends('admin_layout.master')

@section('title', 'Áreas')

@section('page-title', 'Áreas')

@section('content')

    <x-div-index-title-create-button
        title="Estos son las Áreas actuales"
        url="{{route('admin.areas.create')}}"
        button="Agregar una nueva Área"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                No
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Nombre
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Descripcion
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                No. Asociados
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($areas as $area)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$area->nombre}}
                    </td>
                    <td>
                        {{$area->descripcion}}
                    </td>
                    <td>
                        {{$area->asociados_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.areas.edit', $area->id)}}"
                        formaction="{{ route('admin.areas.destroy', $area->id) }}"
                        formconfirm="¿Esta seguro de eliminar este tipo de folio?"
                    />
                    <x-table-td-fd-routing href="{{route('admin.areas.asociados.index', $area->id)}}">Asociados</x-table-td-fd-routing>
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

