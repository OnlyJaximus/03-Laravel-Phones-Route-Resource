
@if ($message = Session::get('create'))
<div class="alert alert-success">
    <strong>{{ $message }}</strong>
  </div>
@endif

@if ($message = Session::get('delete'))
<div class="alert alert-danger">
    <strong>Success!</strong> The phone has been removed successfully!
  </div>
@endif

@if ($message = Session::get('update'))
<div class="alert alert-warning">
    <strong>Success!</strong> The phone has been successfully updated!
  </div>
@endif

