<x-input-form-label for="centrodecostos">Centro de Costos</x-input-form-label>

<x-input-form
    type="number"
    name="centrodecostos"
    placeholder="6262"
    value="{{old('centrodecostos')}}"
    min="1"
    required/>

<x-input-form-label for="tel">Teléfono</x-input-form-label>

<x-input-form
    type="tel"
    name="tel"
    placeholder="8181818181"
    value="{{old('tel')}}"
    required/>

<x-input-form-label for="correo">Correo</x-input-form-label>

<x-input-form
    type="email"
    name="correo"
    placeholder="example@example.com"
    value="{{old('correo')}}"
    required/>

