<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <input class="input-medium" id="{{$field->id}}" name="{{$field->name}}[date]" type="date" value="{{$field->value['date']}}"/>
        <input class="input-mini"   id="{{$field->id}}" name="{{$field->name}}[time]" type="time" value="{{$field->value['time']}}"/>
        {{{ $field->help() }}}
        {{{ $field->errors() }}}
    </div>
</div>