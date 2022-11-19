<?php
namespace daos;
/**
* 
*/
Interface IDAO
{
	public function leer($obj);//Buscar el objeto por su id
	public function actualizar($obj);
	public function borrar($obj);
	public function crear($obj);
	public function listar();//Devuelve una array de objetos de ese tipo
}
 ?>