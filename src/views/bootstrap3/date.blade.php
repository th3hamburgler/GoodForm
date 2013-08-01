@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group date">
        <input class="form-control" data-format="yyyy-MM-dd" {{ $field->attributes(['class']) }} />
        <span class="input-group-addon"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
    </div>
@stop