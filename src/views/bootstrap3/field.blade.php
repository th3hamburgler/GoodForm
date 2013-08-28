<div class="form-group {{ $field->containerClass() }} {{ $field->hasError() ? 'has-error' : '' }}">
    @section('label')
         <label class="control-label" for="{{$field->id}}">{{ $field->label }}</label>
    @show
    @section('input')
        <input type="{{$field->type}}" id="{{$field->id}}" placeholder="">
    @show
    @section('help')
        {{$field->help()}}
    @show
    @section('error')
        {{$field->errors() }}
    @show
</div>