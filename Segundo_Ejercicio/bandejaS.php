<?php
session_start();

include "conexion.inc.php";
$sql = "select * from flujousuario ";
$sql .= "where usuario='" . $_SESSION["usuario"] . "' ";
$sql .= "and fechafin is not null ";
$resultado = mysqli_query($con, $sql);
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th>Flujo</th>
				<th>Proceso</th>
				<th>Operacion</th>
			</tr>
		</thead>
		<?php
		while ($registros = mysqli_fetch_array($resultado)) {
			echo "<tr>";
			echo "<td>" . $registros["flujo"] . "</td>";
			echo "<td>" . $registros["proceso"] . "</td>";
			echo "<td>" . $registros["fechainicio"] . "</td>";
			echo "<td>" . $registros["fechafin"] . "</td>";
			echo "</tr>";
		}
		?>
	</table>
	<br>
	<a href="bandejaE.php">Volver</a>
</body>
</html>
