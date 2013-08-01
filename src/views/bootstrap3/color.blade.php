@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group input-color color" data-color-format="hex">
        <input class="form-control" data-format="yyyy-MM-dd" type="text" {{ $field->attributes(['class', 'type']) }} />
        <span class="input-group-addon"><i></i></span>
    </div>
@stop