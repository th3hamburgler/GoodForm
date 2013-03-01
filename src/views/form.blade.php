<form {{ $formAttributes }} novalidate>
@foreach($fields as $field)
      {{ $field->generate() }}
@endforeach
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="reset" class="btn">Cancel</button>
    </div>
</form>
