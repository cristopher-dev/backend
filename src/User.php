<?php

class User
{
    private $id;
    private $nombre;
    private $correoElectronico;
    private $contrasena;

    public function __construct($id, $nombre, $correoElectronico, $contrasena)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correoElectronico = $correoElectronico;
        $this->contrasena = $contrasena;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }

    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }
}
