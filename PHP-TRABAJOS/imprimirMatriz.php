<?php

declare(strict_types=1);

const ALTO = 6;
const ANCHO = 12;


?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>

<body>


<?php


for ($i = 0; $i < ALTO; $i++) {

    for ($x = 0; $x < ANCHO; $x++) {

        $matriz[$i][$x] = 1;
    }
}

echo "<table>";
for ($i = 0; $i < ALTO ; $i++) {
    echo "<tr>";
    for ($x = 0; $x < ANCHO ; $x++) {
        echo "<td>";
        echo($matriz[$i][$x]);

        echo "<br>";

    }
}

echo "</table>";
?>
</body>


</body>


</html>
