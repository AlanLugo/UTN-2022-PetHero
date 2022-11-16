<?php
namespace daos\Reserva;
use daos\IDAO as IDAO;
/**
* 
*/
Interface IReservaDAO extends IDAO
{
	public function getReserva_byID($id);
}
?>