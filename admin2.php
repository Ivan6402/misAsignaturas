<?php 
include_once 'conexion/conexion.php';
if(!empty($_POST)){
  $codigo = mysqli_real_escape_string($conexion, $_POST['cod']);
  $asignatura = mysqli_real_escape_string($conexion, $_POST['nom']);
  $nota = mysqli_real_escape_string($conexion, $_POST['nota']);
  $verMaterias = "SELECT idasignaturas, codigoasignatura,
                  nombreasignatura, nota
                 FROM asignaturas
                 WHERE codigoasignaturas = '$codigo' OR
                        nombreasignatura = '$asignatura'";
  $existeMateria = $conexion->query($verMaterias);
  $filas = $existeMateria->num_rows;
  if ($filas > 0) {
    echo "<script>
      alert('La asignatura ya existe');
      window.location = 'index.php';
      </script>";
  }else{
    $sqlmateria = "INSERT INTO asignaturas(
      codigoasignatura, nombreasignatura,nota)
      VALUES('$codigo', '$asignatura', '$nota')";
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


$materias = "SELECT idasignaturas, codigoasignatura,
                  nombreasignatura, nota
                 FROM asignaturas";

$resultadoMaterias = $conexion->query($materias);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Asignaturas</title>
</head>
<body>
  <h3 align = "center">Registro de Asignaturas</h3>
  <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
    codigo: <input type ="text" name="cod" placeholder="CD101" required>
    Asignatura: <input type="text" name="nom" placeholder="Programacion" required>
    Nota: <input type="number" name="nota" placeholder="99" required>
    <input type="submit" name="guardar" value="Guardar">
  </form>
<hr>
<h4 align="center">**** Mis Asignaturas ****</h4>
<table border="1">
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
</body>
