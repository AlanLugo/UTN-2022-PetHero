<?php
namespace daos\Cuenta;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
/**
* 
*/
class CuentaMysqlDAO extends SingletoneAbstractDAO implements ICuentaDAO
{
	

	protected $tabla = "cuentas";
	protected $dbh;
	public function __construct()
	{

		$this->dbh = Conexion::getInstance();

	}


	public function ingresar($Cuenta)
	{
		
		try {

			$Usuario = NULL;
			
			$sql = "SELECT * from ".$this->tabla." WHERE usuario = ? AND password = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$Cuenta->getUsuario());
			$query->bindValue(2,$Cuenta->getPassword());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Cuenta');
			$Usuario = $query->fetch();
			return $Usuario;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}

	}
	
	public function getCuenta_byID($id){}
	public function leer($id){}
	public function actualizar($id){}
	public function borrar($id){}
	public function crear($id){}
	public function listar(){}
}
