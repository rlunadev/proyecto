<div id="errores"></div>
<script>
var message="";
function showError(message){
    $("#errores").after("<div class='alert alert-danger alert-dismissible'><ul><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><p id='msj_errores'> "+message+" </p> </ul></div>");
}
</script>