<?php

    include("conexion.php"); 
    session_start();
    //Variable global $_POST

    if(isset($_POST["alias"])&& isset($_POST["informacion"]) && isset($_POST["video"])&& isset($_POST["face"])&& isset($_POST["insta"])&& isset($_POST["sound"])&& isset($_POST["rolaUno"])&& isset($_FILES["imagen"])){
        
        //Una vez validadas las variables globales , es decir, que existen, se procede a leer su contenido.
        $alias = $_POST['alias'];
        $info = $_POST['informacion'];
        $video =$_POST['video'];
        $face = $_POST['face'];
        $insta = $_POST['insta'];
        $sound = $_POST['sound'];
        $spotify = $_POST['rolaUno'];
        $foto = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $id = $_SESSION['idUsuario'];
       
        
        
        //Guardar los datos en la base de datos, utilizando sql.
        $query = "INSERT INTO artista (alias, idUsuario, idCategoria) VALUES ('$alias', '$id', 1)";
        $resultado = mysqli_query($conexion,$query);

        $query3 = "SELECT MAX(idArtista) AS idd FROM artista";
        $resultado3 = mysqli_query($conexion,$query3);
        if ($row = mysqli_fetch_row($resultado3)) {
            $idd = trim($row[0]);
        }

        $query2 = "INSERT INTO perfil (idArtista, informacion, Foto) VALUES ('$idd', '$info', '$foto')";
        $resultado2 = mysqli_query($conexion,$query2);
        
        $query4 = "SELECT MAX(idPerfil) AS id2 FROM perfil";
        $resultado4 = mysqli_query($conexion,$query4);
        if ($row = mysqli_fetch_row($resultado4)) {
            $id2 = trim($row[0]);
        }

        $query5 = "UPDATE artista SET idPerfil = '$id2' WHERE idArtista='$idd'";
        $resultado5 = mysqli_query($conexion,$query5);

        $query6 = "INSERT INTO redessociales (idPerfil, Facebook, Youtube, Instagram, Soundcloud, Spotify) VALUES ('$id2', '$face', '$video', '$insta', '$sound', '$spotify')";
        $resultado6 = mysqli_query($conexion,$query6);

        $query7 = "SELECT MAX(idRedSocial) AS id3 FROM redessociales";
        $resultado7 = mysqli_query($conexion,$query7);
        if ($row = mysqli_fetch_row($resultado7)) {
            $id3 = trim($row[0]);
        }

        $query8 = "UPDATE perfil SET idRedSocial = '$id3' WHERE idPerfil='$id2'";
        $resultado8 = mysqli_query($conexion,$query8);

        if(!$resultado || !$resultado2 || !$resultado3 || !$resultado4 || !$resultado5 || !$resultado6 || !$resultado7 || !$resultado8){
            exit(mysqli_error($conexion));
        }
        
        echo '<script type="text/javascript">
        alert("Tu registro, se completó de manera exitosa");
        window.location.assign("musicos.php");
        </script>';

        

    }else{
        echo '<script type="text/javascript">
        alert("Hubo un error al intentar registrarte,intenta de nuevo");
        window.location.assign("login_artista.php");
        </script>';
    }
?>