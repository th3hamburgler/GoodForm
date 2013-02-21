<div class="control-group">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <input id="{{$field->id}}" name="{{$field->name}}" type="{{$field->type}}" value="{{$field->value}}">
        <span class="help-inline">{{$field->help}}</span>
        <span class="error-inline">{{$field->error}}</span>
    </div>
</div>