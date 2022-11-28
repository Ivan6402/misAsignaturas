<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Top navbar example · Bootstrap v5.2</title>

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
    <h1>Sistema de usuarios</h1>
    <p class="lead">Ingrese usuario para empezar</p>
    <a class="btn btn-lg btn-primary" href="#" role="button">Mas informacion ></a>
  </div>
</main>


    <script src="js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="script.js"></script>
      
  </body>
</html>

