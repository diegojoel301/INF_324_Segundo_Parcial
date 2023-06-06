<!----<?php echo "p7"; ?>--->
<p>¿Existe cupos suficientes para realizar la inscripción el as siguientes materias?</p><br/>

<?php 
	
	$user=$_SESSION['usuario'];
	$tramite=$_SESSION['codtramite'];
	include "conexion.inc.php";
	$sql = "SELECT DISTINCT * FROM academica2.usuario c
			INNER JOIN (SELECT a.*, b.idDocente, b.horario FROM academica2.paralelo b
						INNER JOIN (SELECT * FROM workflowsegundoparcial.estudiantekardex WHERE codTramite=$tramite) a
						ON b.Paralelo=a.paralelo AND b.codMateria=a.codMateria) d
			ON c.id=d.idDocente";
	$resultado = mysqli_query($con, $sql);

	$sql2 = "SELECT * FROM estudiantekardex WHERE codTramite='$tramite'";
	$resultado2 = mysqli_query($con, $sql2);
	$registros2 = mysqli_fetch_array($resultado2);
?>


<label for="nombre">Estudiante:</label>
<input type="text" id="nombre" value="<?php echo $registros2['usuario']; ?>" readonly><br>
<label for="tramite">Trámite #:</label>
<input type="text" id="tramite" value="<?php echo $tramite; ?>" readonly><br>

 <label for="nombre">Materias:</label>
 <table class="table">
 	<thead class="thead-dark">
		<tr>
			<th>Sigla</th>
			<th>Paralelo</th>
			<th>Docente</th>
			<th>Horario</th>
		</tr>
	</thead>
	<?php
	while ($registros = mysqli_fetch_array($resultado)) {
		echo "<tr>";
		echo "<td>" . $registros["codMateria"] . "</td>";
		
		echo "<td>" . $registros["paralelo"]. " </td>";

		echo "<td>" . $registros["nombre"] . $registros["paterno"] . "</td>";
		
		echo "<td>" . $registros["horario"] . "</td>";
		
		echo "</tr>";
	}
	?>
</table>
<br>
<label for="si">Sí</label>
<input type="radio" id="Si" name="Si" value="Si">
<br>
<label for="no">No</label>
<input type="radio" id="No" name="No" value="No" onclick="mostrarCuadroTexto()">
<br>
<label for="explicacion">Explicación:</label>
<textarea id="explicacion" name="explicacion" rows="4" <?php echo isset($_POST['opcion']) && $_POST['opcion'] === 'No' ? '' : 'disabled'; ?>></textarea><br>
<p>Al dar siguiente se enviará al estudiante</p>

<script>
  function mostrarCuadroTexto() {
    var checkboxNo = document.getElementById("No");
    var cuadroTexto = document.getElementById("explicacion");

    if (checkboxNo.checked) {
      cuadroTexto.removeAttribute("disabled");
    } else {
      cuadroTexto.setAttribute("disabled", "disabled");
    }
  }
</script>