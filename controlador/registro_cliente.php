<?php 

if (!empty($_POST["btnguardar"])) { 
    if (!empty($_POST["id_usuarios"]) and !empty($_POST["rut"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["email"]) and !empty($_POST["direccion"]) and !empty($_POST["telefono"])) {
        
        $id_usuarios=$_POST["id_usuarios"];
        $rut=$_POST["rut"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $email=$_POST["email"];
        $direccion=$_POST["direccion"];
        $telefono=$_POST["telefono"];

        $sql=$conexion->query("INSERT INTO cliente (id_usuarios,rut,nombre,apellido,email,direccion,telefono)values('$id_usuarios','$rut','$nombre','$apellido','$email','$direccion','$telefono') ");
        if ($sql==1) {
            echo '<div class="alert alert-succes"> Cliente registrado.</div>';
            
        }else{
            echo '<div class="alert alert-danger"> Error registrando al cliente.</div>';
        }
    }else{
        echo '<div class="alert alert-warning">Discrepancia detectada: Campo vacio.</div>';
    }
}
?>
