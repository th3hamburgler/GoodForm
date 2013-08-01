@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group datetime">
        <input class="form-control" data-format="yyyy-MM-dd hh:mm:ss" {{ $field->attributes(['class']) }} />
        <span class="input-group-addon"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
    </div>
@stop