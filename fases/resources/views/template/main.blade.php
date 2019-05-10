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

	<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>

	<link rel="stylesheet" type="text/css" href="{{asset('gantt/lib/jquery-ui-1.8.4.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('gantt/jquery.ganttView.css')}}" />
</head>
<body class="hold-transition skin-yellow sidebar-mini">
	@include('template.partials.nav')
	@include('template.partials.menu-izquierda')
	<section>
	    <div class="content-wrapper">
	    @include('template.partials.errors')
			<div class=" box-body" style="">
			<!-- for loading add the next div -->
			<!-- <div class="loading" id="loading" style="position: absolute; width: 100%;height: 100%;background: white; z-index:1000000;"></div> -->
				<!-- <div class="box box-primary"> -->
				  @yield('content')
				<!-- </div> -->
		</div>
		</div>
	</section>
</body>

	<!-- GANT -->
<script src="{{asset('gantt/lib/jquery-1.4.2.js')}}"></script>
<script src="{{asset('gantt/lib/jquery-ui-1.8.4.js')}}"></script>
<script src="{{asset('gantt/lib/date.js')}}"></script>
<script src="{{asset('gantt/example/data.js')}}"></script>
<script src="{{asset('gantt/jquery.ganttView.js')}}"></script>

<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
@yield('js')
</html>