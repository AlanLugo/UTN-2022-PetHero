<?php
namespace modelos\Reserva;

use modelos\Mascota\Mascota;

class Reserva{

    protected $id_reserva;
    protected $fecha_inicio;
    protected $fecha_final;
    protected $horarios;
    protected $estado;
    protected $id_mascota;
    protected $id_dueño;
    protected $id_guardian;

    public function __construct($id_reserva = '', $fecha_inicio = '', $fecha_final = '', $horarios = '', $estado = '',\modelos\Mascota\Mascota $id_mascota = NULL,\modelos\Usuario\Dueño $id_dueño = NULL, \modelos\Usuario\Guardian $id_guardian = NULL)
    {
        $this->id_reserva = $id_reserva;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
        $this->horarios = $horarios;
        $this->estadi = $estadi;
        $this->id_mascota = $id_mascota;
        $this->id_dueño = $id_dueño;
        $this->id_guardian = $id_guardian;        
    }       
    


    public function getId_reserva()
    {
        return $this->id_reserva;
    }


    public function setId_reserva($id_reserva)
    {
        $this->id_reserva = $id_reserva;

        return $this;
    }


    public function getFecha_inicio()
    {
        return $this->fecha_inicio;
    }


    public function setFecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }


    public function getFecha_final()
    {
        return $this->fecha_final;
    }


    public function setFecha_final($fecha_final)
    {
        $this->fecha_final = $fecha_final;

        return $this;
    }


    public function getHorarios()
    {
        return $this->horarios;
    }


    public function setHorarios($horarios)
    {
        $this->horarios = $horarios;

        return $this;
    }


    public function getEstado()
    {
        return $this->estado;
    }

 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }


    public function getId_mascota()
    {
        return $this->id_mascota;
    }


    public function setId_mascota($id_mascota)
    {
        $this->id_mascota = $id_mascota;

        return $this;
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


    public function getId_guardian()
    {
        return $this->id_guardian;
    }


    public function setId_guardian($id_guardian)
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