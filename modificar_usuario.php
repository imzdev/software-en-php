<?php
include "modelo/conexion.php";
$id=$_GET["id"];
$sql=$conexion->query("SELECT * usuarios WHERE id=$id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
</head>
<body>
        <form class="col-4 p-3 m-auto" method="POST">
            <h5 class="text-center alert alert-secondary">Registro de Usuarios</h5>
            <input type="hidden" class="form-control"  name="id" value="<?= $_GET["id"]?>">
            <?php
            include "controlador/modificar_usuario.php";
            include "modelo/conexion.php";

            
            // Obtener el ID del usuario deseado
            $id = $_GET["id"];

            // Verificar la conexión a la base de datos
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            $sql = $conexion->query("SELECT * FROM usuarios WHERE id = '$id'");

            // Verificar si la consulta SQL devuelve un resultado válido
            if ($sql === false) {
                die("Error al ejecutar la consulta SQL: " . $conexion->error);
            }

            while ($datos = $sql->fetch_object()) { ?>


                 <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Usuario</label>
                        <input type="text" class="form-control"  name="usuario" value="<?=$datos->usuario?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control"  name="contraseña" value="<?=$datos->contraseña?>">
                </div>

            <?php }

            ?>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-sm btn-primary" name="btn_registrar" value="ok">Modificar</button>
                <a href="admin.php" class="btn btn-sm btn-danger">Volver</a>
            </div>
                    
        </form>
</body>
</html>