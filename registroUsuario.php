<?php
include_once("conexion/conexion.php");
$sql = "SELECT idTipoUsuario, tipoUsuario FROM tipousuario";
$resultado = $conexion->query($sql);


if (!empty($_POST)) {
  $nombre = mysqli_real_escape_string($conexion, $_POST['nombreAlumno']);
  $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
  $tipoUsuario = $_POST['tipoUsuario'];
  $sexo = $_POST['sexo'];
  $tel = mysqli_real_escape_string($conexion, $_POST['telefono']);
  $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
  $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
  $clave_encriptada = sha1($clave);

  $sqluser = "SELECT idUsuario FROM usuarios WHERE nombre = '$usuario'";
  $resultadoUser = $conexion->query($sqluser);
  $filas = $resultadoUser->num_rows;

  if ($filas > 0) {
    echo "<script> alert('El usuario ya existe');
      window.location='registroUsuario.php';
      </script>";
  } else {
    $sqlAlumno = "INSERT INTO 
      alumno('nombre', 'telefono','sexo', 'correo') 
      VALUES('$nombre', '$tel', '$sexo','$correo')";
    $resultadoAlumno = $conexion->query($sqlAlumno);
    $idAlumno = $conexion->insert_id;
    
    $sqlUsuario = 
      "INSERT INTO usuarios(nombre, clave,idAlumno,idTipoUsuario) 
      VALUES('$usuario', '$clave_encriptada', '$idAlumno', '$tipoUsuario')";
    $resultadoUser = $conexion->query($sqlUsuario);
    if ($resultadoUser > 0) {
      echo "<script> alert('Registro Exitoso');
        window.location='index.php';
        </script>";
    } else {
      echo "<script> alert('Error al registrar Usuario');
        window.location='registroUsuario.php';
        </script>";
    }

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
      <?php require_once 'menuSuperior.php';?>
      </div>
    </nav>

    <main class="container">
      <div class="bg-light p-5 rounded">
        <h1>Crear cuenta</h1>
          <?php require_once 'formulario.php';?>
      </div>
    </main>


    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
      
  </body>
</html>
