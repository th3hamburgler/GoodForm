<div class="control-group {{ $field->containerClass() }} image-picker-group">
    <label class="control-label" for="{{$field->id}}">{{$field->label}}</label>
    <div class="controls">
        <!--<ul class="thumbnails">
            <li class="span3">
                <a href="{{ $field->uploadURL() }}" class="thumbnail">
                    {{ $field->instance()->thumbnail() }}
                </a>
            </li>
        </ul>-->
        <select {{ $field->attributes(['value']) }}>
        @foreach ($field->options() as $label => $value)
            @if(is_array($value))
            <option {{ $field->selected($value['value']) }} <?=Stwt\GoodForm\GoodForm::arrayToAttributes($value)?>>{{ $label }}</option>
            @else
            <option {{ $field->selected($value) }} value="{{ $value }}">{{ $label }}</option>
            @endif
        @endforeach
        </select>
        {{ $field->help() }}
        {{ $field->errors() }}
    </div>
</div>