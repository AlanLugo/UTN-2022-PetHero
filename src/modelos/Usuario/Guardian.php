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
    protected $id_cuenta;

    public function __construct($id_guardian = '', $nombre = '', $direccion = '', $cuil = '', $disponibilidad = '', $precio = '', \modelos\Usuario\Cuenta $id_cuenta = NULL)
    {
        $this->setId_Guardian($id_guardian);
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
        $this->setCuil($cuil);
        $this->setDisponibilidad($disponibilidad);
        $this->setPrecio($precio);
        $this->setId_Cuenta($id_cuenta);
        
    }
     
    public function getId_Guardian()
    {
        return $this->id_guardian;
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

    public function getId_Cuenta()
    {
        return $this->id_cuenta;
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

    public function setId_Cuenta($id_cuenta)
	{
		
		if(is_a($id_cuenta,'\modelos\Usuario\Cuenta'))
		{
			$this->id_cuenta = $id_cuenta;
		}
		else
		{
			$this->id_cuenta = new \modelos\Usuario\Cuenta($id_cuenta);
		}
	}

    public function setId_Guardian($id_guardian)
    {
        $this->id_guardian = $id_guardian;

        return $this;
    }

    
}
