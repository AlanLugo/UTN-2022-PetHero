<?php
namespace daos\Guardian;
use daos\IDAO as IDAO;
/**
* 
*/
Interface IGuardianDAO extends IDAO
{
	public function getGuardian_byID($id);
}
?>