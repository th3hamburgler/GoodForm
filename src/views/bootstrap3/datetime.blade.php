@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group datetime">
        <input type="text" class="form-control" data-format="yyyy-MM-dd hh:mm:ss" {{ $field->attributes(['class', 'type']) }} />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
        </span>
    </div>
@stop