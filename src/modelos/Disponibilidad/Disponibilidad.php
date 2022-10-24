<?php

namespace modelos\Disponibilidad;

class Disponibilidad{

    protected $id_disponibilidad;
    protected $fechaInicio;
    protected $fechaFinal;
    protected $disponible;
    protected $id_guardian;

    public function __construct($id_disponibilidad = '', $fechaInicio = '', $fechaFinal = '', $disponible = '', $id_guardian = '')
    {
        $this->setId_Disponibilidad($id_disponibilidad);
        $this->setFechaInicio($fechaInicio);
        $this->setFechaFinal($fechaFinal);
        $this->setDisponible($disponible);
        $this->setId_Guardian($id_guardian);
    }

    
    public function getId_Disponibilidad()
    {
        return $this->id_disponibilidad;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }
 
    public function getDisponible()
    {
        return $this->disponible;
    }

    public function getId_Guardian()
    {
        return $this->id_guardian;
    }


    public function setId_Disponibilidad($id_disponibilidad)
    {
        $this->id_disponibilidad = $id_disponibilidad;

        return $this;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }
 
    
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

 
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function setId_Guardian($id_guardian)
    {      

        if(is_a($id_guardian,'\modelos\Usuario\Dueño'))
		{
			$this->id_guardian = $id_guardian;
		}
		else
		{
			$this->id_guardian = new \modelos\Usuario\Guardian($id_guardian);
		}

    }
}