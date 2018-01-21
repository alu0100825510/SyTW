<?php
include "Conexion.php";
session_start();
$Conexion = CrearConexion();


$email = $_REQUEST["Email"];
$password = $_REQUEST["Password"];

$datos = new stdClass();

$SQL = " select * from Usuarios where Email = '$email' and Password = '$password'";

$Resultado = mysqli_query($Conexion, $SQL);
$Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);
if ($Tupla["ID"] != "")
{
  $_SESSION["id_user"] = $Tupla["ID"];
  $_SESSION["username"] = $Tupla["Username"];
  $_SESSION["email"] = $Tupla["Email"];
  $_SESSION["Tipo"] = $Tupla["Tipo"];
  $datos->login = "logueado";
}
else{
  $datos->login = "nologueado";
}

//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos, JSON_FORCE_OBJECT);

?>
