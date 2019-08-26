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
<body class="hold-transition login-page" >
<div id="errores"></div>
<div class="login-box">

  <div class="login-logo">
    <a href="../../index2.html"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese sus datos para iniciar session</p>
    <div class="form-group has-feedback">
        <label for="name"></label>
        <input type="text" id="name" placeholder="ingrese su nombre" class="form-control">        
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="email"></label>
        <input type="text" id="email" placeholder="ingrese su email" class="form-control">        
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="password"></label>
        <input type="password" id="password" placeholder="*****" class="form-control">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="password_confirmation"></label>
        <input type="password" id="password_confirmation" placeholder="*****" class="form-control">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <button type="button" class="btn btn-primary btn-block btn-flat" id="enviar" style="margin-bottom:20px;"> Registrarse </button>
      </div>
      <a href="http://localhost:9000/token_service/public/login">Ya tienes una cuenta?</a>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
</body>
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
@yield('js')
</html>
<script>
 $('#email').focus();
 $("#email").keypress(function(e) {
    if (e.which === 13) {
        $('#password').focus();
    }
});
$("#password").keypress(function(e) {
    if (e.which === 13) {
        $('#enviar').focus();
    }
});
$("#errores").hide();
$("#enviar").click(function() {
    
    $.ajax({
        type: 'POST',
        url:{!!json_encode(url('/'))!!}+"/api/register",
        data: { 
            name:$("#name").val(),
            email:$("#email").val(),
            password:$("#password").val(),
            password_confirmation:$("#password_confirmation").val()
        },
        success: function(result) {
            console.log(result);
            if(result.success){
                localStorage.setItem('token',result.data.token);
                window.location.href =  {!!json_encode(url('/'))!!}+ '/users?token='+result.data.token;
            }
            else
                message=result.error;
                showError(message)
            
        },
        error: function(e) {
            message=e.responseJSON.error;
            showError(message)
        }
    });
   
});
function showError(message){
    $("#errores").after("<div class='alert alert-danger alert-dismissible'><ul><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><p id='msj_errores'> "+message+" </p> </ul></div>");
}
</script>
</html>