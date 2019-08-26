<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title','Default')</title>
	<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
	

  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
	
</head>
<body class="hold-transition skin-red sidebar-mini">
	@include('template.partials.nav')
	@include('template.partials.menu-izquierda')
	<section>
	    <div class="content-wrapper">
	    @include('template.partials.errors')
			<div class=" box-body">
				  @yield('content')
		</div>
		</div>
	</section>
</body>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

@yield('js')
</html>