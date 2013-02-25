<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <input id="{{$field->id}}" name="{{$field->name}}" type="{{$field->type}}" value="{{$field->value}}">
        {{{ $field->help() }}}
        {{{ $field->errors() }}}
    </div>
</div>