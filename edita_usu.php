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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="copia.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicia sesión</title>
  <!--hojas de estilo del navbar-->

  <link rel="stylesheet" href="Cssn/menu-overlay.css">
  <link rel="stylesheet" href="Cssn/edita_usu.css">




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




    <div class="cuadro">
      <h1>Bienvenido,<?php echo $_SESSION["nombre"] ?></h1>
      <p>Ingresa tus datos para tu debida actualizacion</p>


      <form action="edita_info.php" method="post">
        <label for="fname">Nombre(s)</label>
        <input type="text" name="nombre" value="<?php echo $_SESSION["nombre"] ?>" required="required" style="color: white;" pattern="[A-Za-záéíóú ]{1,20}">
        <label for="lname">Apellido Paterno</label>
        <input type="text" name="apellidoPa" value="<?php echo $_SESSION["apellidoPaterno"] ?>" required="required" style="color: white;" pattern="[A-Za-záéíóú]{1,20}">
        <label for="lname">Apellido Materno</label>
        <input type="text" name="apellidoMa" value="<?php echo $_SESSION["apellidoMaterno"] ?>" required="required" style="color: white;" pattern="[A-Za-záéíóú]{1,20}">
        <label for="lname">Correo</label>
        <input type="email" name="correo" value="<?php echo $_SESSION["correo"] ?>" required="required" style="color: white;" >
        <button type="submit">Guardar </button>
      </form>

    </div>


  </section>
  <script src="js/menu-overlay.js"></script>
</body>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</html>