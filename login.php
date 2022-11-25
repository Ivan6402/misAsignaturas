<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Login Crud</title>
  </head>
  <body>
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" accept-charset="utf-8">
      <input type="text" name="user" placeholder="nombreUsuario" value="">
      <input type="password" name="clave" placeholder="clave" value="">
      <input type="submit" name="ingresar" value="ingresar">
      <a href="registroUsuario.php">Crear cuenta</a>
    </form>
  </body>
</html>
