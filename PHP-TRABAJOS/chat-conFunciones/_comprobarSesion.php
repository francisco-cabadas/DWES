<?php

require_once ("utilidades.php");

session_start(); //crea o recupera una sesión

if(isset($_SESSION["sesionIniciada"])){  //si hay una sesión iniciada
    if(isset($_COOKIE["identificador"])){ //si viene cookie la renovamos
        establecerCookieRecuerdame($_COOKIE["identificador"], $_COOKIE["cookieUsuario"]); //funcion de archivo utilidades, ampliar tiempo cookie
    }//else no hago nada si no viene cookie.

}else { //si no viene session
    if (isset($_COOKIE["identificador"])) { //si viene una cookie...
        $identificador = $_COOKIE["identificador"];
        $cookieUsuario = $_COOKIE["cookieUsuario"];

        //comprobamos que las cookies coinciden con los de la bd
        $filaUsuario = obtenerUsuario($identificador, null, $cookieUsuario);

        if ($filaUsuario) { //si es true, es que viene un usuario, entonces la cookie es correcta
            //creamos la sesion de id,identificador y nombre a traves de la funcion.
            anotarDatosSesionRam($filaUsuario["id"], $identificador, $filaUsuario["nombre"]);

            //renovamos cookie
            generarCookieRecuerdame($identificador);
        } else {// Parecía que venía una cookie válida pero... No es válida o pasa algo raro.
            // Borrar la cookie mala que nos están enviando (si no, la enviarán otra vez, y otra, y otra...)
            borrarCookieRecuerdame($identificador);

            // REDIRIGIR A INICIAR SESIÓN PARA IMPEDIR QUE ESTE USUARIO VISUALICE CONTENIDO PRIVADO.
            redireccionar("iniciar-sesion.php");

        }
    } else if (isset($_REQUEST["identificador"])) {  //si hay un formulario enviado.  Lo comprobaremos contra la BD.

        $identificador = $_REQUEST["identificador"];
        $contrasenna = $_REQUEST["contrasenna"];
        $recuerdame = isset($_REQUEST["recuerdame"]); //true si viene recuerdame, false si no viene.

        //comprobamos contra la base de datos si los datos enviados por formulario son correctos
        $filaUsuario = obtenerUsuario($identificador, $contrasenna, null);

        if ($filaUsuario) {//si viene algo es que existe el usuario
            //creamos sesion de usuario
            anotarDatosSesionRam($filaUsuario["id"], $identificador, $filaUsuario["nombre"]);
            if ($recuerdame) {
                generarCookieRecuerdame($identificador);
            }//else es que no han marcado la opcion de recuerdame, pero continua la ejecución del programa
        } else {  // si no viene ninguna fila es que no es correcto usuario y/o contraseña
            redireccionar("inicio.php?error");

        }

    } else {  //si no hay ni sesion, ni cookie ni formulario.
        redireccionar("inicio.php?error");
    }
}

