<?php
include "Conexion.php";
session_start();
$Conexion = CrearConexion();


$ventajas = $_REQUEST["ventajas"];
$desventajas = $_REQUEST["desventajas"];
$opinion = $_REQUEST["opinion"];
$estrellas = $_REQUEST["estrellas"];
$ID_Articulo = $_REQUEST["ID_Articulo"];
$id = $_SESSION['id_user'];

$SQL = "INSERT INTO Comentarios(ID_Articulo, ID, Ventaja, Desventaja, Opinion, Valoracion) VALUES ($ID_Articulo, $id, '$ventajas', '$desventajas', '$opinion', $estrellas)";
$Resultado = Ejecutar($Conexion, $SQL);

header('Location: ./articulo.php?id='.$ID_Articulo);
