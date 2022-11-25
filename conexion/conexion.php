<?php
include_once 'configuracion.php';
$conexion = new mysqli($servidor, $usuario, $clave, $bd);
if (mysqli_connect_error()){ 
  echo "No conectado ", mysqli_connect_error();
  exit(); 
}
/* else{ */
/*   echo "Conectado a la bd"; */
/* } */
?>


