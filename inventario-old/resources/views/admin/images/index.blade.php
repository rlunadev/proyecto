@extends('admin.template.main')
@section('title','Imagenes')
@section('content')
<table class="table table-striped">
	
		
	<div class="row">
		@foreach($images as $image)
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<img src="{{asset('/images/articles/'.$image->name)}}" alt="" class="img-responsive">
				</div>
				<div class="panel-footer">
					{{$image->article->title}}
				</div>
			</div>
		</div>
		@endforeach
	</div>
</table>
<div class="text-center">
	{!!$images->render()!!}
</div>
@endsection