<?php
include_once 'conexion/conexion.php';
if(!empty($_GET['id'])){

  $id = $_GET['id'];

  $eliminarAsignatura = "DELETE FROM asignaturas
    WHERE idasignaturas = $id";

  $resultado = $conexion->query($eliminarAsignatura);

  echo "<script>
        alert('Registro Eliminado Exitosamente');
        window.location = 'index.php';
        </script>";
  $conexion->close();

}else{
      echo "<script>
        alert('No existe id');
        window.location = 'index.php';
        </script>";
      exit();
}

?>
