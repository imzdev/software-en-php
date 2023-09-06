<?php require_once "vistas/parte_superior.php" ?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud de COPE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script> 
</head>
  </head>
<body>

<!-- Añadimos alerta de confirmacion -->
<script>
        function eliminar(){
            var respuesta=confirm("Estas seguro que deses eliminar al usuario?");
            return respuesta
        }
    </script>    

<h1 class="text-center p-3">DATOS PERSONALES</h1>
<?php
include "modelo/conexion.php";
include "controlador/eliminar_cliente.php";
?>
<div class="container-fluid row">
    <form class="col-4" method="POST">
      <?php 
      
      include "controlador/registro_cliente.php";         
      ?>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"></label>
    <input type="hidden" class="form-control" name="id">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Seleccione Usuario</label>
    <select class="form-control" name="id_usuarios">
      <?php
      // Consulta para obtener los roles disponibles
      $sql_roles = $conexion->query("SELECT * FROM usuarios");
      while ($rol = $sql_roles->fetch_object()) {
        echo "<option value='$rol->id'>$rol->usuario</option>";
      }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Rut</label>
    <input type="text" class="form-control" name="rut">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Apellido</label>
    <input type="text" class="form-control" name="apellido">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Direccion</label>
    <input type="text" class="form-control" name="direccion">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Telefono</label>
    <input type="text" class="form-control" name="telefono">
  </div>
  <button type="submit" class="btn btn-primary" name="btnguardar" value="ok">Guardar</button>
  <a href="admin.php" class="btn btn-small btn-danger">Volver</a>
</form>
<div class="col-8 p-4">
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Usuario</th>
      <th scope="col">Rut</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Correo</th>
      <th scope="col">Direccion</th>
      <th scope="col">Telefono</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "class_login/login.class.php";
    include "modelo/conexion.php";
    $sql = $conexion->query("SELECT cliente.id, usuarios.usuario, cliente.rut, cliente.nombre, cliente.apellido, cliente.email, cliente.direccion, cliente.telefono FROM cliente INNER JOIN usuarios ON cliente.id_usuarios = usuarios.id");
    while($datos=$sql->fetch_object()){

      ?>
    <tr>
      <td><?=$datos->id?></td>
      <td><?=$datos->usuario?></td> <!-- Mostrar el nombre de usuario en lugar de id_usuarios -->
      <td><?=$datos->rut?></td>
      <td><?=$datos->nombre?></td>
      <td><?=$datos->apellido?></td>
      <td><?=$datos->email?></td>
      <td><?=$datos->direccion?></td>
      <td><?=$datos->telefono?></td>
      <td>
        <a href="modificar_cliente.php?id=<?=$datos->id?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
        <a onclick="return eliminar()" href="cliente.php?id=<?=$datos->id?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
      </td>     
    </tr>

    <?php }
    ?>
  </tbody>
</table>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>    
</body>
</html>

<!-- FIN DEL CONTENIDO PRINCIPAL  -->
<?php require_once "vistas/parte_inferior.php" ?>