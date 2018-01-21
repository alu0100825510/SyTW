<?php
// Queremos hacer en pdf la factura numero 1 de la tipica BBDD de facturacion
require('./fpdf/fpdf.php');
include "Conexion.php";

session_start();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// Imprimimos el logo a 300 ppp
$pdf->Image('./img/logo.jpeg',10,10,50);

$id = $_REQUEST["id"];

$Conexion = CrearConexion();
$SQL = " select * from Factura where ID=".$id;

$Resultado = mysqli_query($Conexion, $SQL);
$Tupla1 = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);


$pdf->SetTextColor(0,0,0);
$pdf->Text(30,50,"Direccion de envio: ".$Tupla1['Direccion']);
$pdf->Text(30,60,"Provincia: ".$Tupla1['Provincia']);
$pdf->Text(30,70, "CP: ".$Tupla1['CP']);
$pdf->Text(30,80, "Numero de Tarjeta: ".$Tupla1['NTarjeta']);

$SQL = " select * from Datos where ID=".$_SESSION["id_user"];

$Resultado = mysqli_query($Conexion, $SQL);
$Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC);

$pdf->Text(30,90, "Nombre: ".$Tupla['Nombre_Completo']);
$pdf->Text(30,100, "Telefono: ".$Tupla['Telefono']);


// 3º Una tabla con los articulos comprados

// La cabecera de la tabla (en azulito sobre fondo rojo)
$pdf->SetXY(40, 120);
$pdf->SetFillColor(255, 87, 51);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(80,10,"Articulo",1,0,"C",true);
$pdf->Cell(30,10,"Cant.",1,0,"C",true);
$pdf->Cell(20,10,"Precio/Ud",1,0,"C",true);
$pdf->Cell(30,10,"Subt.",1,1,"C",true);
$total=0;

// Los datos (en negro)
$pdf->SetTextColor(0,0,0);
$reg2=0;
$SQL = " select * from Compras where ID_Factura=".$id;

$Resultado = mysqli_query($Conexion, $SQL);
while ($Tupla = mysqli_fetch_array($Resultado ,MYSQLI_ASSOC)){
$pdf->SetX(40);
$pdf->Cell(80,10,$Tupla['ID_Articulo'],1,0,"L");
$pdf->Cell(30,10,$Tupla['Cantidad'],1,0,"C");
$pdf->Cell(20,10,$Tupla['Precio'],1,0,"C");
$pdf->Cell(30,10,$Tupla['Cantidad']*$Tupla['Precio'],1,1,"R");
}


$pdf->SetX(120);
$pdf->Cell(50,10,"Total:",1,0,"C");
$pdf->Cell(30,10,$Tupla1['Total'],1,1,"R");

// El documento enviado al navegador
//$pdf->Output("facturas/newpdf.pdf","F");
$pdf->Output();
?>
