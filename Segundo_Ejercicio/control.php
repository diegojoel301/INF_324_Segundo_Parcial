<?php 
$usuario=$_GET["usuario"];
$password=$_GET["password"];

session_start();

include "conexion.inc.php";
$sql="select count(*) as contador, rol from academica2.usuario ";
$sql.="where nombre='$usuario' and password=md5('$password') group by nombre"; /* cambiar */
$resultado=mysqli_query($con, $sql);
$registros=mysqli_fetch_array($resultado);
$contador=$registros["contador"];


if ($contador>0)
{
	header("Location: bandejaE.php");
	$_SESSION["usuario"]=$usuario;
	$_SESSION["rol"]=$registros["rol"];
}
else
	header("Location: index.php");
?>
