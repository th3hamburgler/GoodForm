<div class="control-group">
    @section('label')
         <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    @show
    <div class="controls">
    @section('input')
        <input type="{{$field->type}}" id="{{$field->id}}" placeholder="">
    @show
    @section('help')
        <span class="help-inline">{{$field->help}}</span>
    @show
    @section('error')
        <span class="error-inline">{{$field->error}}</span>
    @show
    </div>
</div>