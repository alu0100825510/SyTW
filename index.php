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
                  <li><a data-toggle="modal" href="./miscompras.php"><span class="glyphicon glyphicon-header"></span></a></li>
                  <li><a data-toggle="modal" href="./logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>
                  <?php
                }
                else{
                  ?>
                  <li><a data-toggle="modal" href="./subirarticulo.php"><span class="glyphicon glyphicon-plus"></span></a></li>
                  <li><a data-toggle="modal" href="./perfil.php"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION["username"] ?></span></a></li>
                  <li><a data-toggle="modal" href="./cesta.php"><span class="glyphicon glyphicon-shopping-cart">(<?php echo $totalcesta ?>)</span></a></li>
                  <li><a data-toggle="modal" href="./miscompras.php"><span class="glyphicon glyphicon-header"></span></a></li>
                  <li><a data-toggle="modal" href="./logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>

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



        <!-- CARRUSEL DE IMAGENES-->

        <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- DIRECCION DE IMAGENES-->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="./img/F.png" alt="Los Angeles">
                </div>

                <div class="item">
                    <img src="./img/B.png" alt="Chicago">
                </div>

                <div class="item">
                    <img src="./img/D.png" alt="New York">
                </div>
            </div>

            <!-- Controles de izquierda y derecha -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
            </div>

            <!--Lista de Artículos -->
            <div class="row">

              <?php
              $Conexion = CrearConexion();
              if($tipo == "todo"){
                if($filtro ==""){
                  $SQL = " select * from Articulos NATURAL JOIN Fotos where Tipo_Foto='portada' ";
                }else{
                    $SQL = " select * from Articulos NATURAL JOIN Fotos where Tipo_Foto='portada' AND Nombre_Articulo LIKE '%".$filtro."%';";
                }
              }
              else{
                if($filtro ==""){
                  $SQL = " select * from Articulos  NATURAL JOIN Fotos where Tipo_Foto='portada' AND Tipo='".$tipo."'";
                }else{
                  $SQL = " select * from Articulos  NATURAL JOIN Fotos where Tipo_Foto='portada' AND Tipo='".$tipo."' AND Nombre_Articulo LIKE '%".$filtro."%';";
                }
              }
              $Resultado = mysqli_query($Conexion, $SQL);
              while ($Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
                 ?>


          <a class="enlace_producto"  href='./articulo.php?id=<?php echo $Tupla['ID_Articulo']?>'>
                <div class="col-md-3 articulo">

                    <div class="articulo_inside ">

                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">

                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                                <img class="img" src='./uploads/<?php echo $Tupla['Nombre_Foto']?>'>

                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">

                            </div>

                        </div>
                        <div class="des_art row">
                            <p class="text-center"><?php echo $Tupla['Nombre_Articulo']?></p>
                        </div>
                        <div class="nom_art row">
                            <p class="text-center"><?php echo $Tupla['Precio']?></p>
                        </div>
                        <div class="pre_art row">

                        </div>
                    </div>
                    <?php if($_SESSION["Tipo"] == 'administrador'){ ?>
                    <p class="text-center"><a href='eliminar.php?id=<?php echo $Tupla['ID_Articulo']?>'><button type="button" class="btn btn-danger">Eliminar</button></a></p>
                    <?php } ?>
                </div>
              </a>


              <?php } ?>

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
