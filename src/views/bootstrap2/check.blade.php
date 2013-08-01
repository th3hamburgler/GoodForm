<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
    @foreach($field->options as $label => $value)
        <label class="{{ $field->type }}">
            <input 
                {{ $field->checked($value) }}
                id="{{ $field->id }}-{{ $value }}" 
                name="{{ $field->name }}" 
                type="{{ $field->type }}" 
                value="{{$value}}"
            > {{ $label }}
        </label>
    @endforeach
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>