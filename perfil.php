
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
    <LINK REL=StyleSheet HREF="css/estilo3.css" TYPE="text/css" MEDIA=screen>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg=="
        crossorigin="anonymous">
    <!-- Bootstrap Core CSS -->
    <!--     <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw=="
        crossorigin="anonymous">


    <script src="main.js"></script>
    <link rel="icon" type="image/png" href="./img/favicon.png" sizes="32x32" />
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

                 <!-- Si esta registado  -->
                 <?php
                 if($_SESSION["username"] != ""){
                   ?>
                  <li><a data-toggle="modal" href="./perfil.php"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION["username"] ?></span></a></li>
                  <li><a data-toggle="modal" href="./cesta.php"><span class="glyphicon glyphicon-shopping-cart">(<?php echo $totalcesta ?>)</span></a></li>
                  <li><a data-toggle="modal" href="/sytw/html/logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>
                  <?php
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




                <form class="form-horizontal" method="post" action="actualizardatos.php">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Perfil de usuario</legend>

                        <!-- Text input-->

                        <?php
                        $Conexion = CrearConexion();
                        $SQL = " select * from Datos NATURAL JOIN Usuarios where ID=".$_SESSION["id_user"];

                        $Resultado= mysqli_query($Conexion, $SQL);
                        $Tupla = mysqli_fetch_assoc($Resultado);
                          ?>



                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Name (Full name)">Nombre completo</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user">
        </i>
                                    </div>
                                    <input id="Name (Full name)" name="Nombre_Completo" type="text" placeholder="Intriduzca su nombre completo" value='<?php echo $Tupla['Nombre_Completo']?>' class="form-control input-md">
                                </div>


                            </div>


                        </div>





                        <div class="form-group">
                            <label class="col-md-4 control-label col-xs-12" for="Permanent Address">Dirección</label>
                            <div class="col-md-2  col-xs-4">
                                <input id="Permanent Address" name="Direccion" type="text" value='<?php echo $Tupla['Direccion']?>' placeholder="Dirección" class="form-control input-md ">
                            </div>

                            <div class="col-md-2 col-xs-4">

                                <input id="Permanent Address" name="Provincia" value='<?php echo $Tupla['Provincia']?>' type="text" placeholder="Provincia" class="form-control input-md ">
                            </div>


                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Permanent Address"></label>
                            <div class="col-md-2  col-xs-4">
                                <input id="Permanent Address" name="CP" value='<?php echo $Tupla['CP']?>' type="text" placeholder="CP" class="form-control input-md ">

                            </div>




                        </div>



                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Phone number ">Teléfono de contacto. </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>

                                    </div>
                                    <input id="Phone number " name="Telefono" value='<?php echo $Tupla['Telefono']?>' type="text" placeholder="Número de teléfono" class="form-control input-md">

                                </div>


                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                              <button><span class="glyphicon glyphicon-thumbs-up"></span> Actualizar</button>

                            </div>
                        </div>

                    </fieldset>
                </form>

<div class="col-md-12">
                <div class="form-group col-md-12">
                    <label class="col-md-4 control-label" for="Name (Full name)">Username</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user">
  </i>
                            </div>
                            <span><?php echo $Tupla['Username']?></span>
                        </div>
                    </div>


                </div>

                <div class="form-group col-md-12">
                    <label class="col-md-4 control-label" for="Name (Full name)">Correo Electrónico</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user">
  </i>
                            </div>
                            <span><?php echo $Tupla['Email']?></span>
                        </div>


                    </div>


                </div>


            </div>
          </div>

        </div>
    </div>


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
