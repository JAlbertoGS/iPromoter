<?php

session_start();
if (!isset($_SESSION["nombre"])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="copia.ico">
  <html lang="es">
  <title>Home</title>

  <!--hojas de estilo -->
  <link rel="stylesheet" href="Cssn/menu-overlay.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="Cssn/index.css">
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
    <!-- el video video -->
    <div id="videoDiv">
      <div class="logo">
        <a href="index.php">iPromoter</a>
      </div>

      <video id="video" autoplay muted loop>
        <source src="imagenes/videoInicio.mp4" type="video/webm">
      </video>
      <div class="content">
        <h1>Crea.</h1>
        <h1>Conoce.</h1>
        <h1>Triunfa.</h1>

      </div>
    </div>


    <!--segunda seccion-->

    <div class="second">

      <div class="container">
        <div id="intro" data-aos="fade-up" data-aos-duration="4000">
          <h1>Somos una organización que está dispuesta a promocionar a los artistas locales</h1>
        </div>
        <div id="info" data-aos="fade-up" data-aos-duration="4000">
          <p>Ipromoter es una pagina web destinada al apoyo a los pequeños artistas que están esta grandiosa profesion,por lo que les brindamos el espacio para poder promocionarse y así mas gente reconozca tu trabajo.</p>
        </div>
      </div>

    </div>


    <!--tercera seccion-->


    <div class="third" data-aos="fade-up" data-aos-duration="4000">
      <div class="center" data-aos="fade-left" data-aos-duration="2000">
        <h1>Crea tu perfil, sube información acerca de ti, sube contenido de las diferentes plataformas de streaming</h1>
      </div>

    </div>



    <div class="fourth">
      <div class="recuadro" id="primero">
        <span class="title">
          <h1>Conecta tus canciones </h1>
        </span>
      </div>
      <div class="recuadro" id="segundo">
        <span class="tittle">
          <h1>Conecta con tus redes </h1>
        </span>
      </div>
    </div>





  </section>





  <script src="js/preloader.js"></script>
  <script src="js/menu-overlay.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


</body>
<script src="js/animacion.js"></script>

</html>