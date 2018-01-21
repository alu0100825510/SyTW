<?php
include "Conexion.php";
session_start();

if(isset($_SESSION["cesta_id"])){

}
else{
  $_SESSION["cesta_id"] = array();
  $_SESSION["cesta_count"] = array();
}

$totalcesta = 0;
for($i=0; $i<count($_SESSION['cesta_id']); $i++){
  $totalcesta += $_SESSION['cesta_count'][$i];
}

$tipo = $_REQUEST['tipo'];
if($tipo == ""){
  $tipo = "todo";
}

$filtro = $_REQUEST['busqueda_articulo'];



 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ELEC ULL</title>
    <LINK REL=StyleSheet HREF="css/estilo.css" TYPE="text/css" MEDIA=screen>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">
        <!-- Bootstrap Core CSS -->
    <!--     <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="./img/favicon.png" sizes="32x32" />
        <!-- Custom CSS -->
        <style>

        .othertop{margin-top:10px;}
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

<body>
<div id="main">
    <div class="container">

      <!-- navbar-->
      <nav class="navbar navbar-inverse">
          <div class="container-fluid">

            <div class="btn-group" role="group" aria-label="Basic example">
                             <div id="mySidenav" class="sidenav">
                             <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                             <?php
                             $Conexion = CrearConexion();
                             $SQL = " select * from Categorias";
                             $Resultado = mysqli_query($Conexion, $SQL);
                             while ($Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
                                ?>
                             <a href='./?tipo=<?php echo $Tupla['Categoria']?>'><?php echo $Tupla['Categoria']?></a>
                              <?php } ?>
                             </div>
                             <div class="navbar-header">
                               <a class="navbar-brand" onmouseover="openNav()">Productos</button>
                             </div>
                         </div>

              <div class="navbar-header">
                  <a class="navbar-brand" href="./">ELEC ULL</a>
              </div>

              <form class="navbar-form navbar-left" action="./" method="get">
                  <div class="form-group">
                      <input type="text" class="form-control" name="busqueda_articulo" placeholder="Nueva búsqueda">
                  </div>
                  <input type="hidden" name="tipo" value='<?php echo $tipo?>'>
                  <button type="submit" class="btn btn-default">Buscar</button>
              </form>
              <ul class="nav navbar-nav navbar-right">

                <!-- SI NO ESTA REGISTRADo
                  <li><a data-toggle="modal" href="#myModal"><span class="	glyphicon glyphicon-log-in"></span> Registro</a></li>
                  <li><a data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-shopping-cart"></span>Cesta</a></li>
               -->

              <!-- Si es el dueño de la empresa
              <li><a data-toggle="modal" href="/sytw/html/subirarticulo.php"><span class="glyphicon glyphicon-plus"></span></a></li>
              <li><a data-toggle="modal" href="/sytw/html/logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>


              -->
               <?php
               if($_SESSION["username"] != ""){
                 if($_SESSION["Tipo"] != "administrador"){
                 ?>
                <li><a data-toggle="modal" href="./perfil.php"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION["username"] ?></span></a></li>
                <li><a data-toggle="modal" href="./cesta.php"><span class="glyphicon glyphicon-shopping-cart">(<?php echo $totalcesta ?>)</span></a></li>
                <li><a data-toggle="modal" href="/sytw/html/miscompras.php"><span class="glyphicon glyphicon-header"></span></a></li>
                <li><a data-toggle="modal" href="/sytw/html/logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>
                <?php
              }
              else{
                ?>
                <li><a data-toggle="modal" href="/sytw/html/subirarticulo.php"><span class="glyphicon glyphicon-plus"></span></a></li>
                <li><a data-toggle="modal" href="./perfil.php"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION["username"] ?></span></a></li>
                <li><a data-toggle="modal" href="./cesta.php"><span class="glyphicon glyphicon-shopping-cart">(<?php echo $totalcesta ?>)</span></a></li>
                <li><a data-toggle="modal" href="/sytw/html/miscompras.php"><span class="glyphicon glyphicon-header"></span></a></li>
                <li><a data-toggle="modal" href="/sytw/html/logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>

                <?php
              }
               }else{
                 ?>
                <li><a data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-user"></span></a></li>
                <li><a data-toggle="modal" href="./cesta.php"><span class="glyphicon glyphicon-shopping-cart">(<?php echo $totalcesta ?>)</span></a></li>
              <?php } ?>
              </ul>
          </div>
      </nav>


<!-- Modal content-->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <div class="row">


                  <div class="col-md-6">
                    <h4 class="">Iniciar sesión </h4>
                  </div>
                  <div class="col-md-4">
                    <h4 class="modal-title">Registrarse</h4>
                  </div>
              </div>
              </div>
              <div class="modal-body">

                <div class="row">
                <div class="col-md-6">
                <fieldset>
                  <form id="formlogin" action="autenticate.php"  onSubmit="login(); return false;" method="post">

                  <div class="form-group" class="center-block">
                     <label for="exampleInputEmail1">Email</label>
                     <input type="email" class="form-control" size="30" name="Email" id="Email" placeholder="Introduzca su email">
                  </div>

                   <div class="form-group" class="col-md-6">
                     <label for="exampleInputPassword1">Contraseña </label>
                     <input type="password" id="Password" class="form-control" name="Password" placeholder="Contraseña">
                   </div>
                   <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                   <h2 id="infologin"> </h2>
                 </form>
                </fieldset>
              </div>

              <div class="col-md-6">
              <fieldset>
                <form action="registro.php" method="post">

                <div class="form-group" class="center-block">
                   <label for="exampleInputEmail1">Email</label>
                   <input type="email" class="form-control" size="30" name="Email" placeholder="Introduzca Email">
                </div>
                <div class="form-group" class="col-md-6">
                  <label for="exampleInputname1">Nombre de usuario </label>
                  <input type="text" class="form-control" name="Username" placeholder="Contraseña">
                </div>

                 <div class="form-group" class="col-md-6">
                   <label for="exampleInputPassword1">Contraseña </label>
                   <input type="password"  class="form-control" name="Password"  placeholder="Contraseña">
                 </div>
                 <div class="form-group" class="col-md-6">
                   <label for="exampleInputPassword1">Repetir contraseña </label>
                   <input type="password"  class="form-control" name="Password" placeholder="Repetir contraseña">
                 </div>
                 <button type="submit" class="btn btn-primary">Registrarse</button>
               </form>
              </fieldset>
            </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
        </div>

  <div class="container">
<div class="row">
<div class="col-md-10 ">
<form class="form-horizontal" method="post" action="./upload.php" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Introducir articulo</legend>

<!-- Text input-->




<div class="form-group">
  <label class="col-md-4 control-label" for="Name (Full name)">Nombre del articulo</label>
  <div class="col-md-4">
 <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
       </div>
       <input id="Name (Full name)" name="Nombre_Articulo" type="text" placeholder="Nombre del articulo" class="form-control input-md">
      </div>


  </div>


</div>



<div class="form-group">
<label class="col-md-4 control-label" for="Name (Full name)">Tipo del articulo</label>
<select name="tipo">
  <?php
  $Conexion = CrearConexion();
  $SQL = " select * from Categorias";

  $Resultado = mysqli_query($Conexion, $SQL);
  while ($Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
     ?>
  <option value='<?php echo $Tupla['Categoria']?>'><?php echo $Tupla['Categoria']?></option>
<?php } ?>

</select>
</div>

<!-- File Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Upload photo"><i class="fa fa-picture-o" aria-hidden="true"></i> Foto de portada</label>
  <div class="col-md-4">
    <input id="Upload photo" name="fotoportada" class="input-file" type="file">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Upload photo"><i class="fa fa-picture-o" aria-hidden="true"></i> Fotos de descripcion</label>
  <div class="col-md-4">
    <input id="Upload photo"  class="input-file" name="ficheros[]" multiple="multiple" accept="image/*" type="file" />
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" ><i class="fa fa-eur" aria-hidden="true"></i> Precio del articulo</label>
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
      <i class="fa fa-eur" aria-hidden="true"></i></i>

       </div>
  <input  name="precio" type="double" placeholder="€" class="form-control input-md">

      </div>

  </div>
</div>


<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Overview (max 200 words)">Descripción del articulo</label>
  <div class="col-md-4">
    <textarea class="form-control" rows="10"  id="Overview (max 200 words)" name="descripcion"></textarea>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" ></label>
  <div class="col-md-4">
  <button class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Añadir nuevo articulo</button>
  </div>
</div>

</fieldset>
</form>
</div>
<div class="col-md-2 hidden-xs">
<img src="https://icon-icons.com/icons2/742/PNG/512/shopping-cart-3_icon-icons.com_63429.png" class="img-responsive img-thumbnail ">
  </div>


</div>
   </div>
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

<footer class="footer-bs">
                <div class="row">
                    <div class="col-md-3 footer-brand animated fadeInLeft">
                        <h2>ELEC ULL</h2>
                        <p>ELEC ULL nace a finales de 2017 tras la idea de varios estudiantes de la ULL de crear una página web orientada al comercio electrónico.</p>
                        <p>© Since 2017, All rights reserved</p>
                    </div>
                    <div class="col-md-4 footer-nav animated fadeInUp">

                        <div class="col-md-6">
                            <ul class="pages">
                                <li><a href="#">Métodos de pago</a></li>
                                <li><a href="#">Información de envíos</a></li>
                                <li><a href="#">Garantías y reparaciones</a></li>
                                <li><a href="#">Devoluciones</a></li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list">
                                <li><a href="#">Acerca de nosotros</a></li>
                                <li><a href="#">Contacto</a></li>
                                <li><a href="#">Terminos y condiciones</a></li>
                                <li><a href="#">Política de privacidad</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 footer-social animated fadeInDown">
                        <h4>¡Síguenos!</h4>
                        <ul>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">RSS</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 footer-ns animated fadeInRight">
                        <h4>Ofertas y novedades</h4>
                        <p></p>
                        <p>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tu email">
                                <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </p>
                    </div>
                </div>
            </footer>


</div>
</div>

</body>

<script>
function openNav() {
document.getElementById("mySidenav").style.width = "250px";
document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
document.getElementById("mySidenav").style.width = "0";
document.getElementById("main").style.marginLeft = "0";
}
</script>
</html>
