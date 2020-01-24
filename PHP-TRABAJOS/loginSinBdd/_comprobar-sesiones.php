<?php
session_start();

$haySesion= isset($_SESSION["sesionIniciada"]);
$vieneUsuario=isset($_REQUEST["identificador"]);
$contraseñaCorrecta=isset($_REQUEST["contraseña"]);

    if(!$haySesion){
        if($vieneUsuario){
            if($contraseñaCorrecta){
                if($_REQUEST["contraseña"]== "a"){
                    $_SESSION["sesionIniciada"]=true;                                //si se cumple, sesionIniciada es true, y creamos sesion de identificador
                    $_SESSION["identificador"]=$_REQUEST["identificador"];




                }else{
                    header("Location:iniciar-sesion.php?contraseñaIncorrecta=true;");           //si la contraseña no es " a " me manda inicio-sesion.php
                    $contraseñaIncorrecta=true;

                }
            }else{
                header("Location:iniciar-sesion.php?contraseñaIncorrecta=true;");           //si no viene contraseña me manda inicio-sesion.php
                $contraseñaIncorrecta=true;
            }
        }else{
            header("Location:iniciar-sesion.php?usuarioVacio=true;");           //si no viene usuario " a " me manda inicio-sesion.php


        }
    }

?>