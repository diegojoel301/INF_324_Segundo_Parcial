<!--<?php echo "p11"; ?>-->

<?php

		$tramite = $_SESSION["codtramite"];
		//Hallamos los datos del alumno y la materia y paralelo inscrito
		include "conexion.inc.php";
		//Primero nombre completo de alumno
		$sql1 = "SELECT a.*, b.* FROM academica2.usuario a INNER JOIN
				(SELECT usuario FROM workflowsegundoparcial.estudiantekardex WHERE codTramite='$tramite' LIMIT 1) b ON a.nombre=b.usuario";
	    $resultado1 = mysqli_query($con, $sql1);
	    $registros1 = mysqli_fetch_array($resultado1);
	    //en registros 1 estan los datos del usuario

	    

	    //Ahora datos de la materia y paralelo
	    $sql2 = "SELECT d.codMateria, c.nombre ,d.Paralelo, d.horario FROM academica2.materia c INNER JOIN
	    		(SELECT a.codMateria, a.Paralelo, a.horario FROM academica2.paralelo a INNER JOIN
				(SELECT codMateria, paralelo FROM workflowsegundoparcial.estudiantekardex WHERE codTramite='$tramite' LIMIT 1) b ON a.codMateria=b.codMateria and a.Paralelo=b.paralelo) d ON c.codMateria=d.codMateria";
	    $resultado2 = mysqli_query($con, $sql2);
	    $registros2 = mysqli_fetch_array($resultado2);

	    //borramos ese dato de workflowsegundoparcial
	    /*$sql3 = "DELETE FROM workflowsegundoparcial.estudiantekardex WHERE codTramite = '$tramite' AND codMateria = '" . $registros2["codMateria"] . "' AND paralelo = '" . $registros2["Paralelo"] . "'";
	    $resultado3 = mysqli_query($con, $sql3);*/
?>

<p>Un nuevo estudiante se inscribio a la siguiente materia:</p>
<div>
	<p>Nombre estudiante: </p>
			<label for="ci">CI:</label>
            <input type="text" id="ci" name="ci" value="<?php echo $registros1["ci"]; ?>" readonly><br/>
            <label for="matricula">Matricula:</label>
            <input type="text" id="matricula" name="matricula" value="<?php echo $registros1["matricula"]; ?>" readonly><br/>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $registros1["nombre"]; ?>" readonly><br/>
            <label for="paterno">Paterno:</label>
            <input type="text" id="paterno" name="paterno" value="<?php echo $registros1["paterno"]; ?>" readonly><br/>
            <label for="materno">Materno:</label>
            <input type="text" id="materno" name="materno" value="<?php echo $registros1["materno"]; ?>" readonly><br/>
</div>
        
<div>
	<p>Datos de la materia a la que se inscribio: </p>
       <label for="Sigla">Sigla:</label>
       <input type="text" id="Sigla" name="Sigla" value="<?php echo $registros2["codMateria"]; ?>" readonly><br/>
       <label for="Sigla">Nombre Materia:</label>
       <input type="text" id="nameMateria" name="nameMateria" value="<?php echo $registros2["nombre"]; ?>" readonly><br/>
       <label for="Paralelo">Paralelo:</label>
       <input type="text" id="Paralelo" name="Paralelo" value="<?php echo $registros2["Paralelo"]; ?>" readonly><br/>
       <label for="horario">horario:</label>
       <input type="text" id="horario" name="horario" value="<?php echo $registros2["horario"]; ?>" readonly><br/>
</div>