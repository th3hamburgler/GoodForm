@extends('good-form::bootstrap3.input')

@section('input')
    @foreach($field->options as $label => $value)
        <label class="{{ $field->type }}">
            <input 
                {{ $field->checked($value) }}
                id="{{ $field->id }}-{{ $value }}" 
                name="{{ $field->name }}" 
                type="{{ $field->type }}" 
                value="{{$value}}"
            > {{ $label }}
        </label>
    @endforeach
@stop