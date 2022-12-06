<?php 
include_once 'conexion/conexion.php';
session_start();
// Comprobar si el usuario se a logeado
if (isset($_SESSION['idUsuario'])) {
  $idUsuario = $_SESSION['idUsuario'];
}else{
  echo "<script>
    alert('No ha iniciado sesion');
    window.location = 'index.php';
    </script>";
}


$sql = "SELECT u.idUsuario, a.nombre FROM usuarios as u INNER JOIN alumno AS a ON u.idAlumno = a.idAlumno
  WHERE u.idUsuario = '$idUsuario'";
$resultado = $conexion->query($sql);

$fila = $resultado->fetch_assoc();

if ($fila == 0) {
  echo "<script>Alert('Error al buscar usuario')</script>";
  echo mysqli_error($conexion);
  die();
}

if(!empty($_POST)){
  $codigo = mysqli_real_escape_string($conexion, $_POST['cod']);
  $asignatura = mysqli_real_escape_string($conexion, $_POST['nom']);
  $nota = mysqli_real_escape_string($conexion, $_POST['nota']);
  $verMaterias = "SELECT idasignaturas, codigoasignatura,
                  nombreasignatura, nota
                 FROM asignaturas
                 WHERE codigoasignatura = '$codigo' AND
                        idAlumno = '$idUsuario'";
  $existeMateria = $conexion->query($verMaterias);
  $filas = $existeMateria->num_rows;
  if ($filas > 0) {
    echo "<script>
      alert('La asignatura ya existe');
      window.location = 'index.php';
      </script>";
  }else{
    $sqlmateria = "INSERT INTO asignaturas(
      codigoasignatura, nombreasignatura,nota, idAlumno)
      VALUES('$codigo', '$asignatura', '$nota', '$idUsuario')";
    $resultadoMateria = $conexion->query($sqlmateria);
    if ($resultadoMateria>0) {
      echo "<script>
        alert('Registro Exitoso');
        window.location = 'index.php';
        </script>";
    }else{
      echo mysqli_error($conexion);
      echo "<script>
        alert('Error al registrar');
        window.location = 'index.php';
        </script>";
    }
  }
}


$materias = "SELECT u.idUsuario, m.idasignaturas, m.codigoasignatura,
                  m.nombreasignatura, m.nota
                 FROM usuarios AS u INNER JOIN asignaturas AS m ON u.idUsuario = m.idAlumno
                WHERE u.idUsuario = $idUsuario";

$resultadoMaterias = $conexion->query($materias);

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

      <h3 align = "center">Registro de Asignaturas</h3>
      <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
        codigo: <input type ="text" name="cod" placeholder="CD101" required>
        Asignatura: <input type="text" name="nom" placeholder="Programacion" required>
        Nota: <input type="number" name="nota" placeholder="99" required>
        <input type="submit" name="guardar" value="Guardar">
      </form>
      <hr>
      <h4 align="center">**** Mis Asignaturas ****</h4>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Asignatura</th>
            <th>Nota</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            while($regMaterias = $resultadoMaterias->fetch_array(MYSQLI_BOTH)){
              echo "<tr>
                        <td>".$regMaterias['codigoasignatura']."</td>
                        <td>".$regMaterias['nombreasignatura']."</td>
                        <td>".$regMaterias['nota']."</td>
                        <td><a href='editarAsignatura.php?id=".$regMaterias['idasignaturas']."'>Editar</td>
                        <td><a href='eliminarAsignatura.php?id=".$regMaterias['idasignaturas']."'>Eliminar</td>
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
