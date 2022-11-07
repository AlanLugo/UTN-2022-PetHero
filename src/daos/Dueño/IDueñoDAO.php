<?php
namespace daos\Dueño;
use daos\IDAO as IDAO;
/**
* 
*/
Interface IDueñoDAO extends IDAO
{
	public function getDueño_byID($id);
}
?>