@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group file-input-group">
        @if ($field->value)
          <span class="input-group-btn">
            <button class="btn remove-file" title="Remove the existing file and upload another."><span class="glyphicon glyphicon-trash"></span></button>
          </span>
          <input class="form-control" type="text" readonly {{ $field->attributes(['class', 'type']) }} />
          <input class="form-control hidden" disabled {{ $field->attributes(['class']) }} />
        @else
          <span class="input-group-btn">
            <button class="btn remove-file" disabled><span class="glyphicon glyphicon-trash"></span></button>
          </span>
          <input class="form-control" {{ $field->attributes(['class']) }} />
        @endif
    </div>
@stop