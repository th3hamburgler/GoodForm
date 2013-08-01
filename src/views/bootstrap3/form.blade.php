<form {{ $formAttributes }} novalidate>
@foreach($fields as $field)
    {{ $field }}
@endforeach
    <div class="form-actions">
@foreach($actions as $action)
    {{ $action->generate() }}
@endforeach
    </div>
</form>
