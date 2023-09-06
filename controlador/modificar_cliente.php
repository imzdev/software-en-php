<?php

if (!empty($_POST["btnguardar"])) {
    if (!empty($_POST["rut"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["email"]) and !empty($_POST["direccion"]) and !empty($_POST["telefono"])) {
       $rut = $_POST["rut"];
       $nombre = $_POST["nombre"];
       $apellido = $_POST["apellido"];
       $email = $_POST["email"];
       $direccion = $_POST["direccion"];
       $telefono = $_POST["telefono"];
       $sql = $conexion->query("UPDATE cliente SET rut='$rut', nombre='$nombre', apellido='$apellido', email='$email', direccion='$direccion', telefono='$telefono' WHERE id=$id ");
       
       if ($sql) {
        echo '<div class="alert alert-success">Usuario modificado correctamente.</div>';
        header("Location: cliente.php");
    } else {
        echo '<div class="alert alert-danger">Error al modificar usuario.</div>';
    }
} else {
    echo '<div class="alert alert-warning">Alguno de los campos está vacío.</div>';
}
}
?>