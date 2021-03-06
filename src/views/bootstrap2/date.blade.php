<div class="control-group {{ $field->containerClass() }}">
    <label class="control-label" data-format="dd/MM/yyyy hh:mm:ss" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <div class="input-append date">
            <input data-format="yyyy-MM-dd" type="text" {{ $field->attributes(['type']) }}>
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
        </div>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>