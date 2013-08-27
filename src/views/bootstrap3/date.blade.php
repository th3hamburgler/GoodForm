@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group date">
        <input type="text" class="form-control" data-format="yyyy-MM-dd" {{ $field->attributes(['class', 'type']) }} />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
        </span>
    </div>
@stop