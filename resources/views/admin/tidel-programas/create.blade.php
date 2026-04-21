@extends('admin_layout.master')

@section('title', 'Crear una nueva migración a TIDEL')

@section('page-title', 'Crear una nueva migración a TIDEL')

@section('content')

    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Crear una nueva migración a TIDEL</h1>
    </div>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.tidel-programas.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="ip">IP TIDEL</x-input-form-label>

                <x-input-form
                    type="text"
                    name="ip"
                    placeholder="8.8.8.8"
                    value="{{old('ip')}}"
                    required></x-input-form>

                <x-input-form-label for="fechamigracion">Fecha Migracion</x-input-form-label>

                <x-input-form
                    type="date"
                    name="fechamigracion"
                    placeholder=""
                    value="{{old('fecha')}}"
                ></x-input-form>
            </div>
            <div class="flex justify-center space-x-3 mt-8 pt-4 border-t border-gray-500">
                <a href="{{route('admin.tidel-programas.index')}}" class="px-6 py-2 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="px-6 py-2 text-lg font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Crear
                </button>
            </div>
        </form>
    </div>

@endsection
