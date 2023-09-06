<?php
include "modelo/conexion.php";

// Obtener cantidad de clientes
$sqlClientes = "SELECT COUNT(*) AS totalClientes FROM cliente";
$resultadoClientes = $conexion->query($sqlClientes);
$rowClientes = $resultadoClientes->fetch_assoc();
$totalClientes = $rowClientes['totalClientes'];

// Buscar clientes
if(isset($_POST['buscar'])){
    $buscar = $_POST['buscar'];
    $sqlBuscar = "SELECT * FROM cliente WHERE nombre LIKE '%$buscar%' OR apellido LIKE '%$buscar%'";
    $resultadoBuscar = $conexion->query($sqlBuscar);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Home</title>

	<!-- Normalize V8.0.1 -->
	<link rel="stylesheet" href="./css/normalize.css">

	<!-- Bootstrap V4.3 -->
	<link rel="stylesheet" href="./css/bootstrap.min.css">

	<!-- Bootstrap Material Design V4.0 -->
	<link rel="stylesheet" href="./css/bootstrap-material-design.min.css">

	<!-- Font Awesome V5.9.0 -->
	<link rel="stylesheet" href="./css/all.css">

	<!-- Sweet Alerts V8.13.0 CSS file -->
	<link rel="stylesheet" href="./css/sweetalert2.min.css">

	<!-- Sweet Alert V8.13.0 JS file-->
	<script src="./js/sweetalert2.min.js" ></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<link rel="stylesheet" href="./css/jquery.mCustomScrollbar.css">
	
	<!-- General Styles -->
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <!-- Resto del código del cuerpo de la página -->

    <!-- Cantidad de clientes -->
    <div class="full-box text-center" style="padding: 30px 10px;">
        <p class="text-uppercase">
            <strong>Total de clientes:</strong> <?php echo $totalClientes; ?>
        </p>
    </div>

    <!-- Buscar clientes -->
    <div class="container-fluid">
        <form class="form-neon" action="" method="POST">
            <input type="text" class="form-control" name="buscar" placeholder="Buscar cliente">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
        </form>
    </div>

    <!-- Resultado de la búsqueda -->
    <div class="container-fluid">
        <?php if(isset($resultadoBuscar) && $resultadoBuscar->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <!-- Agrega más columnas si es necesario -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($cliente = $resultadoBuscar->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $cliente['rut']; ?></td>
                                <td><?php echo $cliente['nombre']; ?></td>
                                <td><?php echo $cliente['apellido']; ?></td>
                                <td><?php echo $cliente['email']; ?></td>
                                <td><?php echo $cliente['direccion']; ?></td>
                                <td><?php echo $cliente['telefono']; ?></td>
                                <!-- Agrega más celdas si es necesario -->
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif(isset($resultadoBuscar) && $resultadoBuscar->num_rows === 0): ?>
            <div class="alert alert-warning text-center">
                No se encontraron clientes.
            </div>
        <?php endif; ?>
    </div>

    <!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<!-- jQuery V3.4.1 -->
	<script src="./js/jquery-3.4.1.min.js" ></script>

    <!-- popper -->
    <script src="./js/popper.min.js" ></script>

    <!-- Bootstrap V4.3 -->
    <script src="./js/bootstrap.min.js" ></script>

    <!-- jQuery Custom Content Scroller V3.1.5 -->
    <script src="./js/jquery.mCustomScrollbar.concat.min.js" ></script>

    <!-- Bootstrap Material Design V4.0 -->
    <script src="./js/bootstrap-material-design.min.js" ></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

    <script src="./js/main.js" ></script>

</body>
</html>
