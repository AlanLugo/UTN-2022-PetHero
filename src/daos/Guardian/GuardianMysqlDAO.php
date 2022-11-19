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


	private $CuentaDAO;

	public function __construct()
	{
		$this->dbh = Conexion::getInstance();
		$this->CuentaDAO = \daos\Cuenta\CuentaMysqlDAO::getInstance();
		
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

	public function leer_x_cuil($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE cuil = ? ";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getcuil());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Guardian');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

	public function actualizar($obj)
	{
		try {
            $obj_existente = $this->buscar_x_id_guardian($obj);
            if($obj_existente != NULL && $obj_existente->getId_Guardian() != $obj->getId_Guardian())
            {
                throw new \Exception("Error ya existe un registro con el mismo nombre.");
                exit();
            }
            
            $sql = "UPDATE " . $this->tabla . " SET nombre = ?, direccion = ?, cuil = ?, disponibilidad = ?, precio = ?, id_tipo_mascota = ?, id_tamaño_mascota = ? WHERE id_guardian = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->bindValue(2,$obj->getDireccion());
            $query->bindValue(3,$obj->getCuil());
            $query->bindValue(4,$obj->getDisponibilidad());
            $query->bindValue(5,$obj->getPrecio());
            $query->bindValue(6,$obj->getId_tipo_mascota()->getId_tipo_mascota());
            $query->bindValue(7,$obj->getId_tamaño_mascota()->getId_tamaño_mascota());
            $query->bindValue(8,$obj->getId_Guardian());
            if($query->execute())
            {
                return $obj;
            }
            else
            {
                return NULL;
            }
        }catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
        }
	}

	public function borrar($id){}

	public function crear($obj){

        try{
            if($this->leer($obj) != NULL)
            {
                throw new \Exception("Ya existe un guardian con la misma descripcion.");
                exit();
            }
            $sql = "INSERT INTO " . $this->tabla . " (nombre,direccion,cuil,disponibilidad,precio,id_tipo_mascota,id_tamaño_mascota,id_cuenta) VALUES (?,?,?,?,?,?,?,?)";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->bindValue(2,$obj->getDireccion());
            $query->bindValue(3,$obj->getCuil());
            $query->bindValue(4,$obj->getDisponibilidad());
            $query->bindValue(5,$obj->getPrecio());
            $query->bindValue(6,$obj->getId_tipo_mascota()->getId_tipo_mascota());
            $query->bindValue(7,$obj->getId_tamaño_mascota()->getId_tamaño_mascota());
            $query->bindValue(8,$obj->getId_Cuenta()->getId_Cuenta());
            if($query->execute())
            {
                $obj->setId_Guardian($this->dbh->lastInsertId());
                return $obj;
            }
            else
            {
                return NULL;
            }
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }

	}

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

	public function buscar_x_id_guardian($obj)
    {
        try {

            $sql = "SELECT * from ".$this->tabla." WHERE id_guardian = ? order by id_guardian";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_Guardian());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Guardian');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print  "Error!: " . $e->getMessage();

        }
    }

}