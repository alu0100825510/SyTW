var login = function(){

  var form=$("#formlogin");

  $.ajax({
        type:"POST",
        url:form.attr("action"),
        data:form.serialize(),
        success: function(response){
          var logueado = JSON.parse(response);
            if(logueado.login == "logueado"){
              window.location.href = "index.php";
            }
            else{
              $("#infologin").text("Usuario y/o contraseña incorrectos");
            }
        }
    });
}
