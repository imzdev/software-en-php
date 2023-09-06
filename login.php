<?php
require_once 'class_login/login.class.php';

$nuevoSingleton = Login::singleton_login();

if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $usuario_valido = $nuevoSingleton->login_users($usuario, $contraseña);

    if ($usuario_valido) {
        $id_rol = $nuevoSingleton->get_user_role($usuario, $contraseña);

        if ($id_rol == 1) {
            header("Location: admin.php");
            exit;
        } elseif ($id_rol == 2) {
            header("Location: usuario.php");  
            exit;
        } else {
            $error_msg = "Rol de usuario inválido";
        }
    } else {
        $error_msg = "Usuario y/o contraseña incorrectos";
    }

    header("Location: index.php?error_msg=" . urlencode($error_msg));
    exit;
}
?>