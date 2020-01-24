<?php
	require_once "_utilidades.php";

	$pdo = conectarBd();

	$id = (int) $_REQUEST["id"]; // El id de la fila que hay que eliminar.

	$sql = "DELETE FROM categoria WHERE id=?";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([$id]);

 	$correcto = ($sentencia->rowCount() == 1);
?>



<html>

<head>
	<meta charset="UTF-8">
</head>

<body>

<?php if ($correcto) { ?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la categoría.</p>

<?php } else { ?>

	<h1>Error en la eliminación</h1>
	<p>No existe la categoría que se pretende eliminar o se ha producido un error.</p>

<?php } ?>

<a href="listado-categorias.php">Volver al listado de categorías.</a>

</body>
</html>