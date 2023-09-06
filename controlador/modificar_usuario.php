<?php
if (!empty($_POST["btn_registrar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["contraseña"])) {
        
        $id = $_POST["id"];
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];

        $sql = $conexion->query("UPDATE usuarios SET usuario='$usuario', contraseña='$contraseña' WHERE id=$id");
        
        if ($sql) {
            echo '<div class="alert alert-success">Usuario modificado correctamente.</div>';
            header("Location: admin.php");
        } else {
            echo '<div class="alert alert-danger">Error al modificar usuario.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío.</div>';
    }
}
?>
