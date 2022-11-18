<?php 

namespace modelos\Mascota;

class Tamaño_Mascota
{
    protected $id_tamaño_mascota;
    protected $nombre;

    public function __construct($id_tamaño_mascota = '', $nombre = '')
    {
        $this->setId_tamaño_mascota($id_tamaño_mascota);
        $this->setNombre($nombre);
    }

    public function getId_tamaño_mascota()
    {
        return $this->id_tamaño_mascota;
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function setId_tamaño_mascota($id_tamaño_mascota)
    {
        $this->id_tamaño_mascota = $id_tamaño_mascota;

        return $this;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}