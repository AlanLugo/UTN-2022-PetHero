<?php 

namespace modelos\Mascota;

class Tamaño_Mascota
{
    protected $id_tamaño_maximo;
    protected $nombre;

    public function __construct($id_tamaño_maximo = '', $nombre = '')
    {
        $this->setId_tamaño_maximo($id_tamaño_maximo);
        $this->setNombre($nombre);
    }

    public function getId_tamaño_maximo()
    {
        return $this->id_tamaño_maximo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function setId_tamaño_maximo($id_tamaño_maximo)
    {
        $this->id_tamaño_maximo = $id_tamaño_maximo;

        return $this;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}