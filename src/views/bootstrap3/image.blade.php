@extends('good-form::bootstrap3.input')

@section('input')
    
        @if ($field->value)
        <div class="thumbnail">
            <img src="{{ JitImage::source('/images/'.$field->value)->cropAndResize(1120, 50, 5); }}" height="50" width="1120" />
        </div>
        <br />
        <div class="input-group file-input-group">
            <span class="input-group-btn">
                <button class="btn remove-file" title="Remove the existing file and upload another."><span class="glyphicon glyphicon-trash"></span></button>
            </span>
            <input class="form-control" type="text" readonly {{ $field->attributes(['class', 'type']) }} />
            <input class="form-control hidden" disabled {{ $field->attributes(['class']) }} />
        </div>
        @else
        <div class="input-group file-input-group">
            <span class="input-group-btn">
                <button class="btn remove-file" disabled><span class="glyphicon glyphicon-trash"></span></button>
            </span>
            <input class="form-control" {{ $field->attributes(['class']) }} />
        </div>
        @endif
@stop