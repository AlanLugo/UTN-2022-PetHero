<?php
namespace daos;
/**
* 
*/
abstract class SingletoneAbstractDAO
{
		
	protected static $instancia = null;	

	public static function getInstance()
	{
		return self::obtener_instancia(get_called_class());
	}

	public static function obtener_instancia($inst)
	{
		for($i=0;$i<count(self::$instancia);$i++)
		{
			if(self::$instancia[$i]==$inst)
			{
				return self::$instancia[$i];
			}
		}
		self::$instancia[] = new $inst;//$inst es el nombre de la clase que llamo al singleton
		return end(self::$instancia);
	}

	// Evita que el objeto se pueda clonar
	public function __clone()
	{

		trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

	}

}
