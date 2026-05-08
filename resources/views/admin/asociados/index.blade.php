
@extends('admin_layout.master')

@section('title', 'Asociados del Área '.$area->nombre)

@section('page-title', 'Asociados del Área '.$area->nombre)

@section('content')

    <x-nav-ol-first href="{{route('admin.areas.index')}}" nombre="Areas"/>

    <x-div-index-title-create-button
        title="Estos son los asociados del área {{$area->nombre}} - {{$area->descripcion}}"
        url="{{route('admin.areas.asociados.create', $area->id)}}"
        button="Agregar un nuevo Asociado"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Nombre
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Teléfono
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Correo
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($asociados as $asociado)
                <tr>
                    <td>
                        {{$asociado->nombre}}
                    </td>
                    <td>
                        {{$asociado->tel ?? 'N/A'}}
                    </td>
                    <td>
                        {{$asociado->email ?? 'N/A'}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.asociados.edit', $asociado->id)}}"
                        formaction="{{ route('admin.asociados.destroy', $asociado->id) }}"
                        formconfirm="¿Esta seguro de eliminar este asociado?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

