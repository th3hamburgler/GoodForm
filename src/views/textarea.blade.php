<div class="control-group">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <textarea id="{{$field->id}}" name="{{$field->name}}">{{$field->value}}</textarea>
        <span class="help-inline">{{$field->help}}</span>
        <span class="error-inline">{{$field->error}}</span>
    </div>
</div>