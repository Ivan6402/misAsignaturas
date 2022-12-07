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

if(isset($_POST['editar'])){
  $nombreAlumno = $_POST["nombreAlumno"];
  $usuario = $_POST["usuario"];
  $telefono = $_POST["telefono"];
  $correo = $_POST["correo"];
  $sexo = $_POST["sexo"];
  $id = $_POST["id"];

  if (isset($_POST['clave']) == '') {
    $clave = $fila['clave'];
  }else{
    $clave = sha1($_POST["clave"]);
  }
  
  $sqlModificar = "UPDATE usuarios AS u INNER JOIN alumno AS a ON u.idAlumno = a.idAlumno
    SET u.nombre='$usuario',
        u.clave ='$clave',
        a.nombre = '$nombreAlumno',
        a.telefono = '$telefono',
        a.sexo = '$sexo',
        a.correo = '$correo'
    WHERE u.idUsuario = $id";
  $modificado = $conexion->query($sqlModificar);

  if($modificado>0){
    echo "<script>
    alert('Registro Modificado Exitosamente');
    window.location = 'perfil.php';
    </script>";
  }else{
    echo "<script>
    alert('Error al modificar');
    window.location = 'perfil.php';
    </script>";
  }
}

$sql = "SELECT u.idUsuario, u.nombre AS usuario, u.clave, a.nombre, a.telefono, a.correo, a.sexo 
  FROM usuarios as u INNER JOIN alumno AS a ON u.idAlumno = a.idAlumno
  WHERE u.idUsuario = '$idUsuario'";
$resultado = $conexion->query($sql);

$fila = $resultado->fetch_assoc();

if ($fila == 0) {
  echo "<script>Alert('Error al buscar usuario')</script>";
  echo mysqli_error($conexion);
  die();
}

$conexion->close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil de usuario</title>
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

<h3 align = "center">Perfil de Usuario</h3>
<hr>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNombre">Nombre del Alumno:</label>
      <input type="text" class="form-control" id="inputNombre" name="nombreAlumno" value="<?php echo $fila['nombre'];?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputUsuario">Usuario:</label>
      <input type="text" class="form-control" id="inputUsuario" name="usuario" value="<?php echo $fila['usuario'];?>">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputTelefono">Telefono:</label>
      <input type="tel" class="form-control" id="inputTelefono" name="telefono" value="<?php echo $fila['telefono'];?>">
   </div>
    <div class="form-group col-md-6">
     <label for="sexo">Sexo:</label>
        <select class="form-control" id="sexo" name="sexo">
          <option value="Masculino"<?php echo $fila['sexo'] == 'Masculino' ? ' selected="selected"' : '';?>>Masculino</option>
          <option value="Femenino"<?php echo $fila['sexo'] == 'Femenino' ? ' selected="selected"' : '';?>>Femenino</option>
        </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="correo" value="<?php echo $fila['correo'];?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="clave">
    </div>
  <br>
  <input type="hidden" name="id" value="<?php echo $idUsuario;?>">
  <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>

</form>
</main>

<script src="js/bootstrap.bundle.js"></script>
<script src="js/jquery-3.6.1.slim.min.js"></script>

</body>
</html>
