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
  <title>Busca a un artista </title>

  <!-- hoja de estilo local-->

  <link rel="stylesheet" href="Cssn/menu-overlay.css">
  <link rel="stylesheet" href="Cssn/scrollbar.css">
  <link href="Cssn/busqueda.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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




    <!---CUERPO DE LA PAGINA-->

    <div class="cuadro">

      <form class="search-box" method="post">
        <input class="search-text" type="text" name="alias" placeholder="alias"">
                      <button type=" submit" class="search-btn" name="submit">
        <img src="https://img.icons8.com/ios-glyphs/30/000000/search--v1.png" />
        </button>
      </form>

    </div>


    <?php
    include("conexion.php");


    if (isset($_POST['submit'])) {


      $name = $_POST['alias'];



      $query = "SELECT  Per.Foto , Art.alias , Art.idArtista
      FROM perfil Per INNER JOIN  artista Art 
      ON Per.idArtista = Art.idArtista 
      WHERE Art.alias LIKE '%$name%'";

      if (!$resultado = mysqli_query($conexion, $query)) {
        exit(mysqli_error($conexion));
      }

      if (mysqli_num_rows($resultado) == 0) {
        echo '<p class="errorr" style="text-align: center;  color: white;">
                     Lo sentimos, no encontramos nada parecido :(
                   </p>';
      } else {
        echo '<p class="scrolldown" >Scrollea hacia abajo </p>
                    <span class="bawah-arrow scroll-to">
                      <span class="flecha">
                        <img class="flecha" src="imagenes/flecha.png" style="-webkit-filter: invert(100%);filter: invert(100%); width:30px;" alt="">
                    </span>';
      }

      $resultado = mysqli_query($conexion, $query);

      while ($mostrar = mysqli_fetch_array($resultado)) {


    ?>

        <div class="caja1" data-aos="fade-up" data-aos-duration="4000">
          <a target="_blank" href="artista.php?id=<?php echo $mostrar['idArtista'] ?>">
            <p><?php echo $mostrar['alias'] ?></p>
            <img class="imagen" src="data:image/jpg;base64,<?php echo base64_encode($mostrar["Foto"]); ?>" alt="">


        </div>
    <?php
      }
    } else {
      echo '';
    }



    ?>








  </section>

  <!--animaciones-->
  <script src="js/menu-overlay.js"></script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <!--animaciones-->

</body>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/animacion.js"></script>

</html>