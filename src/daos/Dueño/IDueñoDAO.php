<?php
namespace daos\Dueño;
use daos\IDAO as IDAO;
/**
* 
*/
Interface IDueñoDAO extends IDAO
{
	public function getDueño_byID($id);
	public function getDueño_byID_Cuenta($Cuenta);
	public function leer($obj);
	public function leer_x_apellido_nombre($obj);
	public function actualizar($id);
	public function borrar($id);
	public function crear($obj);
	public function listar();
}
?>