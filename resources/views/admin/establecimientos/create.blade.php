@extends('admin_layout.master')

@section('title', 'Crear '.$estTipo->nombre)

@section('page-title', 'Crear '.$estTipo->nombre)

@section('content')

    <div x-data="{
    tipoEstablecimiento: '{{ old('area_id') }}',
    nuevoProgramaTidel: {{ old('nuevo_programa_tidel') ? 'true' : 'false' }}
    }">

        <form action="{{ route('admin.establecimientos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Tipo de establecimiento</label>
                <select name="establecimientotipo_id" x-model="tipoEstablecimiento" class="...">
                    <option value="">Selecciona el tipo de establecimiento...</option>
                    @foreach($estTipos as $estTipo)
                        <option value="{{ $estTipo->id }}">{{ $estTipo->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4" x-show="selectedArea == '1'" x-cloak>
                <label>Industrial Certifications</label>
                <input type="text" name="industrial_certifications" value="{{ old('industrial_certifications') }}">
            </div>

            <div class="mb-4" x-show="selectedArea == '2'" x-cloak>
                <label>Portfolio Link</label>
                <input type="url" name="art_portfolio_link" value="{{ old('art_portfolio_link') }}">
            </div>
            <div class="mb-4 p-4 border rounded bg-gray-50">

                <label class="flex items-center space-x-2 mb-4">
                    <input type="checkbox" x-model="isNewTeacher">
                    <span class="text-sm font-medium text-gray-700">This is a new teacher (Not in the system yet)</span>
                </label>

                <div x-show="!isNewTeacher">
                    <label>Select Teacher</label>
                    <select name="teacher_id" class="...">
                        <option value="">Choose...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div x-show="isNewTeacher" x-cloak>
                    <label>New Teacher Name</label>
                    <input type="text" name="new_teacher_name" value="{{ old('new_teacher_name') }}" placeholder="e.g. Mr. Smith">
                </div>

            </div>

            <button type="submit">Save Student</button>
        </form>
    </div>
@endsection
