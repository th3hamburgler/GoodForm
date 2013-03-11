<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{ $field->id }}">{{$field->label}}</label>
    <div class="controls">
        <div class="input-append input-color color" data-color-format="hex">
            <input class="input-small" id="{{ $field->id }}" name="{{ $field->name }}" type="text" value="{{ $field->value }}">
            <span class="add-on"><i></i></span>
        </div>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>