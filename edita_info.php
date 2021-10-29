<?php
session_start();
    include("conexion.php"); 
    //Variable global $_POST

    if(   isset($_POST["nombre"]) && isset($_POST["apellidoPa"]) && isset($_POST["apellidoMa"]) && isset($_POST["correo"])){
        
        //Una vez validadas las variables globales , es decir, que existen, se procede a leer su contenido.
        $Id = $_SESSION["idUsuario"];
        $nombre = $_POST['nombre'];
        $apellidop = $_POST['apellidoPa'];
        $apellidom = $_POST['apellidoMa'];
        $correo = $_POST['correo'];
        
        
       
        echo $Id . ", ";
        echo $nombre . ", ";
        echo $apellidop . ", ";
        echo $apellidom . ", ";
        echo $correo . ", ";
        
    
        //Guardar los datos en la base de datos, utilizando sql.
        $query = "UPDATE  usuario SET nombre = '$nombre', apellidoPaterno = '$apellidop', apellidoMaterno = '$apellidom',  correo = '$correo'  WHERE idUsuario = '$Id'";
         
        

        if(!$resultado = mysqli_query($conexion,$query)){
            exit(mysqli_error($conexion));
        }
      
        echo"<script> alert('la edicion  de tus datos se ha concluido de manera exitosa');</script>";
        header("location:close.php");
        exit;
      
     
        
    }else{
        echo "hubo un error al intentar leer los datos";
   

    }
