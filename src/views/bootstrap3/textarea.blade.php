@extends('good-form::bootstrap3.field')

@section('input')
    <textarea class="form-control {{ $field->class }}" {{ $field->attributes(['class']) }}>{{$field->value}}</textarea>
@stop