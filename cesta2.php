<?php
session_start();


$accion = $_REQUEST["accion"];



if($accion == "aniadir"){
  $cantidad = $_REQUEST["cantidad"];
  $id = $_REQUEST["id"];


    array_push ($_SESSION["cesta_id"], $id);
    array_push ($_SESSION["cesta_count"], $cantidad);

  header('Location: ./articulo.php?id='.$id);

}

if($accion == "eliminar"){
  $cantidad = $_REQUEST["cantidad"];
  $id = $_REQUEST["id"];
  $a = 0;
  $r = array();
  $r2 = array();
  for($i=0; $i<count($_SESSION['cesta_id']); $i++){

    if(($_SESSION['cesta_id'][$i] == $id)and($_SESSION['cesta_count'][$i] == $cantidad)){

    }
    else{
      array_push ($r, $_SESSION['cesta_id'][$i]);
      array_push ($r2, $_SESSION['cesta_count'][$i]);
    }
  }

  $_SESSION["cesta_id"]=$r;
  $_SESSION["cesta_count"]=$r2;



  header('Location: ./cesta.php');

}

if($accion == "limpiar"){
  $_SESSION["cesta_id"] = array();
  $_SESSION["cesta_count"] = array();
}


 ?>
