<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<!-- hecho por:
	Alegre Flores Samuel Alejandro
	Condori Quispe Diego Joel
-->
</head>

	<style>
		html, body {
			height: 100%;
		}

		html {
			display: table;
			margin: auto;
		}

		body {
			display: table-cell;
			vertical-align: middle;
		}
	</style>
	<body>
		<h1>Login</h1>
		<form method="GET" action="control.php">	
		<div class="form-outline mb-4">
			<input type="text" id="form2Example1" class="form-control" name="usuario"/>
			<label class="form-label" for="form2Example1">Usuario</label>
		</div>
		<div class="form-outline mb-4">
			<input type="password" id="form2Example2" class="form-control" name="password" />
			<label class="form-label" for="form2Example2">Password</label>
		</div>
		<br>
		<button type="Submit" name="Ingresar" value="Ingresar" class="btn btn-primary btn-block mb-4">Sign in</button>
	</form>
</body>
</html>
