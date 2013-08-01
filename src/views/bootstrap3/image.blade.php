@extends('good-form::bootstrap3.input')

@section('input')
    <div class="input-group image-picker-group">
        <select {{ $field->attributes(['value']) }}>
        @foreach ($field->options() as $label => $value)
            @if(is_array($value))
            <option {{ $field->selected($value['value']) }} <?=Stwt\GoodForm\GoodForm::arrayToAttributes($value)?>>{{ $label }}</option>
            @else
            <option {{ $field->selected($value) }} value="{{ $value }}">{{ $label }}</option>
            @endif
        @endforeach
        </select>
    </div>
@stop