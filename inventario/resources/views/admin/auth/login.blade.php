<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title','Login')</title>
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
</head>
<body class="hold-transition login-page">
@include('admin.template.partials.errors')
<div class="login-box">

  <div class="login-logo">
    <a href="../../index2.html"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese sus datos para iniciar session</p>

        {!! Form::open(['route'=>'admin.auth.login','method'=>'POST'])!!}
      <div class="form-group has-feedback">
        {!! Form::label('email','Correo Electronico')!!}
  	    {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email'])!!}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {!! Form::label('password','Password')!!}
  	    {!! Form::password('password',['class'=>'form-control','placeholder'=>'*********'])!!}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
             
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        {!! Form::submit('Acceder',['class'=>'btn btn-primary btn-block btn-flat'])!!}
        </div>
        <!-- /.col -->
      </div>
    {!! Form::close()!!}
  </div>
  <!-- /.login-box-body -->
</div>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

</body>
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

@yield('js')

</html>