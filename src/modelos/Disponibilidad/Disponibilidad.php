<?php

namespace modelos\Disponibilidad;

class Disponibilidad{

    protected $id_disponibilidad;
    protected $fecha_inicio;
    protected $fecha_final;
    protected $disponible;
    protected $id_guardian;

    public function __construct($id_disponibilidad = '', $fecha_inicio = '', $fecha_final = '', $disponible = '', \modelos\Usuario\Guardian $id_guardian = NULL)
    {
        $this->setId_Disponibilidad($id_disponibilidad);
        $this->setFechaInicio($fecha_inicio);
        $this->setFechaFinal($fecha_final);
        $this->setDisponible($disponible);
        $this->setId_Guardian($id_guardian);
    }

    
    public function getId_Disponibilidad()
    {
        return $this->id_disponibilidad;
    }

    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    public function getFechaFinal()
    {
        return $this->fecha_final;
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

    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }
 
    
    public function setFechaFinal($fecha_final)
    {
        $this->fecha_final = $fecha_final;

        return $this;
    }

 
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function setId_Guardian($id_guardian)
    {      

        if(is_a($id_guardian,'\modelos\Usuario\Guardian'))
		{
			$this->id_guardian = $id_guardian;
		}
		else
		{
			$this->id_guardian = new \modelos\Usuario\Guardian($id_guardian);
		}

    }
}