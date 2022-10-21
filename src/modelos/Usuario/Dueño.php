<?php
namespace modelos\Usuario;
class Dueño
{
    protected $nombre;
    protected $dni;
    protected $direccion;
    protected $telefono;
    protected $id_cuenta;

    public function __construct($nombre = '', $dni = '', $direccion = '', $telefono = '', \modelos\Usuario\Cuenta $id_cuenta = NULL)
    {

        $this->setNombre($nombre);
        $this->setDni($dni);
        $this->setDireccion($direccion);
        $this->setTelefono($telefono);
        $this->setId_Cuenta($id_cuenta);

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

}
