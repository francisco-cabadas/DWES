<?php

require_once "_utilidades.php";

session_start(); // Esto crea una nueva sesión-RAM o recupera la sesión RAM existente.

if (isset($_SESSION["sesionIniciada"])) { // SÍ hay sesión-usuario iniciada en la sesión-RAM.

    // >>> NO HACEMOS NADA. DEJAMOS QUE SE CONTINÚE EJECUTANDO EL PHP QUE NOS LLAMÓ... >>>

} else { // NO hay sesión-usuario iniciada en la sesión-RAM.

//    if (isset($_COOKIE["identificador"])) {
//
//        // Comprobar con BD...
//
//        if (cookie valida) {
//            // dar por iniciada la sesión
//            // renovar la cookie (su caducidad)
//        } else {
//            // borrar la cookie mala que nos están enviando
//            // (si no, la enviarán otra vez, y otra, y otra...)
//            REDIRIGIR A INICIAR SESIÓN PARA IMPEDIR QUE ESTE USUARIO VISUALICE CONTENIDO PRIVADO.
//        }
//    }

    if (isset($_REQUEST["identificador"])) { // SÍ hay formulario enviado. Lo comprobaremos contra la BD.
        $identificador = $_REQUEST["identificador"];
        $contrasenna = $_REQUEST["contrasenna"];

//    	$sql = "SELECT id, nombre FROM usuario WHERE identificador='$identificador' AND contrasenna='$contrasenna'";
//    	...

        if ($contrasenna == "a") { // $sentencia->rowCount() == 1) { // Sí existe el usuario y SÍ coincide la contraseña.
            // Recuperar los datos adicionales del usuario que acaba de iniciar sesión.
//	    	$fila = ...
            $id = 17; // $fila["id"];
            $nombre = "Fulanito"; // $fila["nombre"];

            // Marcar la sesión-usuario como iniciada:
            $_SESSION["sesionIniciada"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["identificador"] = $identificador;
            $_SESSION["nombre"] = $nombre;

            // >>> Y DEJAMOS QUE SE CONTINÚE EJECUTANDO EL PHP QUE NOS LLAMÓ... >>>
        } else { // Si vienen 0 filas, no existe ese usuario o la contraseña no coincide.
            redireccionar("iniciar-sesion.php?incorrecto=true");
        }
    } else { // NO hay ni cookie, ni formulario enviado.
        // Redirigimos a iniciar sesión:
        redireccionar("iniciar-sesion.php");
    }
}