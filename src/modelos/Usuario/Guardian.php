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
    protected $tamaño_maximo;
    protected $raza_dia;
    protected $id_cuenta;

    public function __construct($id_guardian = '', $nombre = '', $direccion = '', $cuil = '', $disponibilidad = '', $precio = '',$tamaño_maximo = '',$raza_dia = '', \modelos\Usuario\Cuenta $id_cuenta = NULL)
    {
        $this->setId_Guardian($id_guardian);
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
        $this->setCuil($cuil);
        $this->setDisponibilidad($disponibilidad);
        $this->setPrecio($precio);
        $this->set_tamaño_maximo($tamaño_maximo);
        $this->set_raza_dia($raza_dia);
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

    public function get_tamaño_maximo()
    {
        return $this->tamaño_maximo;
    }

    public function get_raza_dia()
    {
        return $this->raza_dia;
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

    public function set_tamaño_maximo($tamaño_maximo)
    {
        $this->tamaño_maximo = $tamaño_maximo;

        return $this;
    }

    public function set_raza_dia($raza_dia)
    {
        $this->raza_dia = $raza_dia;

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
