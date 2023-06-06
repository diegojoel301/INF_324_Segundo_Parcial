<?php
/*
http://localhost/work/mflujo.php?flujo=F1&proceso=P1
*/
include "conexion.inc.php";
session_start();
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];

$pantalla = $_GET["pantalla"];
$tramite = $_SESSION["codtramite"];
$uuu = $_SESSION["usuario"]; //usuario global

$condi = "SELECT tipo FROM flujo ";
$condi .= "WHERE flujo='$flujo' and proceso='$proceso' ";
$result = mysqli_query($con, $condi);
$regist = mysqli_fetch_array($result);
$tipo = $regist["tipo"];
$ps="";

if ($tipo == 'C') {
    if (isset($_GET["Siguiente"])) {
        if (isset($_GET["Si"])) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and codProceso='$proceso'";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProcesoSi"];
        }
        if (isset($_GET["No"])) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and codProceso='$proceso'";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProcesoNo"];
        }
        //completar el flujo usuario
        $today = getdate();
	    $fecha_fin = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	    $sql = "UPDATE flujousuario SET fechafin='$fecha_fin' WHERE numerotramite='$tramite' and proceso='$proceso'";
	    $resultado = mysqli_query($con, $sql);
    }
    if (isset($_GET["Anterior"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and procesosiguiente='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["proceso"];
        if ($procesoSiguiente == null) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and (codProcesoSi='$proceso' or codProcesoNo='$proceso') ";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProceso"];
        }
    }

    if ($procesoSiguiente == 'P6' && !isset($_GET["Anterior"])) {
	    /* Condicional de kardex a estudiante */
	    /* Escribir en bandeja de entrada de estudiante */

	    /* Hallar al estudiante al cual mandar */
	    $sql1 = "SELECT usuario FROM estudiantekardex WHERE codTramite='$tramite' LIMIT 1";
	    $resultado1 = mysqli_query($con, $sql1);
	    $registros1 = mysqli_fetch_array($resultado1);
	    $usuario = $registros1["usuario"];

	    $flujo = "F1";
	    $proceso = "P6";
	    /*$sql1 = "SELECT max(numerotramite) tramite FROM flujousuario";
	    $resultado1 = mysqli_query($con, $sql1);
	    $registros1 = mysqli_fetch_array($resultado1);
	    $tramite = $registros1["tramite"];*/

	    $today = getdate();
	    $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	    $fecha_fin = "NULL";

	    $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
	    $sql .= $fecha_fin . ",'" . $usuario . "')";
	    $resultado = mysqli_query($con, $sql);

	    /* Obtenemos explicacion */
	    if (isset($_GET['explicacion'])) {
	        $explicacion = $_GET["explicacion"];
	    }
	    
	    /* Guardamos en BD */
	    $sql = "INSERT INTO kardexestudiante1 VALUES ('$tramite','$uuu','$explicacion')";
	    $resultado = mysqli_query($con, $sql);

	    /*eliminamos de estudiante kardex*/
	    $sql = "DELETE from estudiantekardex where  codTramite = '$tramite'";
	    $resultado = mysqli_query($con, $sql);
	    header("Location: bandejaE.php");

	} else {
	        header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");
	}
} else {
    if (isset($_GET["Anterior"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and procesosiguiente='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["proceso"];
        if ($procesoSiguiente == null) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and (codProcesoSi='$proceso' or codProcesoNo='$proceso') ";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProceso"];
        }if($proceso=="P1" || $proceso=="P4" || $proceso=="P6" || $proceso=="P11" || $proceso=="P9" ){
			$procesoSiguiente = $proceso;
        }
    }
    if (isset($_GET["Siguiente"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and proceso='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["procesosiguiente"];
        //el ultimo
        if($procesoSiguiente == null && $registros["proceso"]== "P12"){
        	//Ahora datos de la materia y paralelo
        	//borramos datos de estudiante kardex
		    $sql2 = "SELECT d.codMateria, c.nombre ,d.Paralelo, d.horario FROM academica2.materia c INNER JOIN
		    		(SELECT a.codMateria, a.Paralelo, a.horario FROM academica2.paralelo a INNER JOIN
					(SELECT codMateria, paralelo FROM workflowsegundoparcial.estudiantekardex WHERE codTramite='$tramite' LIMIT 1) b ON a.codMateria=b.codMateria and a.Paralelo=b.paralelo) d ON c.codMateria=d.codMateria";
		    $resultado2 = mysqli_query($con, $sql2);
		    $registros2 = mysqli_fetch_array($resultado2);

		    //borramos ese dato de workflowsegundoparcial
		    $sql3 = "DELETE FROM workflowsegundoparcial.estudiantekardex WHERE codTramite = '$tramite' AND codMateria = '" . $registros2["codMateria"] . "' AND paralelo = '" . $registros2["Paralelo"] . "'";
		    $resultado3 = mysqli_query($con, $sql3);
		    header("Location: fin.php");
        	exit;

        }
        //actualizar flujo
        $today = getdate();
	    $fecha_fin = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	    $sql = "UPDATE flujousuario SET fechafin='$fecha_fin' WHERE numerotramite='$tramite' and proceso='$proceso'";
	    $resultado = mysqli_query($con, $sql);
    }

    /* Cambios de roles */
    if (($procesoSiguiente == "P4" || $procesoSiguiente == "P9" || $procesoSiguiente == "P11") && !(isset($_GET["Anterior"])))
    {
        if ($procesoSiguiente == "P4") {
            $usuario2 = $_SESSION['usuario'];

            /* Escribir en bandeja de entrada de kardex */
            // Hallar el usuario de kardex con menor tareas
            $sql = "SELECT nombre, contador FROM (
                        SELECT a.nombre, COUNT(a.nombre) AS contador
                        FROM workflowsegundoparcial.flujousuario b
                        INNER JOIN academica2.usuario a ON a.rol = 'kardex' AND a.nombre = b.usuario
                        GROUP BY usuario
                    ) AS subconsulta
                    ORDER BY contador ASC
                    LIMIT 1;";
            $resultado2 = mysqli_query($con, $sql);
            $registros2 = mysqli_fetch_array($resultado2);
            $usuario = $registros2["nombre"];

            $flujo = "F1";
            $proceso = "P4";
            /*$sql1 = "SELECT max(numerotramite)+1 tramite FROM flujousuario";
            $resultado1 = mysqli_query($con, $sql1);
            $registros1 = mysqli_fetch_array($resultado1);
            $tramite = $registros1["tramite"];*/

            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";

            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "' ";
            $sql .= "," . $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);

            // Checkboxes
            // Obtener los valores seleccionados de los checkboxes
            if (isset($_GET['materia'])) {
                $materiasSeleccionadas = $_GET['materia'];

                // Verificar si se ha excedido el límite de 6 materias
                if (count($materiasSeleccionadas) <= 6) {
                    // Recorrer y guardar los datos de cada materia seleccionada
                    foreach ($materiasSeleccionadas as $materiaSeleccionada) {
                        // Separar el código de la materia y el paralelo
                        $datos = explode(" ", $materiaSeleccionada);
                        $codMateria = $datos[0];
                        $paralelo = substr($datos[0], -1);

                        // Guardar los datos en la base de datos
                        $sql = "INSERT INTO estudiantekardex VALUES ('$tramite', '$usuario2', '$codMateria', '$paralelo')";
                        mysqli_query($con, $sql);
                    }
                }
            }
            /* ---------------------- */
        	header("Location: carga.php");
        	exit;
        }
        elseif($procesoSiguiente == "P9"){
        	//Debemos enviar la lista de materias inscritas al estudiante
        	//creamos flujo para estudiante las materias inscritas ya estaran en estudiantekardex
        	$sql1 = "SELECT usuario FROM estudiantekardex WHERE codTramite='$tramite' LIMIT 1";
		    $resultado1 = mysqli_query($con, $sql1);
		    $registros1 = mysqli_fetch_array($resultado1);
		    $usuario = $registros1["usuario"];

		    $flujo = "F1";
		    $proceso = "P9";
		    /*$sql1 = "SELECT max(numerotramite) tramite FROM flujousuario";
		    $resultado1 = mysqli_query($con, $sql1);
		    $registros1 = mysqli_fetch_array($resultado1);
		    $tramite = $registros1["tramite"];*/

		    $today = getdate();
		    $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
		    $fecha_fin = "NULL";

		    $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
		    $sql .= $fecha_fin . ",'" . $usuario . "')";
		    $resultado = mysqli_query($con, $sql);

 			header("Location: bandejaE.php");
 			exit;
        }
        if($procesoSiguiente == "P11"){
        	//Notificamos a los docentes respectivos de que un nuevo estudiante se registro
        	//creamos flujo para docente actualizacion de lista

        	$sql1 = "SELECT * FROM estudiantekardex WHERE codTramite='$tramite'";
		    $resultado1 = mysqli_query($con, $sql1);
		    
		    //$usuario = $registros1["usuario"];

		    $flujo = "F1";
		    $proceso = "P11";
		    $today = getdate();
		    $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
		    $fecha_fin = "NULL";
		    //varios paralelos
		    while($registros1 = mysqli_fetch_array($resultado1)){
		    	//necesitamos usuario (docente)
		    	$sql2 = "SELECT c.nombre from academica2.usuario c INNER JOIN
		    			(SELECT a.idDocente from academica2.paralelo a INNER JOIN 
		    			(SELECT codMateria, paralelo FROM workflowsegundoparcial.estudiantekardex WHERE codTramite='$tramite') b ON a.codMateria=b.codMateria and a.Paralelo=b.paralelo) d ON c.id=d.idDocente LIMIT 1";
		    	$resultado2 = mysqli_query($con, $sql2);
		    	$registros3=mysqli_fetch_array($resultado2);
		    	$usuario = $registros3["nombre"];

		    	$sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
			    $sql .= $fecha_fin . ",'" . $usuario . "')";
			    $resultado = mysqli_query($con, $sql);
		    }
		    
        	header("Location: bandejaE.php");
        	exit;
        }
        

        
    }  

    header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");
    
}

?>
