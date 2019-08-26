@if (count($errors)>0)
	<div class="alert alert-danger alert-dismissible">
	<ul>
		@foreach($errors->all() as $error)
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<li>{{$error}}</li>
		@endforeach
	</ul>
	</div>
@endif