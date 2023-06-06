<?php
	session_start();
	$flujo=$_GET['flujo'];
	$proceso=$_GET['proceso'];
	$usuario=$_SESSION['usuario'];
	$rol=$_SESSION["rol"];
	$sql="SELECT max(numerotramite)+1 tramite FROM flujousuario";
	include "conexion.inc.php";
	$resultado=mysqli_query($con, $sql);
	$registros=mysqli_fetch_array($resultado);
	$tramite=$registros["tramite"];

	$today=getdate();
	//print_r($today);
	$fecha_ini= $today["year"]."-".$today["mon"]."-".$today["mday"]." ".$today["hours"].":".$today["minutes"];
	$fecha_fin="NULL";

	$sql="INSERT INTO flujousuario values('".$tramite."','".$flujo."','$proceso','".$fecha_ini."' ";
	$sql.=",".$fecha_fin.",'".$usuario."')";
	$resultado=mysqli_query($con, $sql);
	header("Location: bandejaE.php");

?>