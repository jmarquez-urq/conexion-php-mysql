<?php
class Usuario
{
    protected $id;
    protected $usuario;
    protected $nombre;
    protected $apellido;
    protected $email;

    public function __construct($usuario, $nombre, $apellido, $email, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->usuario = $usuario;
        $this->email = $email;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getUsuario() {return $this->usuario;}
    public function getNombre() {return $this->nombre;}
    public function getApellido() {return $this->apellido;}
    public function getNombreApellido() {return "$this->nombre $this->apellido";}
    public function getEmail() {return $this->email;}

    /**
     * Actualiza los datos del usuario. (Esto es un comentario "estandarizado",
     * pero no tiene efecto en el código).
     *
     * @param string $nombre_usuario El nuevo nombre de usuario.
     * @param string $nombre         El nombre de pila del usuario.
     * @param string $apellido       El apellido del usuario
     * @param string $email          El email del usuario
     *
     * @return null
     */
    public function setDatos($nombre_usuario, $nombre, $apellido, $email)
    {
        $this->usuario = $nombre_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
    }
}





