<?php
namespace daos\Dueño;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;
/**
* 
*/
class DueñoMysqlDAO extends SingletoneAbstractDAO implements IDueñoDAO
{
	protected $tabla = "dueños";
	protected $dbh;
	public function __construct()
	{
		$this->dbh = Conexion::getInstance();
	}
	
	public function getDueño_byID($id){}
	public function getDueño_byID_Cuenta($Cuenta)
	{
		try {

			$Dueño = NULL;
			
			$sql = "SELECT * from ".$this->tabla." WHERE id_cuenta = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$Cuenta->getId_Cuenta());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Dueño');
			$Dueño = $query->fetch();
			$Dueño->setId_Cuenta($Cuenta);
			return $Dueño;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}
	public function leer($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE id_dueño = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getId_Dueño());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Dueño');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

	public function leer_x_apellido_nombre($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE apellido = ? AND nombre = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getApellido());
			$query->bindValue(2,$obj->getNombre());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Dueño');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}
	public function actualizar($id){}
	public function borrar($id){}


	public function crear($obj)
	{
		try{
            if($this->leer($obj) != NULL)
            {
                throw new \Exception("Ya existe un dueño con la misma descripcion.");
                exit();
            }
			/*
				id_dueño int(11) NOT NULL AUTO_INCREMENT,
				nombre varchar(50) NOT NULL,
				dni varchar(50) NOT NULL,
				direccion varchar(50) NOT NULL,
				telefono int(50) NOT NULL,
				id_cuenta int,
			*/
            $sql = "INSERT INTO " . $this->tabla . " (nombre,dni,direccion,telefono,id_cuenta) VALUES (?,?,?,?,?)";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->bindValue(2,$obj->getDni());
            $query->bindValue(3,$obj->getDireccion());
			$query->bindValue(4,$obj->getTelefono());
			$query->bindValue(5,$obj->getId_Cuenta()->getId_Cuenta());
            if($query->execute())
            {
                $obj->setId_Dueño($this->dbh->lastInsertId());
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
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Dueño');
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
