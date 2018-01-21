<?php
include "Conexion.php";
session_start();
$Conexion = CrearConexion();


$id = $_REQUEST["id"];

if($_SESSION["Tipo"] == 'administrador'){

  $SQL = " delete from Articulos where ID_Articulo = '$id'";

  $Resultado = mysqli_query($Conexion, $SQL);

  $SQL = " delete from Fotos where ID_Articulo = '$id'";

  $Resultado = mysqli_query($Conexion, $SQL);
}

header('Location: ./');
