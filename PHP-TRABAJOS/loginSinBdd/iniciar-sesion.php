<?php
if(isset($_REQUEST["usuarioVacio"])){
    echo ("Identificate para poder continuar");
}else if(isset($_REQUEST["contraseñaIncorrecta"])){
    echo ("La contraseña que has metido es incorrecta introduce 'a' en la contraseña");
}


?>


<html>



<body
<br>            <!-- mejorar aspecto -->
<h2>Inicio de sesion</h2>
<form method='GET' action="contenido1.php">

    <input type='text' name="identificador"><br>
    <input type='password' name="contraseña"><br>
    <input type="submit" name="enviar" value="enviar">

</form>

</body>

</html>
