<?php require_once "vista_usuario/superior.php" ?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>
    <title>Pedidos</title>
</head>

<body>
    <script>
        function eliminar() {
            var respuesta = confirm("¿Estás seguro de eliminar?");
            return respuesta;
        }
    </script>
    <h1 class="text-center p-3">MIS PEDIDOS</h1>

    <?php
    include "modelo/conexion.php";
    include "controlador/eliminar_pedido.php";
    include "controlador/registro_pedido.php";
    ?>

    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center text-secondary">Ingresar Pedido</h3>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"></label>
                <input type="hidden" class="form-control" name="id">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <select type="hidden" class="form-select" name="id_clientes">
                <?php
                // Consulta para obtener los datos del usuario específico
                $sql_usuario = $conexion->prepare("SELECT cliente.id FROM cliente INNER JOIN pedidos ON cliente.id = pedidos.id_clientes WHERE cliente.id = ?");
                $usuario_id = 4; // Reemplaza 3 con el ID del usuario específico que deseas mostrar
                $sql_usuario->bind_param("i", $usuario_id); // "i" indica que el parámetro es un entero
                $sql_usuario->execute();
                $resultado_usuario = $sql_usuario->get_result();

                // Verificar si se encontraron datos del usuario
                if ($usuario = $resultado_usuario->fetch_object()) {
                    // Mostrar el campo "id" del usuario específico
                    echo "<option value='$usuario->id'>Rodrigo</option>";
                } else {
                    echo "<option value=''>No se encontró ningún usuario</option>";
                }
                ?>
                </select>


            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha del pedido</label>
                <input type="date" class="form-control" name="dia_creacion">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cantidad de Hallulla (Kg)</label>
                <input type="number" class="form-control" name="kg_hallulla">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cantidad de Marraqueta (Kg) </label>
                <input type="number" class="form-control" name="kg_marraqueta">
            </div>

            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>              
            <div class="col-8 p-4">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Creacion del Pedido</th>
                            <th scope="col">Hallulla (Kg)</th>
                            <th scope="col">Marraqueta (Kg)</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "modelo/conexion.php";
                        $usuario_id = 4; // Reemplaza 3 con el ID del usuario específico que deseas mostrar

                        $sql = $conexion->prepare("SELECT pedidos.id, cliente.rut, cliente.nombre, cliente.apellido, pedidos.dia_creacion, pedidos.kg_hallulla, pedidos.kg_marraqueta FROM pedidos INNER JOIN cliente ON pedidos.id_clientes = cliente.id WHERE cliente.id = ?");
                        $sql->bind_param("i", $usuario_id); // "i" indica que el parámetro es un entero
                        $sql->execute();
                        $resultado = $sql->get_result();

                        while ($datos = $resultado->fetch_object()) {
                            ?>
                            <tr>
                                <td><?= $datos->dia_creacion ?></td>
                                <td><?= $datos->kg_hallulla ?></td>
                                <td><?= $datos->kg_marraqueta ?></td>
                                <!-- Agrega más columnas de datos si es necesario -->

                                <td>
                                    <div class="container">
                                        <div>
                                            <a onclick="return eliminar()" href="usuario.php?id=<?= $datos->id ?>" class="btn btn-small btn-danger"> <i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>




<!-- FIN DEL CONTENIDO PRINCIPAL  -->
<?php require_once "vista_usuario/inferior.php" ?>