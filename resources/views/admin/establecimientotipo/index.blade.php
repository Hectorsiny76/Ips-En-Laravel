@extends('admin_layout.master')

@section('title', 'Tipos de establecimientos')

@section('page-title', 'Tipos de establecimientos')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los tipos de establecimientos actuales"
        url="{{ route('admin.establecimientotipo.create')}}"
        button="Agregar nuevo tipo de establecimiento"
        />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Nombre
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Archivos relacionados
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column :routing="true"/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($estTipos as $estTipo)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                        {{$estTipo->nombre}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                        {{$estTipo->archivos_count}}
                    </td>
                    <x-table-td-partial-edit href="{{route('admin.establecimientotipo.edit', $estTipo->id)}}" value="Agregar Archivos Relacionados"/>
                    <x-table-td-actions
                        ahref="{{route('admin.establecimientotipo.edit', $estTipo->id)}}"
                        formaction="{{route('admin.establecimientotipo.destroy', $estTipo->id)}}"
                        formconfirm="¿Esta seguro de que desea eliminar este tipo de establecimiento?"
                        warning="¡Esta acción podría tener consecuencias fatales con los registros relacionados!"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection
