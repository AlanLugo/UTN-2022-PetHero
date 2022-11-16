<?php
namespace daos\Cuenta;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;
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
	
	public function getCuenta_byID($obj){}

	public function leer($obj)
	{
		try{
            $sql = "SELECT * from ".$this->tabla." WHERE id_cuenta = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_Cuenta());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Cuenta');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
	}

	public function actualizar($obj){}

	public function borrar($obj){}

	public function crear($obj)
	{
		try{
            if($this->leer($obj) != NULL)
            {
                throw new \Exception("Ya existe una cuenta con la misma descripcion.");
                exit();
            }
			/*
				id_cuenta int(11) NOT NULL AUTO_INCREMENT,
				usuario varchar(50) DEFAULT NULL,
				password varchar(16) DEFAULT NULL,
				rol varchar(20) DEFAULT NULL,
			*/
            $sql = "INSERT INTO " . $this->tabla . " (usuario,password,rol) VALUES (?,?,?)";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getUsuario());
            $query->bindValue(2,$obj->getPassword());
            $query->bindValue(3,$obj->getRol());
            if($query->execute())
            {
                $obj->setId_Cuenta($this->dbh->lastInsertId());
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
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Usuario\Cuenta');
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

