<!---<?php echo "p3"; ?>--->
<?php 
	include "conexion.inc.php";
	$sql = "SELECT a.*, b.nombre, b.paterno FROM academica2.paralelo a INNER JOIN academica2.usuario b ON a.idDocente = b.id";
	$resultado = mysqli_query($con, $sql);
?>

<p>Recuerde puede inscribirse a un máximo de 6 materias, si selecciona más y lo envía kardex lo rechazará</p>
<table>
	<tr>
		<th>codMateria</th>
		<th>Paralelo</th>
		<th>Docente</th>
		<th>Horario</th>
		<th>Inscripción</th>
	</tr>

	<?php
	while ($registros = mysqli_fetch_array($resultado)) {
		echo "<tr>";
		echo "<td>" . $registros["codMateria"] . "</td>";
		echo "<td>" . $registros["Paralelo"] . "</td>";
		echo "<td>" . $registros["nombre"]." ".$registros["paterno"] . "</td>";
		echo "<td>" . $registros["horario"] . "</td>";
		echo "<td><input type='checkbox' name='materia[]' value='" . $registros["codMateria"] . "-" . $registros["Paralelo"] . "'></td>";
		echo "</tr>";
	}
	?>
</table>


	
