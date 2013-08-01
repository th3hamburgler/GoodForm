@extends('good-form::bootstrap3.input')

@section('input')
    <input id="{{$field->id}}-false" name="{{$field->name}}" type="hidden" value="0">
    <input 
        {{ ($field->value ? 'checked' : '') }} 
        id="{{$field->id}}" 
        name="{{$field->name}}" 
        type="checkbox" 
        value="1"
    />
@stop