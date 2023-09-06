<?php require_once "vistas/parte_superior.php" ?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud en PHP</title>
    <!-- CSS ONLY -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script> 
</head>
<body>

    <!-- Añadimos alerta de confirmacion -->
    <script>
        function eliminar(){
            var respuesta=confirm("Estas seguro que deses eliminar al usuario?");
            return respuesta
        }
    </script>    


    <h1 class="text-center p-3">ADMINISTRADOR</h1>
    <?php
    include "modelo/conexion.php";
    include "controlador/eliminar_usuario.php";
    ?>

    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center text-secondary">Registro de Usuarios</h3>
            <!-- Llamamos a la conexion y al controlador-->
            <?php
            include "modelo/conexion.php";
            include "controlador/registro_usuario.php";
            ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"></label>
                <input type="hidden" class="form-control" name="id">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                <input type="password" class="form-control"  name="contraseña">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cargo</label>
                <select class="form-control" name="id_rol">
                <?php
                // Consulta para obtener los roles disponibles
                $sql_roles = $conexion->query("SELECT * FROM rol");
                    while ($rol = $sql_roles->fetch_object()) {
                        echo "<option value='$rol->id'>$rol->descripción</option>";
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_registrar" value="OK">Registrar</button>
        </form>
            <div class="col-8 p-4">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col" type="password">Contraseña</th>
                        <th scope="col">Privilegios</th>
                        <th scope="col">Modificar/Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include "modelo/conexion.php";
                        $sql = $conexion->query("SELECT * FROM usuarios");
                        while ($datos = $sql->fetch_object()){
                            $id_rol = $datos->id_rol;
                            $sql_rol = $conexion->query("SELECT descripción FROM rol WHERE id = $id_rol");
                            $descripcion_rol = $sql_rol->fetch_object()->descripción;
                            ?>
                            <tr>
                                <td><?=$datos->id?></td>
                                <td><?=$datos->usuario?></td>
                                <td><?=str_repeat('*', strlen($datos->contraseña))?></td>
                                <td><?=$descripcion_rol?></td>
                                <!-- Implementamos los iconos y le damos un tamano-->
                                <td>
                                    <a href="modificar_usuario.php?id=<?=$datos->id?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a onclick="return eliminar()" href="admin.php?id=<?=$datos->id?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    <!-- JavaScript Bundle Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>



<!-- FIN DEL CONTENIDO PRINCIPAL  -->
<?php require_once "vistas/parte_inferior.php" ?>