
<?php
session_start();

include("conexion.php");


//Variable global $_POST

if (isset($_POST["id"]) && isset($_POST["alias"]) && isset($_POST["informacion"]) && isset($_POST["video"]) && isset($_POST["face"]) && isset($_POST["insta"]) && isset($_POST["sound"]) && isset($_POST["rolaUno"]) && isset($_FILES["imagen"])) {

    //Una vez validadas las variables globales , es decir, que existen, se procede a leer su contenido.
    $id = $_POST['id'];
    $alias = $_POST['alias'];
    $info = $_POST['informacion'];
    $video = $_POST['video'];
    $face = $_POST['face'];
    $insta = $_POST['insta'];
    $sound = $_POST['sound'];
    $spotify = $_POST['rolaUno'];
    $foto = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));




    //Guardar los datos en la base de datos, utilizando sql.
    $query1 = "UPDATE  artista SET  alias='$alias' WHERE idUsuario='$id'";
    $resultado1 = mysqli_query($conexion, $query1);

    $query3 = "SELECT idArtista FROM artista WHERE idArtista='$id'";
    $resultado3 = mysqli_query($conexion, $query3);

    if (!$resultado3 = mysqli_query($conexion, $query3)) {
        exit(mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado3) > 0) {
        $fila = mysqli_fetch_assoc($resultado3);

        $idd = $fila["idArtista"];
    }


    $query2 = "UPDATE  perfil SET  informacion='$info', foto='$foto' WHERE idArtista='$idd'";
    $resultado2 = mysqli_query($conexion, $query2);

    $query4 = "SELECT idPerfil FROM perfil WHERE idPerfil='$id'";
    $resultado4 = mysqli_query($conexion, $query4);

    if (!$resultado4 = mysqli_query($conexion, $query4)) {
        exit(mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado4) > 0) {
        $fila2 = mysqli_fetch_assoc($resultado4);

        $id2 = $fila2["idPerfil"];
    }


    

    $query6 = "UPDATE  redessociales SET  Facebook='$face', Youtube='$video', Instagram='$insta', Soundcloud='$sound', Spotify='$spotify' WHERE idPerfil='$id2'";
    $resultado6 = mysqli_query($conexion, $query6);



    if (!$resultado1  || !$resultado3  || !$resultado2  || !$resultado4  || !$resultado6) {
        exit(mysqli_error($conexion));
    }

    echo '<script type="text/javascript">
        alert("Tu edicion se completó de manera exitosa");
        window.location.assign("musicos.php");
        </script>';
} else {
    echo '<script type="text/javascript">
        alert("Hubo un error al intentar editar,intenta de nuevo");
        window.location.assign("login_artista.php");
        </script>';
}
