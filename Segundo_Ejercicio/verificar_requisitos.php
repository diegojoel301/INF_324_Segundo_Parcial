<!--<?php echo "p5"; ?>-->


<p>¿El estudiante cumple con los requisitos necesarios para inscribirse a esas materias?</p><br/>
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
