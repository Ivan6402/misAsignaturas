<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNombre">Nombre del Alumno</label>
      <input type="text" class="form-control" id="inputNombre" placeholder="nombreCompleto" name="nombreAlumno">
    </div>
    <div class="form-group col-md-6">
      <label for="inputUsuario">Usuario</label>
      <input type="password" class="form-control" id="inputUsuario" placeholder="nombreUsuario" name="usuario" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputTelefono">Telefono:</label>
      <input type="tel" class="form-control" id="inputTelefono" placeholder="Numero de telefono" name="telefono">
   </div>
    <div class="form-group col-md-6">
     <label for="exampleFormControlSelect1">Sexo:</label>
        <select class="form-control" id="sexo" name="sexo">
          <option>Seleccione una opcion</option>
          <option>Masculino</option>
          <option>Femenino</option>
        </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="correo">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="clave">
    </div>
  <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>

</form>
