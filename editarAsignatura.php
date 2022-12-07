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


if(!empty($_GET['id'])){

  $id = $_GET['id'];

  $materias = "SELECT idasignaturas, codigoasignatura,
    nombreasignatura, nota
    FROM asignaturas
    WHERE idasignaturas = $id";

  $resultadoMaterias = $conexion->query($materias);

  $materia = $resultadoMaterias->fetch_assoc();
  
  if ($materia === null) {
      echo "<script>
        alert('No existe id');
        window.location = 'index.php';
        </script>";
      exit();
  }

}else{
      echo "<script>
        alert('No existe id');
        window.location = 'index.php';
        </script>";
      exit();
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

  <h3 align = "center">Editar de Asignatura</h3>
  <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
  codigo: <input type ="text" name="cod" value="<?php echo $materia['codigoasignatura'];?>"required>
    Asignatura: <input type="text" name="nom" value="<?php echo $materia['nombreasignatura'];?>" required>
    Nota: <input type="number" name="nota" value="<?php echo $materia['nota'];?>" required>
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="submit" name="guardar" value="Guardar">
  </form>

<?php
if(isset($_POST['guardar'])){
  $cod = $_POST["cod"];
  $materia = $_POST["nom"];
  $nota = $_POST["nota"];
  $sqlModificar = "UPDATE asignaturas SET codigoasignatura = '$cod',
    nombreasignatura = '$materia',
    nota = '$nota'
    WHERE idasignaturas = '$id'";
  $modificado = $conexion->query($sqlModificar);

  if($modificado>0){
    echo "<script>
    alert('Registro Modificado Exitosamente');
    window.location = 'index.php';
    </script>";
  }else{
    echo "<script>
    alert('Error al modificar');
    window.location = 'editarAsignatura.php';
    </script>";
  }
}
$conexion->close();

?>

    </main>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery-3.6.1.slim.min.js"></script>

  </body>
</html>
