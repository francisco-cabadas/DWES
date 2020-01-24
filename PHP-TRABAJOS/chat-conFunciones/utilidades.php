<?php

function conectarBd() {
    $servidor = "localhost";
    $identificador = "root";
    $contrasenna = "";
    $bd = "minifb"; // Schema
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // Modo emulación desactivado para prepared statements "reales"
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
    ];

    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit("Error al conectar");
    }

    return $pdo;
}

// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar($url) {
    header("Location: $url");
    exit();
}


//obtener usuario
function obtenerUsuario($identificador, $contrasenna, $cookieUsuario)
{
    $pdo = conectarBd();

    if($contrasenna) {       //   !!!!!!no entiendo esta funcion, preguntar!!!!!
        $campoParaComprobacion = "contrasenna";
        $valorParaComprobacion = $contrasenna;
    } else {
        $campoParaComprobacion = "cookieUsuario";
        $valorParaComprobacion = $cookieUsuario;
    }

    $consulta = "SELECT id, nombre FROM usuario WHERE BINARY identificador=? AND BINARY $campoParaComprobacion=?";
    $select = $pdo->prepare($consulta);
    $select->execute([$identificador, $valorParaComprobacion]);
    $rs = $select->fetchAll();

    if ($rs) return $rs[0];
    else return null;
}


//anotar datos para la sesion
function anotarDatosSesionRam($id, $identificador, $nombre)
{
    $_SESSION["sesionIniciada"] = "true";
    $_SESSION["id"] = $id;
    $_SESSION["identificador"] = $identificador;
    $_SESSION["nombre"] = $nombre;
}

//renovar cookie
function establecerCookieRecuerdame($identificador, $codigoCookie)
{
    // Enviamos el código cookie al cliente, junto con su identificador.
    setcookie("identificador", $identificador, time() + 60); // Un mes sería: +30*24*60*60
    setcookie("codigoCookie", $codigoCookie, time() + 60); // Un mes sería: +30*24*60*60
}


//insertar cookie a base de datos
function generarCookieRecuerdame($identificador)
{
    // Creamos un código cookie muy complejo (pero no necesariamente único).
    $codigoCookie = generarCadenaAleatoria(); // Random...

    // Anotamos el código cookie en nuestra BD.
    $pdo = conectarBd();
    $sql = "UPDATE usuario SET codigoCookie=? WHERE identificador=?";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([$codigoCookie, $identificador]);

    // Para una seguridad óptima convendriá anotar en la BD la fecha
    // de caducidad de la cookie y no aceptar ninguna cookie pasada dicha fecha.

    establecerCookieRecuerdame($identificador, $codigoCookie);
}

//generar cookieUsuario de forma aleatoria
function generarCadenaAleatoria()
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 32; $x = rand(0,$z), $s .= $a{$x}, $i++);
    return $s;
}

//funcion para borrar cookie
function borrarCookieRecuerdame($identificador)
{
    // Eliminamos el código cookie de nuestra BD.
    $pdo = conectarBd();
    $sql = "UPDATE usuario SET codigoCookie=NULL WHERE identificador=?";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([$identificador]);

    setcookie("identificador", "", time() - 3600); // Tiempo en el pasado, para (pedir) borrar la cookie.
    setcookie("codigoCookie", "", time() - 3600); // Tiempo en el pasado, para (pedir) borrar la cookie.
}




