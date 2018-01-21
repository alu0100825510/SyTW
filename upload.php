<?php
include "Conexion.php";
session_start();

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}


$Conexion = CrearConexion();

$Nombre_Articulo = $_REQUEST["Nombre_Articulo"];
$Precio = $_REQUEST["precio"];
$Descripcion = $_REQUEST["descripcion"];
$Tipo = $_REQUEST["tipo"];
$aleatorio=mt_rand(1,1000000);

$SQL = "INSERT INTO Articulos(ID_Articulo, Nombre_Articulo, Tipo, Descripcion, Precio) VALUES (".$aleatorio.",'".$Nombre_Articulo."', '".$Tipo."', '".$Descripcion."', ".$Precio.")";
$Resultado = mysqli_query($Conexion, $SQL);




$total = count($_FILES['ficheros']['name']);

$path = "./uploads/";

move_uploaded_file($_FILES["fotoportada"]["tmp_name"], normaliza($path.$aleatorio.$_FILES["fotoportada"]["name"]));
$SQL = "INSERT INTO Fotos(Nombre_Foto, Tipo_Foto, ID_Articulo) VALUES ('".normaliza($aleatorio.$_FILES['fotoportada']['name'])."', 'portada', ".$aleatorio.")";
$Resultado = mysqli_query($Conexion, $SQL);

  for($i=0; $i<$total; $i++) {


    move_uploaded_file($_FILES["ficheros"]["tmp_name"][$i], $path.$aleatorio.normaliza($_FILES["ficheros"]["name"][$i]));
    $SQL = "INSERT INTO Fotos(Nombre_Foto, Tipo_Foto, ID_Articulo) VALUES ('".normaliza($aleatorio.$_FILES['ficheros']['name'][$i])."', 'descripcion', ".$aleatorio.")";
    $Resultado = mysqli_query($Conexion, $SQL);

  }

header('Location: ./');



 ?>
