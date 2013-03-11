<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <textarea {{ $field->attributes() }}>{{$field->value}}</textarea>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>