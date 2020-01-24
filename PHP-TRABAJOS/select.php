<?php


$listaNombres = [
    7 => "fran",
    8 => "aitor",
    9 => "chechu",
    3 => "julian",

];
?>


<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>
<select name='idPersona'>
    <option value='-1'>OPCIONES</option>
    <?php
    foreach ($listaNombres as $clave => $valor):
        echo "<option value='$clave'>$valor</option>\n";
    endforeach;
    ?>
</select>
</body>

</html
</body>
</htmL>