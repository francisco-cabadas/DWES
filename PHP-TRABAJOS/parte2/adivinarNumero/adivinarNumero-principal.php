<?php

$nOculto = (int) $_REQUEST["nOculto"];

if (isset($_REQUEST["intento"])) {
    $intento = (int) $_REQUEST["intento"];

    $asteriscos = 1 + abs($intento - $nOculto) / 10;
    $cercania = "";
    for ($i=1; $i <= $asteriscos; $i++) {
        $cercania = $cercania . "*";
    }
} else {
    $intento = null;
}

?>



<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>


<?php

if ($intento == null) {
    // No informamos de nada, el juego acaba de empezar.
} elseif ($intento < $nOculto) {
    echo "<p>El número que buscas es mayor ($cercania)</p>";
} elseif ($intento > $nOculto) {
    echo "<p>El número que buscas es menor ($cercania)</p>";
} else {
    echo "<p>Enohorabuena el numero es $nOculto.</p>";
}

if ($intento != $nOculto) { // Presentamos el formulario:

    ?>

    <form method="post">
        <p>Jugador 2: Adivina el número:</p>
        <input type="hidden" name="nOculto" value="<?= $nOculto ?>">
        <input type="text" name="intento">
        <input type="submit" value="enviar">
    </form>

    <?php

}

?>

</body>

</html>