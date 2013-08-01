<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{ $field->id }}">{{$field->label}}</label>
    <div class="controls">
        <div class="input-append input-color color" data-color-format="hex">
            <input type="text" {{ $field->attributes(['type']) }} />
            <span class="add-on"><i></i></span>
        </div>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>