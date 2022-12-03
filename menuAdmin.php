<a class="navbar-brand" href="#">Mis Asignaturas</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarCollapse">
  <ul class="navbar-nav me-auto mb-2 mb-md-0">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="index.php">Home</a>
    </li>
    <li class="nav-item">
    <a class="nav-link active" href="#"><?php echo utf8_decode($fila['nombre']); ?></a>
    </li>
    <?php if($_SESSION['tipoUsuario'] == 1): ?>
      <li class="nav-item">
        <a class="nav-link" href="listaUsuarios.php">Lista de Usuarios</a>
      </li>
    <?php endif ?>
    <li class="nav-item">
      <a class="nav-link" href="cerrarSesion.php">Cerrar session</a>
    </li>
  </ul>
</div>

