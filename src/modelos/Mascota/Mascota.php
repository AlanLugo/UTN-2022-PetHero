<?php
namespace modelos\Mascota;

class Mascota{

    protected $id_mascota;
    protected $nombre;
    protected $observaciones;
    protected $id_tipo_mascota;
    protected $id_raza_mascota;
    protected $id_tamaño_mascota;
    protected $imagen;
    protected $id_dueño;


    public function __construct($id_mascota = '', $nombre = '',  $observaciones = '', \modelos\Mascota\Tipo_Mascota $id_tipo_mascota = NULL, \modelos\Mascota\Raza_Mascota $id_raza_mascota = NULL, \modelos\Mascota\Tamaño_Mascota $id_tamaño_mascota = NULL, $imagen = '', \modelos\Usuario\Dueño $id_dueño = NULL)
    {
        $this->setId_Mascota($id_mascota);
        $this->setNombre($nombre);
        $this->setObservaciones($observaciones);
        $this->setId_tipo_mascota($id_tipo_mascota);
        $this->setId_raza_mascota($id_raza_mascota);
        $this->setId_tamaño_mascota($id_tamaño_mascota);
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

    public function getObservaciones()
    {
        return $this->observaciones;
    }
 
    public function getImagen()
    {
        return $this->imagen;
    }

    public function getId_tipo_mascota()
    {
        return $this->id_tipo_mascota;
    }
    
    public function getId_raza_mascota()
    {
        return $this->id_raza_mascota;
    }

    public function getId_tamaño_mascota()
    {
        return $this->id_tamaño_mascota;
    }

    public function getId_dueño()
    {
        return $this->id_dueño;
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
 
    public function setId_tipo_mascota($id_tipo_mascota)
    {
        $this->id_tipo_mascota = $id_tipo_mascota;

        return $this;
    }

    public function setId_raza_mascota($id_raza_mascota)
    {
        $this->id_raza_mascota = $id_raza_mascota;

        return $this;
    }
 
    public function setId_tamaño_mascota($id_tamaño_mascota)
    {
        $this->id_tamaño_mascota = $id_tamaño_mascota;

        return $this;
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