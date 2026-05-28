@props(['options', 'label', 'model', 'numero' => false])

@if(count($options) > 0 )

    <div class="mt-4">
        <label for="select">{{$label}}</label>

        <select wire:model.live="{{$model}}" wire:key="select-{{$model}}" class="border rounded w-full py-2 px-3 text-gray-700" id="select-{{$model}}">
            <option value="">-- Selecciona un {{$label}} --</option>

            @foreach($options as $option)

                <option value="{{$option->id}}">{{$numero ? $option->numero : $option->nombre}}</option>

            @endforeach

        </select>

        @error($model) <span class="text-red-500 text-sm">{{$message}}</span> @enderror

    </div>

@endif

