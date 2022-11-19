<?php
namespace daos\Mascota;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

/**
 * 
 */
class TipoMascotaMysqlDAO extends SingletoneAbstractDAO 
{
    protected $tabla = "tipos_mascota";
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
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Tipo_Mascota');
            $Tipos_mascota = NULL;
            while ($row = $query->fetch()) {
                $Tipos_mascota[] = $row;
            }
            return $Tipos_mascota;
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function leer($obj)
    {

        try{
            $sql = "SELECT * from ".$this->tabla." WHERE id_tipo_mascota = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_tipo_mascota());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Tipo_Mascota');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }
}