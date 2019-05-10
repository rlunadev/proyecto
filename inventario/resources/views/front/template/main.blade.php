<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title','Default')</title>
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('chosen/chosen.css')}}">
	<link rel="stylesheet" href="{{asset('trumbowyg/ui/trumbowyg.css')}}">
	
</head>
<body>
	@include('front.template.partials.nav')
	<section>
	@include('front.template.partials.errors')
		
			@yield('content')
		
	</section>
	<footer>
		@include('front.template.partials.footer')
	</footer>
</body>
<script src="{{asset('bootstrap/js/jquery-2.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('chosen/chosen.jquery.js')}}"></script>
<script src="{{asset('trumbowyg/trumbowyg.js')}}"></script>
@yield('js')

</html>