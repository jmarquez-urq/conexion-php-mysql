<?php
require_once 'Usuario.php';
require_once 'RepositorioUsuario.php';

class ControladorSesion
{
    protected $usuario = null;

    public function login($nombre_usuario, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = $repo->login($nombre_usuario, $clave);
        //Si falló el login:
        if ($usuario === false) {
            return [false, "Error de credenciales"];
        } else {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario autenticado correctamente"];
        }
    }

    public function create($nombre_usuario, $nombre, $apellido, $email, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = new Usuario($nombre_usuario, $nombre, $apellido, $email);
        $id = $repo->save($usuario, $clave);
        if ($id === false) {
            return [ false, "Error al crear el usuario"];
        }
        else {
            $usuario->setId($id);
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [ true, "Usuario creado correctamente" ];
        }
    }
}
