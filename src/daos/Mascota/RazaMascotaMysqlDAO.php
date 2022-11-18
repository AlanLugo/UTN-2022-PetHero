<?php
namespace daos\Mascota;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

/**
 * 
 */
class RazaMascotaMysqlDAO extends SingletoneAbstractDAO 
{
    protected $tabla = "razas_mascota";
    protected $dbh;
    public function __construct()
    {
        $this->dbh = Conexion::getInstance();
    }

	public function listar(){
        try{

            $sql = "SELECT * from ".$this->tabla. " Order by nombre";
            $query = $this->dbh->prepare($sql);
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Raza_Mascota');
            $Razas_mascota = NULL;
            while ($row = $query->fetch()) {
                $Razas_mascota[] = $row;
            }
            return $Razas_mascota;
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function listar_x_tipo_mascota($obj)
	{
		try {
			$sql = "SELECT * from ".$this->tabla." where id_tipo_mascota = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getId_tipo_mascota());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Raza_Mascota');
			$Mascotas = NULL;
			while ($row = $query->fetch()) {				
				$Mascotas[] = $row;
			}
			return $Mascotas;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function leer($obj)
    {

        try{
            $sql = "SELECT * from ".$this->tabla." WHERE id_raza_mascota = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_raza_mascota());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Raza_Mascota');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }
}