<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <textarea id="{{$field->id}}" name="{{$field->name}}">{{$field->value}}</textarea>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>