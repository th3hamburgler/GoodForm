<form action="{{$form->action}}" class="{{$form->class}}" method="{{$form->method}}">
@foreach($fields as $field)
      {{{$field->generate()}}}
@endforeach
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="reset" class="btn">Cancel</button>
    </div>
</form>
