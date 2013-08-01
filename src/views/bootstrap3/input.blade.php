@extends('good-form::bootstrap3.field')

@section('input')
    <input class="form-control" {{ $field->attributes(['class']) }} />
@stop