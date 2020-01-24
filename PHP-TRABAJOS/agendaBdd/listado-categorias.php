<?php
	require_once "_utilidades.php";

	$pdo = conectarBd();
	
	$consulta = "SELECT id, nombre FROM categoria WHERE id>? ORDER BY nombre";

    $select = $pdo->prepare($consulta);
    $select->execute([0]);
    $rs = $select->fetchAll();

    if(!$rs) exit("Sin resultados."); // No ha venido ninguna fila.
?>



<html>

<head>
	<meta charset="UTF-8">
</head>

<body>

<h1>Listado de Categorías</h1>

<table border="1">

	<tr>
		<th>Nombre</th>
	</tr>

	<?php
		foreach ($rs as $fila) { ?>
			<tr>
				<td><a href="ficha-categoria.php?id=<?=$fila["id"] ?>"><?=$fila["nombre"] ?></a></td>
				<td><a href="eliminar-categoria.php?id=<?=$fila["id"] ?>">(X)</a></td>
			</tr>
	<?php } ?>

</table>

<br />

<a href="ficha-categoria.php?id=-1">Crear entrada</a>

<br />
<br />

<a href="listado-personas.php">Gestionar listado de Personas</a>

</body>

</html>