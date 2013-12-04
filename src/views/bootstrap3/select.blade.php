@extends('good-form::bootstrap3.field')

@section('input')
    <select class="form-control" {{ $field->attributes(['class','value']) }}>
    @foreach ($field->options() as $label => $value)
        <option {{ $field->selected($value) }} value="{{ $value }}">{{ $label }}</option>
    @endforeach
    </select>
@stop
