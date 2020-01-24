<?php

session_start();


$haySesion= isset($_SESSION["acumulado"]);      //booleanos
$quiereSumar=isset($_REQUEST["sumar"]);
$quiereRestar=isset($_REQUEST["restar"]);
$quiereResetear=isset($_REQUEST["resetear"]);
$formularioEnviado=$quiereSumar || $quiereRestar;

if(!$haySesion || $quiereResetear ){
    $acumulado=0;                                                    //cuando pasa por primera vez, o cuando se resetea
}else{
    $acumulado=$_SESSION["acumulado"];
}

if(!$formularioEnviado || $quiereResetear){                        //cuando pasa por primera vez, o cuando resetea
    $diferencia=1;
}else{
    $diferencia=$_REQUEST["diferencia"];

    if($quiereSumar){
        $acumulado+=$diferencia;
    }else{
        $acumulado-=$diferencia;
    }
}
$_SESSION["acumulado"]=$acumulado;                               // se vuelve a igualar por que ha sido modificado anteriormente

?>



<html>

<h1><?=$acumulado?></h1>

<form method='GET'>

    <input type='hidden' name='acumulado' value='<?=$acumulado?>'>
    <input type="submit" name="sumar" value="+">
    <input name='diferencia' value='<?=$diferencia?>'>
    <input type="submit" name="resetear" value="reinicia">
    <input type="submit" name="restar" value="-">

</form>
</html>








