<form {{ $formAttributes }} novalidate>
@foreach($fields as $field)
    {{ $field->generate() }}
@endforeach
    <div class="form-actions">
@foreach($actions as $action)
    {{ $action->generate() }}
@endforeach
    </div>
</form>
