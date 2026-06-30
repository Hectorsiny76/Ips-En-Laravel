@props(['selectedEst' => null])

<x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
    <x-index-div-table-thead-user>
        <x-index-div-table-thead-th-column-user>Titulo</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>Descripción</x-index-div-table-thead-th-column-user>
    </x-index-div-table-thead-user>
    <x-index-div-table-tbody>
        @foreach($selectedEst->pilotoprogramas as $programa)
            <tr>
                <x-index-div-table-tbody-tr-td>{{$programa->titulo}}</x-index-div-table-tbody-tr-td>
                <x-index-div-table-tbody-tr-td>{{$programa->descripcion_corta}}</x-index-div-table-tbody-tr-td>
            </tr>
        @endforeach
    </x-index-div-table-tbody>
</x-index-div-table>
