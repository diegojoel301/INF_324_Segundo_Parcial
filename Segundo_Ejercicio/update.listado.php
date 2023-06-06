<?php
$ci=$_GET["ci"];
$matricula=$_GET["matricula"];

session_start();

$sql="update academico.alumno set ci='$ci', matricula='$matricula' ";

$sql.="where nombre='".$_SESSION["usuario"]."'"; 

$resultado=mysqli_query($con,$sql);
?>