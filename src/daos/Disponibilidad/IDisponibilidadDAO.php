<?php
namespace daos\Disponibilidad;
use daos\IDAO as IDAO;
/**
* 
*/
Interface IDisponibilidadDAO extends IDAO
{
	public function getDisponibilidad_byID($id);
    public function listar_x_guardian($obj);
}
?>