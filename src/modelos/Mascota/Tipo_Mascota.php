<?php

namespace modelos\Mascota;

class Tipo_Mascota
{
    protected $id_tipo_mascota;
    protected $nombre;
    
    public function __constructor($id_tipo_mascota = '', $nombre = '')
    {
        $this->setId_tipo_mascota($id_tipo_mascota);
        $this->setNombre($nombre);
    }

    public function getId_tipo_mascota()
    {
        return $this->id_tipo_mascota;
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function setId_tipo_mascota($id_tipo_mascota)
    {
        $this->id_tipo_mascota = $id_tipo_mascota;

        return $this;
    }

 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}



?>