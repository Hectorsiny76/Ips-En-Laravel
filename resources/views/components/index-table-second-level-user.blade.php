
@props(['selectedEst' => null, 'tiendaString' => '', 'estacionString' => '', 'estTipoNombre' => ''])

<x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
    <x-index-div-table-thead-user>
        <x-index-div-table-thead-th-column-user>Cajas / TPV's</x-index-div-table-thead-th-column-user>
        @if($estTipoNombre === $tiendaString)
            <x-index-div-table-thead-th-column-user>Formato de Tienda</x-index-div-table-thead-th-column-user>
            <x-index-div-table-thead-th-column-user>Programa Tidel</x-index-div-table-thead-th-column-user>
            <x-index-div-table-thead-th-column-user>Cluster</x-index-div-table-thead-th-column-user>
        @endif
        @if($estTipoNombre === $estacionString)
            <x-index-div-table-thead-th-column-user>Tel</x-index-div-table-thead-th-column-user>
            <x-index-div-table-thead-th-column-user>Correo</x-index-div-table-thead-th-column-user>
            <x-index-div-table-thead-th-column-user>Contrato Ávalon</x-index-div-table-thead-th-column-user>
        @endif
    </x-index-div-table-thead-user>
    <x-index-div-table-tbody>
        <tr>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->cajas_tpvs}}</x-index-div-table-tbody-tr-td>
            @if($estTipoNombre === $tiendaString)
                <x-index-div-table-tbody-tr-td>{{$selectedEst->tiendaformato->nombre ?? 'No asignado'}}</x-index-div-table-tbody-tr-td>
                <x-index-div-table-tbody-tr-td>{{$selectedEst->tidelprograma->ip ?? 'No asignado'}}</x-index-div-table-tbody-tr-td>
                <x-index-div-table-tbody-tr-td>{{$selectedEst->cluster->nombre ?? 'No asignado'}}</x-index-div-table-tbody-tr-td>
            @endif
            @if($estTipoNombre === $estacionString)
                <x-index-div-table-tbody-tr-td class="cursor-pointer hover:text-green-800 transition-colors duration-300" @click="$copy('{{$selectedEst->tel}}')">{{$selectedEst->tel ?? 'No asignado'}}</x-index-div-table-tbody-tr-td>
                <x-index-div-table-tbody-tr-td class="cursor-pointer hover:text-green-800 transition-colors duration-300" @click="$copy('{{$selectedEst->correo}}')">{{$selectedEst->correo ?? 'No asignado'}}</x-index-div-table-tbody-tr-td>
                <x-index-div-table-tbody-tr-td>{{$selectedEst->avaloncontrato->numero ?? 'No asignado'}}</x-index-div-table-tbody-tr-td>
            @endif
        </tr>
    </x-index-div-table-tbody>
</x-index-div-table>
