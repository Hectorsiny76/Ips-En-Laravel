@extends('main_layout.main')


@section('title', 'Requerimientos')
@section('contenido')

    <div class="bg-white gap-6 p-4 flex-col h-auto">
        <form action="{{ route('user.main.show') }}" method="POST" class="grid grid-cols-12 gap-4">
            @csrf
            <div class="flex-col col-span-5">
                <input type="text" name="nombre" placeholder="Nombre">
            </div>

            <div class="flex-col col-span-5">
                <input type="text" name="numero" placeholder="Numero">
            </div>

            <div class="flex flex-col col-span-2">
                <button type="submit" class="bg-green-800 text-white p-2 rounded w-full">Buscar</button>
            </div>

            <div class="col-span-12">
                <x-tabla-tienda-index />
            </div>
        </form>
    </div>

@endsection