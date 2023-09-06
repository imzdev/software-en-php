<?php
include "modelo/conexion.php";
$id=$_GET["id"];
$sql=$conexion->query("SELECT * cliente WHERE id=$id ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<form class="col-4 p-3 m-auto" method="POST">
  <h5 class="text-center alert alert-secondary">Modificar Clientes</h5>
  <?php
            include "controlador/modificar_cliente.php";
            
            include "modelo/conexion.php";

            
            // Obtener el ID del usuario deseado
            $id = $_GET["id"];

            // Verificar la conexión a la base de datos
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            $sql = $conexion->query("SELECT * FROM cliente WHERE id = '$id'");

            // Verificar si la consulta SQL devuelve un resultado válido
            if ($sql === false) {
                die("Error al ejecutar la consulta SQL: " . $conexion->error);
            }

            while ($datos = $sql->fetch_object()) { ?>
        
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">RUT Persona</label>
    <input type="text" class="form-control" name="rut" value="<?=$datos->rut?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="<?=$datos->nombre?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Apellido</label>
    <input type="text" class="form-control" name="apellido" value="<?=$datos->apellido?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
    <input type="email" class="form-control" name="email" value="<?=$datos->email?>
    ">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Direccion</label>
    <input type="text" class="form-control" name="direccion" value="<?=$datos->direccion?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Telefono</label>
    <input type="text" class="form-control" name="telefono" value="<?=$datos->telefono?>">
  </div>
      <?php }    
      ?>
  <div class="text-center mb-3">
    <button type="submit" class="btn btn-sm btn-primary" name="btnguardar" value="ok">Guardar</button>
    <a href="cliente.php" class="btn btn-sm btn-danger">Volver</a>
  </div>
  
</form>
</body>
</html>