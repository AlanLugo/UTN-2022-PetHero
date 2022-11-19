<?php
namespace daos\Mascota;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

/**
 * 
 */
class TamañoMascotaMysqlDAO extends SingletoneAbstractDAO 
{
    protected $tabla = "tamaños_mascota";
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
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Tamaño_Mascota');
            $Tamaños_mascota = NULL;
            while ($row = $query->fetch()) {
                $Tamaños_mascota[] = $row;
            }
            return $Tamaños_mascota;
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function leer($obj)
    {

        try{
            $sql = "SELECT * from ".$this->tabla." WHERE id_tamaño_mascota = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_tamaño_mascota());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Tamaño_Mascota');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }
}