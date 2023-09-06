<?php
if (!empty($_POST["btn_registrar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["contraseña"]) && !empty($_POST["id_rol"])) {
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        $id_rol = $_POST["id_rol"];

        $sql = $conexion->query("INSERT INTO usuarios (usuario, contraseña, id_rol) VALUES ('$usuario', '$contraseña', '$id_rol')");
        
        if ($sql) {
            echo '<div class="alert alert-success">Usuario registrado correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger">Error al registrar usuario.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío.</div>';
    }
}
?>


