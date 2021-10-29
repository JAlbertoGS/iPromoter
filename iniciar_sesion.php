<?php

session_start();
include("conexion.php"); 

    if(isset($_POST["Correo"]) && isset($_POST["Contraseña"])){
        $correo = $_POST["Correo"];
        $contraseña = sha1($_POST["Contraseña"]);
        
        
        $query = "SELECT * FROM usuario WHERE correo = '$correo' 
            AND contraseña ='$contraseña' ";

        //echo $query;
        
        if(!$resultado = mysqli_query($conexion,$query)){
            exit(mysqli_error($conexion));
        }
        
        if(mysqli_num_rows($resultado)>0){
            $fila = mysqli_fetch_assoc($resultado);
            
            $_SESSION["idUsuario"]=$fila["idUsuario"];
            $_SESSION["nombre"]= $fila["nombre"];
            $_SESSION["apellidoPaterno"]=$fila["apellidoPaterno"];
            $_SESSION["apellidoMaterno"]= $fila["apellidoMaterno"];
            $_SESSION["correo"]= $fila["correo"];
            $_SESSION["telefono"]= $fila["telefono"];
            $_SESSION["contraseña"]= $fila["contraseña"];

            header("location:index.php");
        }else{
            echo '<script type="text/javascript">
            alert("Credenciales invadilas o incorrectas, intenta de  nuevo");
            window.location.assign("singin.html");
            </script>';
        }


    }

?>