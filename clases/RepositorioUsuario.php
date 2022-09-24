<?php
require_once '.env.php';
require_once 'Usuario.php';

class RepositorioUsuario
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8');
        }
    }

    public function login($nombre_usuario, $clave)
    {
        $q = "SELECT id, clave, nombre, apellido, email FROM usuarios ";
        $q.= "WHERE usuario = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $nombre_usuario);
        if ( $query->execute() ) {
            $query->bind_result($id, $clave_encriptada, $nombre, $apellido, $email);
            if ( $query->fetch() ) {
                if( password_verify($clave, $clave_encriptada) === true) {
                    return new Usuario($nombre_usuario, $nombre, $apellido, $email, $id);
                }
            }
        }
        return false;
    }

    public function save(Usuario $u, $clave)
    {
        $q = "INSERT INTO usuarios (usuario, nombre, apellido, email, clave) ";
        $q.= "VALUES (?, ?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $usuario = $u->getUsuario();
        $nombre = $u->getNombre();
        $apellido = $u->getApellido();
        $email = $u->getEmail();
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $query->bind_param("sssss", $usuario, $nombre, $apellido, $email, $clave);

        if ( $query->execute() ) {
            // Retornamos el id del usuario recién insertado.
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }
    }

    public function actualizar(Usuario $u)
    {
        // Preparamos la query del update
        $q = "UPDATE usuarios ";
        $q.= "SET usuario = ?, nombre = ?, apellido = ?, email = ? ";
        $q.= "WHERE id = ?";
        $query = self::$conexion->prepare($q);

        // Obtenemos los nuevos valores desde el objeto:
        $usuario = $u->getUsuario();
        $nombre = $u->getNombre();
        $apellido = $u->getApellido();
        $email = $u->getEmail();
        $id = $u->getId();

        // Asignamos los valores para reemplazar los "?" en la query
        $query->bind_param("ssssd", $usuario, $nombre, $apellido, $email, $id);

        // Retornamos true si la query tiene éxito, false si fracasa
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

