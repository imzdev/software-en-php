<?php
require_once 'conexion/conexion.class.php';

class Login
{
    private static $instancia;
    private $dbh;

    private function __construct()
    {
        $this->dbh = Conexion::singleton_conexion();
    }

    public static function singleton_login()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }

        return self::$instancia;
    }

    public function login_users($usuario, $contraseña)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE usuario = ? AND contraseña = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $contraseña);
            $query->execute();

            if ($query->rowCount() == 1) {
                $fila = $query->fetch();
                $_SESSION['usuario'] = $fila['usuario'];

                return true;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }

        return false;
    }

    public function get_user_role($usuario, $contraseña)
    {
        try {
            $sql = "SELECT id_rol FROM usuarios WHERE usuario = ? AND contraseña = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $contraseña);
            $query->execute();

            if ($query->rowCount() == 1) {
                $fila = $query->fetch();
                return $fila['id_rol'];
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }

        return null;
    }

    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }

}
?>
