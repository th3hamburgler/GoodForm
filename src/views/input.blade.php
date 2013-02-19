@extends('good-form::template')
@section('label')
<label class="control-label" for="{{ $f->id }}">{{ $label }}</label>
@stop
@section('control')
<input id="{{ $f->id }}" name="{{ $name }}" placeholder="">
@stop