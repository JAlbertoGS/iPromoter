<?php

    include("conexion.php"); 
    //Variable global $_POST

    if(isset($_POST["nombre"]) && isset($_POST["apellidop"]) && isset($_POST["apellidom"]) && isset($_POST["correo"]) && isset($_POST["contraseña"])){
        
        //Una vez validadas las variables globales , es decir, que existen, se procede a leer su contenido.
        $nombre = $_POST['nombre'];
        $apellidop = $_POST['apellidop'];
        $apellidom = $_POST['apellidom'];
        $correo = $_POST['correo'];
        $contraseña =sha1($_POST["contraseña"]);
        
        
        //Guardar los datos en la base de datos, utilizando sql.
        $query = "INSERT INTO usuario (nombre,apellidoPaterno,apellidoMaterno,correo,contraseña)
        VALUES('$nombre','$apellidop','$apellidom','$correo','$contraseña')";

        if(!$resultado = mysqli_query($conexion,$query)){
            exit(mysqli_error($conexion));
        }
        
        echo '<script type="text/javascript">
        alert("Tu registro, se completó de manera exitosa, inicia sesión para continuar!");
        window.location.assign("singin.html");
        </script>';



    }else{
        echo '<script type="text/javascript">
        alert("Hubo un error al intentar registrarte,intenta de nuevo");
        window.location.assign("LoginVisitante.html");
        </script>';
    }
?>