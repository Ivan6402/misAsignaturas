<?php
include_once("conexion/conexion.php");
session_start();
if (isset($_SESSION['idUsuario'])) {
  header("Location: admin.php");
}

if (!empty($_POST)) {
  # Valido el ingreso del usuario
  $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
  $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
  $clave_encriptada = sha1($clave);
  $sql = "SELECT idUsuario, idTipoUsuario FROM usuarios 
    WHERE nombre = '$usuario' AND clave = '$clave_encriptada'";
  $resultado = $conexion->query($sql);
  $filas = $resultado->num_rows;
  if ($filas>0) {
    $fila = $resultado->fetch_assoc();
    $_SESSION['idUsuario'] = $fila['idUsuario'];
    $_SESSION['tipoUsuario'] = $fila['idTipoUsuario'];
    header("Location: admin.php");
  }else{
    echo "<script> alert('El usuario o contraseña son incorrectos');
      window.location='index.php';
      </script>";
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de usuarios</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="navbar-top.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
      
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
      <?php require_once 'menuIndex.php';?>
      </div>
    </nav>

    <main class="container">
      <div class="bg-light p-5 rounded">
        <h1>Sistema de usuarios</h1>
      </div>
    </main>

    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>

  </body>
</html>

