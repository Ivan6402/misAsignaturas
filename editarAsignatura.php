<?php 
include_once 'conexion/conexion.php';
if(!empty($_GET['id'])){

  $id = $_GET['id'];

  $materias = "SELECT idasignaturas, codigoasignatura,
    nombreasignatura, nota
    FROM asignaturas
    WHERE idasignaturas = $id";

  $resultadoMaterias = $conexion->query($materias);

  $fila = $resultadoMaterias->fetch_assoc();
  
  if ($fila === null) {
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
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Asignaturas</title>
</head>
<body>
  <h3 align = "center">Editar de Asignatura</h3>
  <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
  codigo: <input type ="text" name="cod" value="<?php echo $fila['codigoasignatura'];?>"required>
    Asignatura: <input type="text" name="nom" value="<?php echo $fila['nombreasignatura'];?>" required>
    Nota: <input type="number" name="nota" value="<?php echo $fila['nota'];?>" required>
    <input type="hidden" name="id" value="<? echo $id>">
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

?>




</body>
