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
}





