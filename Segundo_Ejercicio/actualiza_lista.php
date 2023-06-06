<!---<?php echo "p12"; ?>--->
<?php
	$tramite = $_SESSION["codtramite"];
	//Ahora datos de la materia y paralelo
	$sql2 = "SELECT d.codMateria, c.nombre, d.Paralelo, d.horario FROM academica2.materia c INNER JOIN
				(SELECT a.codMateria, a.Paralelo, a.horario FROM academica2.paralelo a INNER JOIN
				(SELECT codMateria, paralelo FROM workflowsegundoparcial.estudiantekardex WHERE codTramite='$tramite' LIMIT 1) b ON a.codMateria=b.codMateria AND a.Paralelo=b.paralelo) d ON c.codMateria=d.codMateria";
	$resultado2 = mysqli_query($con, $sql2);
	$registros2 = mysqli_fetch_array($resultado2);

	//borramos ese dato de workflowsegundoparcial
	/*$sql3 = "DELETE FROM workflowsegundoparcial.estudiantekardex WHERE codTramite = '$tramite' AND codMateria = '" . $registros2["codMateria"] . "' AND paralelo = '" . $registros2["Paralelo"] . "'";
	$resultado3 = mysqli_query($con, $sql3);*/

	//Hallamos la lista
	$sql = "SELECT d.codMateria, d.Paralelo, c.* FROM academica2.usuario c INNER JOIN
			(SELECT a.idEstudiante, a.codMateria, a.Paralelo FROM academica2.inscripcion a INNER JOIN 
			(SELECT codMateria, paralelo FROM workflowsegundoparcial.estudiantekardex WHERE codTramite='$tramite' LIMIT 1) b ON a.codMateria=b.codMateria AND a.Paralelo=b.paralelo) d ON d.idEstudiante=c.id ORDER BY c.paterno";
	$resultado = mysqli_query($con, $sql);
?>

<p>Los estudiantes de la Materia: <?php echo $registros2["codMateria"]; ?> del paralelo: <?php echo $registros2["Paralelo"]; ?> son:</p>
<table class="table">
	<thead class="thead-dark">
		<tr>
			<th>CI</th>
			<th>Matricula</th>
			<th>Nombre</th>
			<th>Apellido Paterno</th>
			<th>Apellido Materno</th>
		</tr>
		</thead>
	
		<?php while ($registros = mysqli_fetch_array($resultado)) { ?>
		
		<tr>
			<td><?php echo $registros["ci"]; ?></td>
			<td><?php echo $registros["matricula"]; ?></td>
			<td><?php echo $registros["nombre"]; ?></td>
			<td><?php echo $registros["paterno"]; ?></td>
			<td><?php echo $registros["materno"]; ?></td>
		</tr>
	<?php } ?>
</table>
