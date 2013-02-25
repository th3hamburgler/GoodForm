<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <input id="{{$field->id}}-false" name="{{$field->name}}" type="hidden" value="0">
        <input 
            {{ ($field->value ? 'checked' : '') }} 
            id="{{$field->id}}" 
            name="{{$field->name}}" 
            type="checkbox" 
            value="1"
        />
        {{{ $field->help() }}}
        {{{ $field->errors() }}}
    </div>
</div>