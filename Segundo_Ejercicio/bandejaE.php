<?php
session_start();

include "conexion.inc.php";

$sql = "";
/*
echo $_SESSION['codtramite'];
echo $_SESSION['usuario'];
echo $_SESSION['rol'];
*/

if($_SESSION['rol'] == "estudiante")
{
	$sql = "select * from flujousuario ";
	$sql .= "where usuario='" . $_SESSION["usuario"] . "' ";
	$sql .= "and fechafin is null ";
}
elseif($_SESSION['rol'] == "kardex")
{
	$sql = "select * from flujousuario ";
	$sql .= "where proceso = 'P4' ";
	$sql .= "and fechafin is null ";
}
else
{
	$sql = "select * from flujousuario ";
	$sql .= "where usuario='" . $_SESSION["usuario"] . "' ";
	$sql .= "and fechafin is null ";
}

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
		    echo "<td>";
		    echo "<a href='mflujo.php?flujo=" . $registros["flujo"] . "&proceso=" . $registros["proceso"] . "'>";
		    echo "Ir</a></td>";
		    echo "</tr>";

		    // Guardar la variable local en una sesión
		    $_SESSION['codtramite'] = $registros["numerotramite"];
		}
		?>
	</table>
	<br>
	<a href="nuevoflujo.php">Nuevo</a><br>
	<a href="bandejaS.php">Ver bandeja de salida</a>
</body>
</html>
