<?php

session_start();
if (!isset($_SESSION["nombre"])) {
  header('Location:home.html');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>iPromoter "Crea, conoce y triunfa "</title>
  <link rel="shortcut icon" type="image/x-icon" href="copia.ico">

  <!--hojas de estilo del navbar-->

  <link rel="stylesheet" href="Cssn/menu-overlay.css">
  <link href="Cssn/perfil_usu.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<style>
  body {
    
    overflow-x: hidden;


  }



  h1 {
    font-size: 10vw;
  }

  h2 {
    font-size: 5vw;
  }
</style>

<body>
  <!-- barra de navegación -->

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



    <h1 class="titulo" data-aos="fade-down">Perfil</h1>


    <div class="contenedor">
      
      <div class="informacion">
        <p><?php echo $_SESSION["nombre"] ?></p>
      </div>
      <div class="informacion">
        <p><?php echo $_SESSION["apellidoPaterno"] ?> <?php echo $_SESSION["apellidoMaterno"] ?></p>
      </div>

      <div class="informacion">
        <p class="email"><?php echo $_SESSION["correo"] ?></p>
      </div>
      <div class="informacion">
      <a class="button" href="edita_usu.php">Editar</a>
      </div>


    <!--animaciones-->
    <script src="js/menu-overlay.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!--animaciones-->

</body>
<script src="js/animacion.js"></script>

</html>