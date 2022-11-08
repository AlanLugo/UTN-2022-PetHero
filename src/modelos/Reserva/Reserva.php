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
        
    }       

    

    public function setId_Dueño($id_dueño)
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