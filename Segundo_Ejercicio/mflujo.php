<?php
/*
http://localhost/segundoparcialworkflow/mflujo.php?flujo=F1&proceso=P1
*/
include "conexion.inc.php";
$flujo=$_GET["flujo"];
$proceso=$_GET["proceso"];
 
session_start();


$sql="SELECT * FROM flujo ";
$sql.="WHERE flujo='$flujo' and proceso='$proceso'";
$resultado=mysqli_query($con,$sql);
$registros=mysqli_fetch_array($resultado);
$pantalla=$registros["pantalla"];

?>
<html>
	<head>
		<title>Proceso de inscripción a materias</title>
	</head>
	<body>
		<form action="motor.php" method="GET"> 
		<?php include $pantalla.".php"; ?><br/>
		<input type="hidden" name="pantalla" value="<?php echo $pantalla; ?>">
		<input type="hidden" name="flujo" value="<?php echo $flujo; ?>">
		<input type="hidden" name="proceso" value="<?php echo $proceso; ?>">
		<input type="submit" value="Anterior" name="Anterior">
		<input type="submit" value="Siguiente" name="Siguiente">
		</form>
	</body>
</html>
