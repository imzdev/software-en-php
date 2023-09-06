<?php
include "modelo/conexion.php";
include "controlador/eliminar_usuario.php";

// Obtener los pedidos de la base de datos
$sql_pedidos = $conexion->query("SELECT cliente.rut, cliente.nombre, cliente.apellido, pedidos.dia_creacion, pedidos.kg_hallulla, pedidos.kg_marraqueta FROM pedidos INNER JOIN cliente ON pedidos.id_clientes = cliente.id");
?>
<?php
// Manejo de las acciones de los botones
if (isset($_POST['visualizar_pedidos'])) {
    visualizarPedidos();
} elseif (isset($_POST['convertir_a_pdf'])) {
    generarPDF();
}
function visualizarPedidos()
{
    // Obtener los datos de la base de datos
    include "modelo/conexion.php";
    $sql_pedidos = $conexion->query("SELECT cliente.rut, cliente.nombre, cliente.apellido, pedidos.dia_creacion, pedidos.kg_hallulla, pedidos.kg_marraqueta FROM pedidos INNER JOIN cliente ON pedidos.id_clientes = cliente.id");

    // Imprimir los pedidos en una tabla HTML
    // Lógica para visualizar los pedidos
    echo '<div class="alert alert-success">Visualizando los pedidos...</div>';
    echo '<div class="col-8 p-4">';
    echo '<table class="table table-hover table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nombre</th>';
    echo '<th>Apellido</th>';
    echo '<th>Fecha del Pedido</th>';
    echo '<th>Hallulla (Kg)</th>';
    echo '<th>Marraqueta (Kg)</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Recorrer los resultados y agregar los datos a la tabla
    while ($pedido = $sql_pedidos->fetch_object()) {
        echo '<tr>';
        echo '<td>' . $pedido->rut . '</td>';
        echo '<td>' . $pedido->nombre . '</td>';
        echo '<td>' . $pedido->apellido . '</td>';
        echo '<td>' . $pedido->dia_creacion . '</td>';
        echo '<td>' . $pedido->kg_hallulla . '</td>';
        echo '<td>' . $pedido->kg_marraqueta . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Liberar los resultados
    $sql_pedidos->close();

    // Cerrar la conexión a la base de datos
    $conexion->close();
}

function generarPDF()
{
    require('fpdf/fpdf.php');

    // Crear una clase personalizada que herede de FPDF
    class PDF extends FPDF {
        // Cabecera de página
        function Header() {
            // Logo o imagen de encabezado si lo deseas
            $this->Image('img/icon-cope.png', 10, 10, 25);     
            // Encabezado personalizado
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Lista de Pedidos', 0, 1, 'C');
            $this->Ln(10);   
            // Tabla de encabezado
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(30, 10, 'Nombre', 1, 0, 'C');
            $this->Cell(40, 10, 'Rut', 1, 0, 'C');
            $this->Cell(40, 10, 'Dia de Creacion', 1, 0, 'C');
            $this->Cell(40, 10, 'Kg Hallulla', 1, 0, 'C');
            $this->Cell(40, 10, 'Kg Marraqueta', 1, 1, 'C');
        }    
        // Pie de página
        function Footer() {
            // Posición a 1.5 cm del final
            $this->SetY(-15);
            // Fuente Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Número de página
            $this->Cell(0, 10, 'Panaderia COPE', 0, 0, 'C');
        }
    }
    // Crear un nuevo objeto PDF
    $pdf = new PDF();

    // Agregar una página
    $pdf->AddPage();

    // Establecer la fuente y el tamaño del texto
    $pdf->SetFont('Arial', '', 10);

    // Obtener los datos de la base de datos
    include "modelo/conexion.php";
    $sql_pedidos = $conexion->query("SELECT cliente.nombre, cliente.rut, pedidos.dia_creacion, pedidos.kg_hallulla, pedidos.kg_marraqueta FROM pedidos INNER JOIN cliente ON pedidos.id_clientes = cliente.id");

    // Recorrer los resultados y agregar los datos a la tabla
    while ($row = $sql_pedidos->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['nombre'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['rut'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['dia_creacion'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['kg_hallulla'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['kg_marraqueta'], 1, 1, 'C');
    }

    // Cerrar el PDF y generar la salida
    $pdf->Output('pedidos_cope.pdf', 'D');
    echo "Generando el PDF de los pedidos...";
}
?>

<?php require_once "vistas/parte_superior.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar y Convertir a PDF</title>
     <!-- CSS ONLY -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script> 
</head>

<body>
    <h1 class="text-center mt-3">PEDIDOS REGISTRADOS</h1>


        <!-- Tabla con los pedidos -->
        <div class="col-8 p-4">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Rut</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha del Pedido</th>
                <th>Hallulla (Kg)</th>
                <th>Marraqueta (Kg)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pedido = $sql_pedidos->fetch_object()) : ?>
                <tr>
                    <td><?php echo $pedido->rut; ?></td>
                    <td><?php echo $pedido->nombre; ?></td>
                    <td><?php echo $pedido->apellido; ?></td>
                    <td><?php echo $pedido->dia_creacion; ?></td>
                    <td><?php echo $pedido->kg_hallulla; ?></td>
                    <td><?php echo $pedido->kg_marraqueta; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    <!-- Formulario con los botones -->
    <form method="POST">
    <div class="col-8 p-4">
        <!-- BOTON PARA VISUALIZAR LOS PEDIDOS -->
         <!-- <button type="submit" name="visualizar_pedidos">Visualizar Pedidos</button>-->
        <button type="submit" class="btn btn-sm btn-success float-alert" name="convertir_a_pdf">Convertir Pedido a PDF</button>
        <a href="admin.php" class="btn btn-sm btn-danger float-alert"><i class="fa-solid fa-rotate-left"></i> Volver</a>
        <div class="col-8 p-4">
        
        </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>    
</body>
</html>
<!-- FIN DEL CONTENIDO PRINCIPAL  -->
<?php require_once "vistas/parte_inferior.php"?>