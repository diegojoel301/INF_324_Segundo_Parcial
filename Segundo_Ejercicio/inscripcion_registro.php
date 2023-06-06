<!---<?php echo "p8"; ?>--->
<?php
	$tramite = $_SESSION["codtramite"]; 
	include "conexion.inc.php";
	$sql = "SELECT * from workflowsegundoparcial.estudiantekardex where codTramite='$tramite'";
	$resultado = mysqli_query($con, $sql);
	//hallamos id de usuario
	$sql2= "SELECT id from academica2.usuario b INNER JOIN 
			(SELECT usuario from workflowsegundoparcial.estudiantekardex where codTramite='$tramite' LIMIT 1) a ON a.usuario=b.nombre";
	$resultado2 = mysqli_query($con, $sql2);
	$registro2=mysqli_fetch_array($resultado2);
	$id_alunmno=$registro2["id"];
	//inscribimos
	while($registros = mysqli_fetch_array($resultado)){
		$sql3 = "INSERT INTO academica2.inscripcion VALUES ('" . $registros["codMateria"] . "', '" . $registros["paralelo"] . "', '$id_alunmno')";
		$resultado3 = mysqli_query($con, $sql3);
	}
?>
<p>Inscripción registrada correctamente </p>
<img src="./imagenes/guardado.png"><br/>

