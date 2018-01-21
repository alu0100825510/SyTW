<?php

	include "Conexion.php";

	session_start();

	$Conexion = CrearConexion();


	$Direccion = $_REQUEST["Direccion"];
  $CP = $_REQUEST["CP"];
	$Provincia = $_REQUEST["Provincia"];
  $NTarjeta = $_REQUEST["cardNumber"];
$aleatorio=mt_rand(1,1000000);

$totalcesta = 0;
for($i=0; $i<count($_SESSION['cesta_id']); $i++){
  $totalcesta += $_SESSION['cesta_count'][$i];
}

for($i=0; $i<count($_SESSION['cesta_id']); $i++){

$SQL = " select * from Articulos Where ID_Articulo=".$_SESSION['cesta_id'][$i];

$Resultado = mysqli_query($Conexion, $SQL);

$Tupla = mysqli_fetch_assoc($Resultado);

  $total += $_SESSION["cesta_count"][$i]*$Tupla['Precio'];

  $SQL1 = "INSERT INTO Compras(ID_User, ID_Articulo, Cantidad, ID_Factura, Precio) VALUES (".$_SESSION["id_user"].", ".$_SESSION["cesta_id"][$i].", ".$_SESSION["cesta_count"][$i].", ".$aleatorio.", ".$Tupla['Precio'].")";

	$Resultado = Ejecutar($Conexion, $SQL1);
}


$SQL1 = "INSERT INTO Factura(ID, ID_User, Fecha, Total, Direccion, Provincia, CP, NTarjeta) VALUES (".$aleatorio.", ".$_SESSION["id_user"].", '".date("Y-m-d")."', ".$total.", '".$Direccion."', '".$Provincia."', ".$CP.", '".$NTarjeta."')";
$Resultado = Ejecutar($Conexion, $SQL1);

$_SESSION["cesta_id"] = array();
$_SESSION["cesta_count"] = array();


header('Location: ./miscompras.php');



 ?>
