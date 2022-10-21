<?php
namespace modelos\Usuario;
class Guardian
{
    protected $id_guardian;
    protected $nombre;
    protected $direccion;
    protected $cuil;
    protected $disponibilidad;
    protected $precio;

    public function __construct($nombre = '', $direccion = '', $cuil = '', $disponibilidad = '', $precio = '')
    {

        $this->setNombre($nombre);
        $this->setDireccion($direccion);
        $this->setCuil($cuil);
        $this->setDisponibilidad($disponibilidad);
        $this->setPrecio($precio);
        
    }
 
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getCuil()
    {
        return $this->cuil;
    }

    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }
 
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;

        return $this;
    }

    public function setDisponibilidad($disponibilidad)
    {
        $this->disponibilidad = $disponibilidad;

        return $this;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

}
