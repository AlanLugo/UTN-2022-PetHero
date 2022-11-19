<?php
namespace daos\Guardian;
use daos\IDAO as IDAO;
/**
* 
*/
Interface IGuardianDAO extends IDAO
{
	public function getGuardian_byID($id);
	public function getGuardian_byID_Cuenta($Cuenta);
	public function leer($obj);
	public function leer_x_cuil($obj);
	public function actualizar($id);
	public function borrar($id);
	public function crear($obj);
	public function listar();
	public function buscar_x_id_guardian($obj);
}
?>