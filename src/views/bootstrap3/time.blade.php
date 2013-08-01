@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group time">
        <input class="form-control" data-format="hh:mm:ss" {{ $field->attributes(['class']) }} />
        <span class="input-group-addon"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
    </div>
@stop