<?php 
include_once 'conexion/conexion.php';
session_start();
// Comprobar si el usuario se a logeado
if (isset($_SESSION['idUsuario']) AND $_SESSION['tipoUsuario'] == 1) {
  $idUsuario = $_SESSION['idUsuario'];
}else{
  echo "<script>
    alert('No es administrador');
    window.location = 'admin.php';
    </script>";
}


$alumnos = "SELECT u.idUsuario, a.nombre AS nombreA, a.correo, u.nombre AS nombreU
            FROM usuarios as u INNER JOIN alumno AS a ON u.idAlumno = a.idAlumno";

$resultadoAlumnos = $conexion->query($alumnos);

$sql = "SELECT u.idUsuario, a.nombre FROM usuarios as u INNER JOIN alumno AS a ON u.idAlumno = a.idAlumno
  WHERE u.idUsuario = '$idUsuario'";
$resultado = $conexion->query($sql);

$fila = $resultado->fetch_assoc();

if ($fila == 0) {
  echo "<script>Alert('Error al buscar usuario')</script>";
  echo mysqli_error($conexion);
  die();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administracion</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div class="container-fluid">
        <?php require_once 'menuAdmin.php';?>
      </div>
    </nav>

    <main class="container">

<?php echo "ID de usuario: ", $_SESSION['idUsuario']; 
      echo "<br>";
      $tipo = $_SESSION['tipoUsuario'] == 1 ? 'admin' : 'alumno';
      echo "Tipo de usuario: ", $tipo; 
?>

      <h4 align="center">**** Lista de Usuarios ****</h4>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Nombre Completo</th>
            <th>Usuarios</th>
            <th>Nota</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            while($regAlumnos = $resultadoAlumnos->fetch_array(MYSQLI_BOTH)){
              echo "<tr>
                        <td>".$regAlumnos['nombreA']."</td>
                        <td>".$regAlumnos['nombreU']."</td>
                        <td>".$regAlumnos['correo']."</td>
                        <td><a href='#?id=".$regAlumnos['idUsuario']."'>Editar</td>
                        <td><a href='#?id=".$regAlumnos['idUsuario']."'>Eliminar</td>
                  </tr>";
            }
            ?>
          </tr>
        </tbody>
      </table>

    </main>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery-3.6.1.slim.min.js"></script>

  </body>
</html>
