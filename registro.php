<?php

	include "Conexion.php";

	session_start();

	$Conexion = CrearConexion();

	$usuario = $_REQUEST["Username"];
	$email = $_REQUEST["Email"];
	$password = $_REQUEST["Password"];



	$SQL = "INSERT INTO Usuarios(Username, Password, Email, Tipo) VALUES ('$usuario', '$password', '$email', 'cliente')";
	$Resultado = Ejecutar($Conexion, $SQL);

	header('Location: ./');

?>
