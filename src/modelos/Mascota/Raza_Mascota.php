<?php

namespace modelos\Mascota;

class Raza_Mascota
{
    protected $id_raza_mascota;
    protected $nombre;
    protected $id_tipo_mascota;

    public function __construct($id_raza_mascota = '', $nombre = '', \modelos\Mascota\Tipo_Mascota $id_tipo_mascota = NULL )
    {
        $this->setId_raza_mascota($id_raza_mascota);
        $this->setNombre($nombre);
        $this->setId_tipo_mascota($id_tipo_mascota);
    }
 
    public function getId_raza_mascota()
    {
        return $this->id_raza_mascota;
    }
 
    public function getNombre()
    {
        return $this->nombre;
    }
 
    public function getId_tipo_mascota()
    {
        return $this->id_tipo_mascota;
    }



    public function setId_raza_mascota($id_raza_mascota)
    {
        $this->id_raza_mascota = $id_raza_mascota;

        return $this;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function setId_tipo_mascota($id_tipo_mascota)
    {
        if(is_a($id_tipo_mascota, '\modelos\Mascota\Tipo_Mascota'))
        {
            $this->id_tipo_mascota = $id_tipo_mascota;
        }
        else
        {
            $this->id_tipo_mascota = new \modelos\Mascota\Tipo_Mascota($id_tipo_mascota);
        }
    }
}
