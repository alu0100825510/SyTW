<?php

	include "Conexion.php";

	session_start();

	$Conexion = CrearConexion();

	$Nombre_Completo = $_REQUEST["Nombre_Completo"];
	$Telefono = $_REQUEST["Telefono"];
	$Direccion = $_REQUEST["Direccion"];
  $CP = $_REQUEST["CP"];
	$Provincia = $_REQUEST["Provincia"];



  $SQL = " select count(*) as total from Datos where ID=".$_SESSION["id_user"];

  $Resultado = mysqli_query($Conexion, $SQL);
  $Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);

  if($Tupla['total'] == 0){
    $SQL1 = "INSERT INTO Datos(ID, Nombre_Completo, Direccion, Provincia, CP, Telefono) VALUES (".$_SESSION["id_user"].",'".$Nombre_Completo."', '".$Direccion."', '".$Provincia."', ".$CP.", ".$Telefono.")";

  }
  else{
    $SQL1 = "UPDATE Datos SET Nombre_Completo='".$Nombre_Completo."', Direccion='".$Direccion."', Provincia='".$Provincia."', CP=".$CP.", Telefono=".$Telefono." WHERE ID=".$_SESSION["id_user"];
  }


  $Resultado1 = mysqli_query($Conexion, $SQL1);

	header('Location: ./');

?>
