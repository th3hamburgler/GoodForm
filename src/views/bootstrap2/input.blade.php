<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <input {{ $field->attributes() }}>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>