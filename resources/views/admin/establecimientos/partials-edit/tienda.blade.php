<x-input-form-label for="tiendaformato">Formato de tienda</x-input-form-label>

<x-input-form-select name="tiendaformato_id" id="tiendaformato" initialvalue="-- Escoje un formato de tienda --">
    @foreach($tiendaformatos as $tiendaformato)
        <option value="{{$tiendaformato->id}}" @selected(old('tiendaformato_id', $establecimiento->tiendaformato->id ?? "") == $tiendaformato->id)>{{$tiendaformato->nombre}}</option>
    @endforeach
</x-input-form-select>

<x-input-form-label for="tidelprograma">Programas Tidel Disponibles</x-input-form-label>

<x-input-form-select name="tidelprograma_id" id="tidelprograma" initialvalue="-- TIDEL Disponibles --">
    @foreach($tidelprogramas as $id => $ip)
        <option value="{{$id}}" @selected(old('tidelprograma_id', $establecimiento->tidelprograma->id ?? "") == $id)>{{$ip}}</option>
    @endforeach
</x-input-form-select>

<x-input-form-label for="cluster">Cluster</x-input-form-label>

<x-input-form-select name="cluster_id" id="cluster" initialvalue="-- Clusters --">
    @foreach($clusters as $cluster)
        <option value="{{$cluster->id}}" @selected(old('cluster_id', $establecimiento->cluster->id ?? "") == $cluster->id)>{{$cluster->nombre}}</option>
    @endforeach
</x-input-form-select>
