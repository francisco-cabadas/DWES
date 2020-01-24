<?php
	require_once "_varios.php";

	$pdo = conectarBd();
	
	$consulta = "SELECT id, nombre FROM categoria WHERE id=? OR id=? ORDER BY nombre";

    $select = $pdo->prepare($consulta);
    $select->execute([3, 4]);
    $rs = $select->fetchAll(PDO::FETCH_ASSOC);

    if(!$rs) exit("Sin resultados."); // No ha venido ninguna fila.
    print_r($rs);
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