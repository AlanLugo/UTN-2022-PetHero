<?php
namespace modelos\Mascota;

class Mascota{

    protected $id_mascota;
    protected $nombre;
    protected $raza;
    protected $tamaño;
    protected $observaciones;
    protected $imagen;
    protected $id_dueño;


    public function __construct($id_mascota = '', $nombre = '', $raza = '', $tamaño = '', $observaciones = '', $imagen = '', \modelos\Usuario\Dueño $id_dueño = NULL)
    {
        
        $this->setId_Mascota($id_mascota);
        $this->setNombre($nombre);
        $this->setRaza($raza);
        $this->setTamaño($tamaño);
        $this->setObservaciones($observaciones);
        $this->setImagen($imagen);
        $this->setId_Dueño($id_dueño);
        
    }
 
    public function getId_mascota()
    {
        return $this->id_mascota;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getRaza()
    {
        return $this->raza;
    }

    public function getTamaño()
    {
        return $this->tamaño;
    }
 
    public function getObservaciones()
    {
        return $this->observaciones;
    }
 
    public function getImagen()
    {
        return $this->imagen;
    }

    public function setId_mascota($id_mascota)
    {
        $this->id_mascota = $id_mascota;

        return $this;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function setRaza($raza)
    {
        $this->raza = $raza;

        return $this;
    }
 
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;

        return $this;
    }
 
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function setImagen($imagen)
	{
		if(strcmp($imagen, "")==0)
		{
			$this->imagen = '../uploads/imagenes/mascota/no-imagen.jpg';
		}
		else
		{
			$this->imagen = $imagen;
		}
	}
 

   
    public function getId_dueño()
    {
        return $this->id_dueño;
    }

     
    public function setId_dueño($id_dueño)
    {      

        if(is_a($id_dueño,'\modelos\Usuario\Dueño'))
		{
			$this->id_dueño = $id_dueño;
		}
		else
		{
			$this->id_dueño = new \modelos\Usuario\Dueño($id_dueño);
		}

    }
}