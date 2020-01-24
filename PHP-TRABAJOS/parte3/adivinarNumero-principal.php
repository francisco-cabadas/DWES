<?php
session_start();

$reciboOculto = isset($_REQUEST["oculto"]);

$hayIntento = isset($_REQUEST["intento"]);
$seguir = true;

if (!$reciboOculto) {


} else {
    $_SESSION["oculto"] = $_REQUEST["oculto"];
}

if ($hayIntento) {
    $intento = $_REQUEST["intento"];
    if ($_SESSION["oculto"] == $intento) {
        $seguir = false;

    } else {

        $seguir = true;

    }
}


?>


<html>

<body>

<?php


?>


<h1>¿Que numero será?</h1>


<?php

if ($seguir == false) {
    echo("enhorabuena has ganado, el numero era el " . $_SESSION["oculto"]);
    echo(" volver a jugar?"); ?>
    <a href="adivinarNumero-inicio.php">Volver a jugar?</a>
<?php } else { ?>


    <form method='GET' action="adivinarNumero-principal.php">


        <input type="text" name="intento">
        <input type="submit" name="enviar" value="enviar">

    </form>
<?php } ?>

</body>

</html>