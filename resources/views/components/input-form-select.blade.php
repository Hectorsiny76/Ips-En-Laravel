 @props(['name', 'id', 'initialvalue', 'required' => true])

<select name="{{$name}}" id="{{$id}}" class="border rounded w-full py-2 px-3 text-gray-700" {{ $required ? 'required' : ''}} >
    <option value="">{{$initialvalue}}</option>
    {{$slot}}
</select>
