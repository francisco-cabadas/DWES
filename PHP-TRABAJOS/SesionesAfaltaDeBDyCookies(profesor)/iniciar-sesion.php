<?php
	require_once "_utilidades.php";

	session_start();

	if (isset($_SESSION["sesionIniciada"])) {
		redireccionar("contenido1.php");
	}
?>



<html>

<head>
	<meta charset="UTF-8">
</head>

<body>
	
<?php
	if (isset($_REQUEST["incorrecto"])) {
		echo "<p>Usuario o contraseña incorrectos.</p>";
	}
	if (isset($_REQUEST["sesionCerrada"])) {
		echo "<p>Ha salido correctamente. Su sesión está ahora cerrada.</p>";
	}
?>

	<h1>Iniciar sesión</h1>

	<form action="contenido1.php" method="POST">
		<label><b>Identificador: </b></label><input type="text" name="identificador" /><br />
		<label><b>Contraseña: </b></label><input type="password" name="contrasenna" /><br />
        Recuérdame
		<br />
		<input type="Submit" value="Iniciar sesión" />
	</form>

</body>
</html>