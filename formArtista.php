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

  <!--hojas de estilo del navbar-->
  <link rel="stylesheet" href="Cssn/menu-overlay.css">
  <link rel="stylesheet" href="Cssn/scrollbar.css">

  <link rel="shortcut icon" type="image/x-icon" href="copia.ico">
  <link href="Cssn/formArtista.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />



</head>

<body>

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
            }
            else{
              echo ' <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>';
            }
            ?>   
         
        </ul>
      </div>
    </div>
    <span class="menuicon" id="toggle" onclick="menuToggle()"></span>


  <div class="cuadro">
    <h1>Bienvenido <?php echo $perfil['alias'] ?>!</h1>
    <p>Ingresa tus datos para tu debida actualizacion</p>
  </div>



  <div class="formulario">

    <form enctype="multipart/form-data" action="agregarInfo.php" method="post">
      <label>ingresa tu alias</label>
      <input type="text" name="alias" placeholder="Tu alias" value="<?php echo $perfil['alias'] ?>" required="required" style="color: white;">
      <label>Información</label>
      <textarea maxlength="350" class="form-control" style="background: transparent; color:white; border-color:transparent" name="informacion" placeholder="Ingresa aqui toda tu informacion que será publica en todo momento ('350 caracteres como maximo')" rows="5"> <?php echo $perfil['info'] ?></textarea>
      <label >Video de YouTube</label>
      <input type="text" name="video" laceholder="Link de cancion de youtube" value="<?php echo $perfil['yt'] ?>" required="required" style="color: white;">
      <label>Perfil o pagina de Facebook</label>
      <input type="text" name="face" placeholder="Link de tu Facebook" value="<?php echo $perfil['fb'] ?>" required="required" style="color: white;">
      <label>Perfil o pagina de Instagram</label>
      <input type="text" name="insta" placeholder="Link de tu Instagram" value="<?php echo $perfil['ig'] ?>" required="required" style="color: white;">
      <label>Canción o Albúm de Spotify</label>
      <input type="text" name="rolaUno" placeholder="Link de cancion de spotify"" value=" <?php echo $perfil['spotiUno'] ?>" required="required" style="color: white;">
      <label> Perfil de Soundcloud</label>
      <input type="text" name="sound" placeholder="Link de tu Soundcloud" value="<?php echo $perfil['sc'] ?>" required="required" style="color: white;">
      <label>Selecciona imagen tuya </label>
      <input style="background: transparent; color:white;border-color:white" required="required" type="file" name="imagen" />
      <button type="submit">Guardar </button>
    </form>


  </div>



  <script src="js/menu-overlay.js"></script>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>