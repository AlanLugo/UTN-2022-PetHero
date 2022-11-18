<?php
namespace daos\Mascota;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

/**
 * 
 */
class TipoMysqlDAO extends SingletoneAbstractDAO 
{
    protected $tabla = "tipos_mascota";
    protected $dbh;
    public function __construct()
    {
        $this->dbh = Conexion::getInstance();
    }

    public function listar()
    {
        try{
            
            $sql = "SELECT * from".$this->tabla. "Order by nombre";
            $query = $this->dbh->prepare($sql);
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Tipo_mascota');
            $Tipo_mascota = NULL;
            while ($row = $query->fetch()) {
                $Tipo_mascota[] = $row;
            }
        }catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }
}