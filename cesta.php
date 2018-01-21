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

                 <!-- Si esta registado  -->
                 <?php
                 if($_SESSION["username"] != ""){
                   ?>
                  <li><a data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-user"> <?php echo $_SESSION["username"] ?></span></a></li>
                  <li><a data-toggle="modal" href="#"><span class="glyphicon glyphicon-shopping-cart">(<?php echo $totalcesta ?>)</span></a></li>
                  <li><a data-toggle="modal" href="/sytw/html/logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>
                  <?php
                 }else{
                   ?>
                  <li><a data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-user"></span></a></li>
                  <li><a data-toggle="modal" href="#"><span class="glyphicon glyphicon-shopping-cart">(<?php echo $totalcesta ?>)</span></a></li>
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





        <legend>Cesta de la compra</legend>

        <div class="cesta">

                <div class="row cesta_inside">
                    <div class="col-6 col-md-6">ARTÍCULO</div>
                    <div class="col-2 col-md-2">PRECIO</div>
                    <div class="col-2 col-md-2">UNIDADES</div>
                    <div class="col-2 col-md-2">TOTAL</div>
                    <hr>
                </div>

                <?php
                $total=0;
                $Conexion = CrearConexion();
                for($i=0; $i<$totalcesta; $i++){
                  echo $_SESSION["cesta_id"][$i];
                $SQL = " select * from Articulos NATURAL JOIN Fotos where Tipo_Foto='portada' AND ID_Articulo=".$_SESSION['cesta_id'][$i];

                $Resultado = mysqli_query($Conexion, $SQL);
                while ($Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
                  $total += $_SESSION["cesta_count"][$i]*$Tupla['Precio'];
                ?>

                <div class="articulo_inside col-md-12">
                    <div class="col-6 col-md-6">
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <img class="imagen_cesta" src='./uploads/<?php echo $Tupla['Nombre_Foto']?>'>
                            </div>
                            <div class="col-5 col-md-5">
                                <div class="flotante"></div>
                                <?php echo $Tupla['Descripcion']?>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-2">
                        <div class="flotante"></div>
                        <?php echo $Tupla['Precio']?></div>
                    <div class=" col-md-2">
                        <div class="flotante"></div>
                        <?php echo $_SESSION["cesta_count"][$i]?>
                    </div>
                    <div class=" col-md-2">
                        <div class="flotante"></div>
                        <?php  echo $_SESSION["cesta_count"][$i]*$Tupla['Precio'] ?><a href='./cesta2.php?accion=eliminar&id=<?php echo $Tupla['ID_Articulo']?>&cantidad=<?php echo $_SESSION["cesta_count"][$i]?>'><button type="button" class="close" data-dismiss="modal">&times;</button></a>
                    </div>
                </div>

              <?php }} ?>

              <?php if($_SESSION["username"] != ""){ ?>
                  <p class="text-right"><strong>Total: </strong> <?php echo $total; ?>€ <a href="./procesodecompra.php"><button type="button" class="btn btn-primary ">Siguiente </button></a></p>

                <?php }
                else{
                  ?>
                  <p class="text-right"><strong>Total: </strong> <?php echo $total; ?>€ </p>
                  <?php
                  echo "no se puede comprar sin estar logueado";
                }
                ?>






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
