<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" data-format="dd/MM/yyyy hh:mm:ss" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <div class="input-append time">
            <input data-format="hh:mm:ss" {{ $field->attributes() }}>
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
        </div>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>