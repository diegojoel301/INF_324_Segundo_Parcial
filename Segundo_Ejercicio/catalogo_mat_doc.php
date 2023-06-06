<!---<?php echo "p2"; ?>--->
<p>Las materias disponibles son: </p>
<?php 
	include "conexion.inc.php";
	$sql = "select a.*, b.nombre, b.paterno from academica2.paralelo a inner join academica2.usuario b on a.idDocente = b.id";
	$resultado = mysqli_query($con, $sql);
?>
<table>
		<tr>
			<th>codMateria</th>
			<th>Paralelo</th>
			<th>Docente</th>
			<th>Horario</th>
		</tr>
		<?php
		while ($registros = mysqli_fetch_array($resultado)) {
			echo "<tr>";
			echo "<td>" . $registros["codMateria"] . "</td>";
			echo "<td>" . $registros["Paralelo"] . "</td>";
			echo "<td>" . $registros["nombre"]." ".$registros["paterno"] . "</td>";
			echo "<td>" . $registros["horario"] . "</td>";
			
			echo "</tr>";
		}
		?>
</table>