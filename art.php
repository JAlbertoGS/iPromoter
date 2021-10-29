<?php

session_start();
if (!isset($_SESSION["nombre"])) {
    header('Location:home.html');
}
?>
<?php
include("conexion.php");
//obtengo el id del artista por medio del boton 
$idArtista = $_GET['id'];

$query = "SELECT Per.informacion, Per.Foto , Art.alias,
            Red.Facebook , Red.Youtube , Red.Instagram, Red.Soundcloud, Red.Spotify
            FROM perfil Per 
            INNER JOIN  artista Art ON Per.idArtista = Art.idArtista 
            INNER JOIN redessociales Red ON Per.idRedSocial = Red.idRedSocial
            WHERE Per.idArtista = '$idArtista'";

$resultado = mysqli_query($conexion, $query);

if (!$resultado = mysqli_query($conexion, $query)) {
    exit(mysqli_error($conexion));
}

if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);

    $perfil["info"] = $fila["informacion"];
    $perfil["foto"] = $fila["Foto"];
    $perfil["alias"] = $fila["alias"];
    $perfil["fb"] = $fila["Facebook"];
    $perfil["ig"] = $fila["Instagram"];
    $perfil["sc"] = $fila["Soundcloud"];
    $perfil["yt"] = $fila["Youtube"];
    $perfil["spotiUno"] = $fila["Spotify"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="copia.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $perfil['alias'] ?></title>

    <link rel="stylesheet" href="Cssn/menu-overlay.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="artista.css">
    <link rel="stylesheet" href="Cssn/scrollbar.css">
    <link rel="stylesheet" href="Cssn/preloader.css">
</head>

<body>


    <section class="main">
        <div class="fullpageMenu" id="nav">
            <div class="nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="destacados.php">Destacados</a></li>
                    <li><a href="buscar.php">Buscar</a></li>
                    <li><a href="musicos.php">Musicos</a></li>
                    <li><a href="perfil_usu.php">perfil</a></li>
                    <li> <?php
                            error_reporting(0);
                            include("conexion.php");

                            $id2 = $_SESSION['idUsuario'];
                            $query2 = "SELECT idUsuario from artista where idUsuario='$id2'";
                            $result = mysqli_query($conexion, $query2);

                            if (mysqli_num_rows($result) > 0) {
                                // si la mamada existe, has lo que quieras que haga
                                echo '<a href="editArtista.php" class="dropdown-item">Perfil de artista</a>';
                            } else {
                                echo '<a href="formArtista.php" class="dropdown-item">Se artista!</a>';
                            }

                            ?></li>
                    <?php
                    if (!isset($_SESSION["nombre"])) {
                        echo ' <li><a href="home.html">Inicia sesión</a></li>';
                    } else {
                        echo ' <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>';
                    }
                    ?>

                </ul>
            </div>
        </div>
        <span class="menuicon" id="toggle" onclick="menuToggle()"></span>

        <!--preloader
        <div class="preloader" data-scroll data-scroll-speed="3">
            <div class="counter">0</div>
        </div>
        -->
        <div class="imagen">
            <img class="foto" src="data:image/jpg;base64,<?php echo base64_encode($perfil["foto"]); ?>" ">
        </div>
        <div class=" principal">
            <h1><?php echo $perfil['alias'] ?> </h1>
        </div>



        <div class="informacion">
            <div class="inf">
                <h1><?php echo $perfil['info'] ?></h1>
            </div>
        </div>



        <div class="streaming">
            <h1>Spotify</h1>
            <div class="meet">

                <?php
                $nombre = $perfil["spotiUno"];
                $a = explode(".com", $nombre);
                $nombre = $a[0] . ".com/embed" . $a[1];
                ?>
                <iframe class="spoty" src="<?php echo $nombre ?>" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </div>

        </div>


        <div class="yt">
            <h1>Youtube</h1>
            <div class="ytembed">
                <?php
                $video = $perfil["yt"];
                $b = explode("/watch?v=", $video);
                $video = $b[0] . "/embed/" . $b[1];
                ?>
                <iframe class="videoyt" src="<?php echo $video ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <div class="redes">
            <ul>
                <li>
                    <a href="<?php echo $perfil['fb'] ?>">Facebook</a>
                </li>
                <li>
                    <a href="<?php echo $perfil['ig'] ?>">Instagram</a>
                </li>
                <li>
                    <a href="<?php echo $perfil['sc'] ?>">SoundCloud</a>
                </li>
            </ul>
        </div>


        <div class="fourth">
            <div class="recuadro" id="primero">
            <div class="tittle" style="color: #E1E8EF;">
                    <h1>Deja una calificacion </h1>
                </div>
                <div class="estrellas">
                    <form  class="form" action="estrellas.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $idArtista ?>">
                            <input id="radio1" type="radio" name="estrellas" value="5">
                            <label for="radio1">★</label>
                            <input id="radio2" type="radio" name="estrellas" value="4">
                            <label for="radio2">★</label>
                            <input id="radio3" type="radio" name="estrellas" value="3">
                            <label for="radio3">★</label>
                            <input id="radio4" type="radio" name="estrellas" value="2">
                            <label for="radio4">★</label>
                            <input id="radio5" type="radio" name="estrellas" value="1">
                            <label for="radio5">★</label>
                            <button class="btne" type="submit">calificar</button>

                         
                    </form>
                </div>
            </div>

            <div class="recuadro" id="segundo">
                <div class="tittle">
                    <h1>Deja un comentario </h1>
                </div>
                <div id="fb-root" style="background-color: transparent; ">
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="Myfzv9J5"></script>
                    <div class="fb-comments" s data-href="http://localhost/proyect/singin.html?<?php echo $idArtista ?>" data-width="100%" data-numposts="5"></div>
                </div>
            </div>
        </div>




    </section>
    <script src="js/preloader.js"></script>
    <script src="js/menu-overlay.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>

</html>