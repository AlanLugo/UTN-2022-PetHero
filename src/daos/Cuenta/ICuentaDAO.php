<?php
namespace daos\Cuenta;
use daos\IDAO as IDAO;
/**
* 
*/
Interface ICuentaDAO extends IDAO
{
	public function getCuenta_byID($id);
}
?>