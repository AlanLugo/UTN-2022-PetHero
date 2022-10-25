<?php
namespace daos\Guardian;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;
/**
* 
*/
class GuardianMysqlDAO extends SingletoneAbstractDAO implements IGuardianDAO
{
	protected $tabla = "guardianes";
	protected $dbh;
	public function __construct()
	{
		$this->dbh = Conexion::getInstance();
	}
	
	public function getGuardian_byID($id){}
	public function getGuardian_byID_Cuenta($Cuenta)
	{
		try {

			$Guardian = NULL;
			
			$sql = "SELECT * from ".$this->tabla." WHERE id_cuenta = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$Cuenta->getId_Cuenta());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Guardian');
			$Guardian = $query->fetch();
			$Guardian->setId_Cuenta($Cuenta);
			return $Guardian;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}
	public function leer($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE id_guardian = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getId_Guardian());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Guardian');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

	public function leer_x_nombre($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE nombre = ? ";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getNombre());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Guardian');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

	public function actualizar($id){}
	public function borrar($id){}
	public function crear($id){}
	public function listar()
	{
		try {
			
			$sql = "SELECT * from ".$this->tabla;
			$query = $this->dbh->prepare($sql);
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Guardian');
			$obj = NULL;
			while ($row = $query->fetch()) {			

				$obj[] = $row;
			}
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}
}
