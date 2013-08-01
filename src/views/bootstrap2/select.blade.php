<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{ $field->id }}">{{ $field->label }}</label>
    <div class="controls">
        <select {{ $field->attributes() }}>
        @foreach ($field->options() as $label => $value)
            <option {{ $field->selected($value) }} value="{{ $value }}">{{ $label }}</option>
        @endforeach
        </select>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>