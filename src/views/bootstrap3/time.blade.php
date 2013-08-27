@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group time">
        <input class="form-control" data-format="hh:mm:ss" type="text" {{ $field->attributes(['class', 'type']) }} />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-time" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
        </span>
    </div>
@stop