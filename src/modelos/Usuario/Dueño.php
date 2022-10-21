<?php
namespace modelos\Usuario;
class Dueño
{
    protected $nombre;
    protected $dni;
    protected $direccion;
    protected $telefono;

    public function __construct($nombre = '', $dni = '', $direccion = '', $telefono = '')
    {

        $this->setNombre($nombre);
        $this->setDni($dni);
        $this->setDireccion($direccion);
        $this->setTelefono($telefono);


    }

    public function getNombre()
    {
        return $this->nombre;
    }
 
    public function getDni()
    {
        return $this->dni;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }
 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

}
