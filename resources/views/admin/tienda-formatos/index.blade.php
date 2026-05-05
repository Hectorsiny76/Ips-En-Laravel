@extends('admin_layout.master')

@section('title', 'Lista Formatos de Tienda')

@section('page-title', 'Lista de Formatos de Tienda')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Formatos de Tienda actuales"
        url="{{route('admin.tienda-formatos.create')}}"
        button="Agregar un nuevo Formato de Tienda"/>

    <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>Nombre</x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>Establecimientos relacionados</x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>

            <x-index-div-table-tbody>
                @foreach($tiendaformatos as $tiendaformato)
                    <tr>
                        <td>
                            {{$tiendaformato->nombre}}
                        </td>

                        <td>
                            {{$tiendaformato->establecimientos_count}}
                        </td>

                    <x-table-td-actions
                        ahref="{{route('admin.tienda-formatos.edit', $tiendaformato->id)}}"
                        formaction="{{route('admin.tienda-formatos.destroy', $tiendaformato->id)}}"
                        formconfirm="¿Esta seguro de que desea eliminar este formato de tienda?"
                    />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
    </x-index-div-table>

@endsection
