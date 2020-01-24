<?php

if (!isset($_REQUEST["acumulado"])) { // Si NO hay formulario enviado (1ª vez).
    $acumulado = 0;
    $diferencia = 1;
} else { // Sí hay formulario enviado (2ª ó siguientes veces).
    $acumulado = (int) $_REQUEST["acumulado"];
    $diferencia = (int) $_REQUEST["diferencia"];

    if (isset($_REQUEST["resta"])) {
        $acumulado = $acumulado - $diferencia;
    } else if (isset($_REQUEST["suma"])) {
        $acumulado = $acumulado + $diferencia;
    } else {
        // ERROR
    }
}

?>



<html>

<h1><?=$acumulado?></h1>

<form method='get'>

    <input type='hidden' name='acumulado' value='<?=$acumulado?>'>

    <input type='submit' value=' - ' name='resta'>
    <input type='text' name='diferencia' value='<?=$diferencia?>'>
    <input type='submit' value=' + ' name='suma'>

</form>

</html>