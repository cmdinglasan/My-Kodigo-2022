@props(['disabled' => false, 'options' => []])

<select {!! $attributes->merge(['class' => 'w-auto rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pr-10']) !!}>
    <option value="" selected>Choose an option</option>
    @foreach($options as $key => $option)
        <option value="{{ $key }}">{{ $option }}</option>
    @endforeach
</select>
