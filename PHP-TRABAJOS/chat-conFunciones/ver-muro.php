<?php

require_once "_comprobarSesion.php";


//tengo que modificar esto

$pdo = conectarBd();
$sql = "SELECT u.id AS u_id, u.identificador AS u_identificador, u.nombre AS u_nombre, m.fechaPublicacion AS m_fechaPublicacion, m.contenido AS m_contenido FROM mensaje AS m INNER JOIN usuario AS u ON m.autor_id = u.id ORDER BY fechaPublicacion DESC";
$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();


//consulta y proceso para guardar mensaje de la bdd
if(isset($_REQUEST["texto"])){
    $consultaInsertarTexto="INSERT INTO mensajes (identificador, texto) values (?,?) ";
    $texto=$_REQUEST["texto"];
    $insertarTexto = $pdo->prepare($consultaInsertarTexto);
    $insertarTexto->execute([$_SESSION["identificador"], $texto]);



}





// consulta que muestra mensajes
$consultaMostrarMensajes="SELECT * FROM mensajes order by fecha ASC";
$mensajes = $pdo->prepare($consultaMostrarMensajes);
$mensajes->execute();
$mensajes=$mensajes->fetchAll()



?>


<html>
<head>
    <meta charset="utf-8">
    <style>
        #columnasNombres{

            font-size: 20px;
            color: mediumblue;
            text-decoration: underline;
        }
        .contenidoMensajes{
            width: 100%;
        }
        table{

            width: 100%;
            border: 2px solid black;
            border-collapse: collapse;
        }
        table tr, td {
            height: auto;
            width: 30%;
        }

    </style>
</head>
<body>
<div  class="contenidoMensajes">

    <?php foreach ($mensajes as $fila) { ?>
        <table>
            <tr id="columnasNombres">
                <td>Usuario</td>
                <td>Mensaje</td>
                <td>Fecha</td>
            </tr><br>
            <tr>
                 <td> <?php echo $fila["identificador"];?> </td>
                 <td> <?php echo $fila["texto"];?> </td>
                 <td> <?php echo $fila["fecha"];?> </td>
            </tr>
         </table>
    <?php } ?>
</div>
<div class="fromMensajes" style="margin-top: 5px">
    <form>
        <input type="text" name="texto">
        <input type="submit" value="enviar">
    </form>
</div>

<a href="cerrar-sesion.php">cerrar sesion actual</a>






</body>

</html>
