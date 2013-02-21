<div class="control-group">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <select id="{{$field->id}}" name="{{$field->name}}">
        @foreach ($field->options as $v => $l)
            <option {{$field->selected($v)}} value="{{$v}}">{{$l}}</option>
        @endforeach
        </select>
        <span class="help-inline">{{$field->help}}</span>
        <span class="error-inline">{{$field->error}}</span>
    </div>
</div>