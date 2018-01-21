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

$id_articulo = $_REQUEST["id"];



 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ELEC ULL</title>
    <LINK REL=StyleSheet HREF="css/estilo2.css" TYPE="text/css" MEDIA=screen>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

        <?php
        $Conexion = CrearConexion();
        $SQL = " select * from Articulos NATURAL JOIN Fotos where ID_Articulo=".$id_articulo;

        $Resultado = mysqli_query($Conexion, $SQL);
        $Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);
        $SQL1 = " select count(*) as total from Articulos NATURAL JOIN Fotos where ID_Articulo=".$id_articulo;

        $Resultado1 = mysqli_query($Conexion, $SQL1);
        $Tupla2 = mysqli_fetch_assoc($Resultado1);
          ?>


        <div class="container-fluid principal">
            <div class="row">
              <div id="myCarousel" class="col-md-6 carousel slide" data-ride="carousel">

                  <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>

                  <!-- DIRECCION DE IMAGENES-->

                  <div class="carousel-inner">
                    <?php $aux=0; while ($Tupla3 = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
                      if ($aux==0){?>
                      <div class="item active ajusteimagen">
                      <?php } else{ ?>
                        <div class="item  ajusteimagen"> <?php } ?>
                          <img class="img" src='./uploads/<?php echo $Tupla3['Nombre_Foto']?>'>
                      </div>
                    <?php $aux++; } ?>
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
              <div class="col-md-6 plantilla2">
                <h4> <?php echo $Tupla['Nombre_Articulo']?> </h4>
                <p> Precio: <?php echo $Tupla['Precio']?>€ </p>
                <p> Descripción: <?php echo $Tupla['Descripcion']?></p>

                <form name="formulario" method="get" action="./cesta2.php">
                  <p> Cantidad:
                  <input type="button" value="-" onClick="add(-1);">
                  <input type="text" id="cantidad"size="2" name="cantidad" value="1">
                  <input type="button" value="+" onClick="add(1);">

                  <input type="hidden" name="id" value='<?php echo $Tupla['ID_Articulo']?>'>
                  <input type="hidden" name="accion" value="aniadir" >

                  </p>
                <button  class="btn btn glyphicon btn-warning glyphicon-shopping-cart"> Añadir al carrito</button>
                </form>
                <HR>

                  <?php if($_SESSION["username"] != ""){ ?>
                    <div class="row">
                    <div class="col-md-12 opinion">
                        Opinión:
                      <form method="post" action="./opinar.php">

                        <br>
                        <input type="text" name="ventajas" size="45%" placeholder="Ventajas" required>
                        <br><br>

                        <input type="text" name="desventajas" size="45%" placeholder="Desventajas" required>
                        <input type="hidden" name="ID_Articulo" value='<?php echo $Tupla['ID_Articulo']?>'>
                        <br><br>
                        Valoración:
                        <p class="clasificacion">
                          <input id="radio1" type="radio" name="estrellas" value="5" ><!--
                        --><label for="radio1">★</label><!--
                      --><input id="radio2" type="radio" name="estrellas" value="4" ><!--
                        --><label for="radio2">★</label><!--
                        --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                        --><label for="radio3">★</label><!--
                        --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                        --><label for="radio4">★</label><!--
                        --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                        --><label for="radio5">★</label>
                      </p>

                        Opinión:
                        <br>
                        <textarea type="text" rows="4" cols="30" name="opinion"  placeholder="Escriba aqui"></textarea>
                         <br>
                        <input type="submit" class="btn btn-warning" value="Enviar">
                      </form>

                    </div>
                  </div>

                <?php }
                else{
                  echo "no se puede comentar sin estar logueado";
                }
                ?>

              </div>

            </div>

          </div>

          <div class="container-fluid comentariofijo">
          <div class="opiniontitle   col-md-12">
            <h3> Opiniones </h3>
          </div>

          <?php
          $Conexion = CrearConexion();
          $SQL = " select * from Comentarios  NATURAL JOIN Usuarios where ID_Articulo=".$Tupla['ID_Articulo'];

          $Resultado = mysqli_query($Conexion, $SQL);
          while ($Tupla1 = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
             ?>

          <div class="col-md-3">
             <br>
             <span id="este"class="glyphicon glyphicon-user gi-5x"></span>
             <br>
             <?php echo $Tupla1['Username']?>
             <br>
          <?php for($i=0; $i<$Tupla1['Valoracion']; $i++){?>
             <span class="glyphicon glyphicon-star">
             </span>
           <?php } ?>
          </div>
          <div class="col-md-9">
            <br> <br>
            <b>Ventajas:</b> <?php echo $Tupla1['Ventaja']?>
            <br> <br>
            <b>Desventajas:</b> <?php echo $Tupla1['Desventaja']?>
            <br> <br>
            <b>Opinión:</b>
            <br>
            <?php echo $Tupla1['Opinion']?>
          </div>

        <?php } ?>



          </div>








        <!----------- Footer ------------>
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
function add(delta) {
 valor = eval(formulario.cantidad.value);
 formulario.cantidad.value = eval(valor+delta);
}
</script>
</html>
