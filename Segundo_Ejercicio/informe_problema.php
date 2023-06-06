<!--<?php echo "p6"; ?>-->
<?php
	include "conexion.inc.php";
	$tramite = $_SESSION["codtramite"];
	$sql = "SELECT * FROM kardexestudiante1 WHERE codTramite='$tramite'";
	$resultado = mysqli_query($con, $sql);
	$registro = mysqli_fetch_array($resultado);
	$explicacion = $registro["mensaje"];
	if($explicacion==""){
		$explicacion="Dirijase a kardex ";
	}
?>

<p>Acaba de recibir el siguiente mensaje de parte de kardex. Debe volver a llenar el formulario de inscripción:</p>
<label for="explicacion">Explicación:</label>
<textarea id="explicacion" name="explicacion" rows="4"><?= $explicacion; ?></textarea><br>
