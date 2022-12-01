<a class="navbar-brand" href="#">Mis Asignaturas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <a href="registroUsuario.php" class="btn btn-primary me-2" role="button">Registrarse</a>
        <input class="form-control me-2" type="text" placeholder="Usuario" name="usuario" aria-label="user">
        <input class="form-control me-2" type="text" placeholder="Password" name="clave" aria-label="clave">
        <button class="btn btn-success" type="submit" name="ingresar">Login</button>
      </form>
    </div>

