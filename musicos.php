<?php

session_start();
if (!isset($_SESSION["nombre"])) {
  header('Location:home.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="copia.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Musicos</title>

  <!--hojas de estilo del navbar-->

  <link rel="stylesheet" href="Cssn/menu-overlay.css">
  <link rel="stylesheet" href="Cssn/scrollbar.css">

  <!-- hoja de estilo local-->
  <link href="Cssn/musicos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
          <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
    <span class="menuicon" id="toggle" onclick="menuToggle()"></span>


    <div id="videoDiv">
      <div class="logo">
        <a href="index.php">iPromoter</a>
      </div>

      <video id="video" autoplay muted loop>
        <source src="imagenes/musicos.mp4" type="video/webm">
      </video>
      <div class="content" data-aos="fade-up">

        <h1>Músicos</h1>


      </div>
    </div>



    <?php
    include("conexion.php");
    $query = "SELECT  Per.Foto , Art.alias , Art.idArtista
                FROM perfil Per INNER JOIN  artista Art 
                ON Per.idArtista = Art.idArtista ";

    $resultado = mysqli_query($conexion, $query);

    while ($mostrar = mysqli_fetch_array($resultado)) {

    ?>


      <div class="caja1" data-aos="fade-up" data-aos-duration="4000">
        <p><?php echo $mostrar['alias'] ?></p>
        <a href="art.php?id=<?php echo $mostrar['idArtista'] ?>"> 
        <img class="imagen" src="data:image/jpg;base64,<?php echo base64_encode($mostrar["Foto"]); ?>" alt="">
        </a>
      </div>





    <?php
    }
    ?>
    </div>

    </div>
  



    <script src="js/menu-overlay.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>


</body>


<script src="js/animacion.js"></script>

</html>