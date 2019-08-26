<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title','Default')</title>
	<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
	
	<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
	<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	@include('admin.template.partials.nav')
	@include('admin.template.partials.menu-izquierda')
	<section>
	    <div class="content-wrapper">
	    @include('admin.template.partials.errors')
			<div class=" box-body">
				<div class="box box-primary">
				  @yield('content')
				</div>
		    </div>
		</div>
	</section>
	<footer>
		@include('admin.template.partials.footer')
	</footer>

</body>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
@yield('js')
</html>