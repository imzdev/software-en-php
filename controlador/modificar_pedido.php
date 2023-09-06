<?php
if(!empty($_POST["btnregistrar"])){
    if(!empty($_POST["kg_hallulla"]) and !empty($_POST["kg_marraqueta"])){
        
        $id = $_POST["id"];
        $kg_hallulla = $_POST["kg_hallulla"];
        $kg_marraqueta = $_POST["kg_marraqueta"];
        $sql = $conexion->query("UPDATE pedidos SET kg_hallulla='$kg_hallulla', kg_marraqueta='$kg_marraqueta' WHERE id=$id");
        
        if ($sql) {
            echo '<div class="alert alert-success">Pedido modificado correctamente.</div>';
            header("Location: pedidos.php");
        } else {
            echo '<div class="alert alert-danger">Error al modificar usuario.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío.</div>';
    }
    }
    ?>