<?php
    //variables para conectar la base de datos 
    $servidor  = "localhost"; //
    $usuario = "root"; 
    $contraseña = "";
    $nombrebdDatos = "ipromoterbd";

    $conexion = new mysqli($servidor,$usuario,$contraseña,$nombrebdDatos);

    //si la conexion es un exito, sel easigna un valor de referencia
    // si no hay conexion el valor de la variable es nula.

    if($conexion->connect_error){
        die("la conexcion a la base de datos ha fallado" . $conexion->connect_error);

    }else{
       
    }
?>