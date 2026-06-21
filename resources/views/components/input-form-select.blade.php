 @props(['name' => '', 'id' => '', 'initialvalue', 'required' => true, 'register' => false])

<select name="{{$name}}" id="{{$id}}" {{$register ? $attributes->merge(['class'=>"border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"]) : $attributes->merge(['class'=>"text-xs lg:text-lg dark:bg-gray-800 dark:text-gray-300 border rounded w-full py-2 px-3 text-gray-700"])}}  {{ $required ? 'required' : ''}} >
    <option value="">{{$initialvalue}}</option>
    {{$slot}}
</select>
