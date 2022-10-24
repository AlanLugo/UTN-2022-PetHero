<?php
namespace daos\Mascota;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

/**
 * 
 */
class MascotaMysqlDAO extends SingletoneAbstractDAO implements IMascotaDAO
{
    protected $tabla = 'mascotas';
    protected $dbh;
    public function __construct()
    {
        $this->dbh = Conexion::getInstance();
    }

    public function getMascota_byID($id){}

    public function getMascota_byID_Dueño($Dueño)
    {
        try {

            $Mascota = NULL;

            $sql = "SELECT * from ".$this->tabla." WHERE id_mascota = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1, $Dueño->getId_Dueño());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota');
            $Mascota = $query->fetch();
            $Mascota->setId_Dueño($Dueño);
            return $Mascota;

        }catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function leer($obj)
    {

        try{
            $sql = "SELECT * from ".$this->tabla." WHERE id_mascota = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_Mascota());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function leer_x_nombre($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE nombre = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getNombre());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function actualizar($obj)
    {
        try {
            $obj_existente = $this->buscar_x_nombre($obj);
            if($obj_existente != NULL && $obj_existente->getId_Mascota() != $obj->getId_Mascota())
            {
                throw new \Exception("Error ya existe un registro con el mismo nombre.");
                exit();
            }
            /*
                protected $id_mascota;
                protected $nombre;
                protected $raza;
                protected $tamaño;
                protected $observaciones;
                protected $imagen;
            */
            $sql = "UPDATE " . $this->tabla . " SET nombre = ?, raza = ?, tamaño = ?, obsevaciones = ? WHERE id_mascota = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->bindValue(2,$obj->getRaza());
            $query->bindValue(3,$obj->getTamaño());
            $query->bindValue(4,$obj->getObservaciones());
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
	
    public function borrar($obj) 
    {
        try {
            $obj = $this->leer($obj);
            $sql = "DELETE FROM " . $this->tabla . " WHERE id_mascota = ? ";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_Mascota());
            if($query->execute())
            {
                return $obj;
            }
            else
            {
                return NULL;
            }
        }catch(PDOException $e)
        {

            print "Error!: " . $e->getMessage();
        }
        
    }

	public function crear($obj)
    {
        try{
            if($this->buscar_x_nombre($obj) != NULL)
            {
                throw new \Exception("Ya existe un tipo de mascota con la misma descripcion.");
                exit();
            }
            $sql = "INSERT INTO " . $this->tabla . " (nombre,raza,tamaño,observaciones) VALUES (?,?,?,?)";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->bindValue(2,$obj->getRaza());
            $query->bindValue(3,$obj->getTamaño());
            $query->bindValue(4,$obj->getObservaciones());
            if($query->execute())
            {
                $obj->setId_Mascota($this->dbh->lastInsertId());
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

	public function listar(){
        try{

            $sql = "SELECT * from".$this->tabla;
            $query = $this->dbh->prepare($sql);
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota');
            $obj = NULL;
            while ($row = $query->fetch()) {

                $obj[] = $row;
            }
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function buscar_x_nombre($obj)
    {
        try {

            $sql = "SELECT * from ".$this->tabla." WHERE nombre = ? order by nombre";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print  "Error!: " . $e->getMessage();

        }
    }

    public function listar_x_dueño($obj)
	{
		try {
			$sql = "SELECT * from ".$this->tabla." where id_dueño = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getId_Dueño());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Mascota');
			$Mascotas = NULL;
			while ($row = $query->fetch()) {				
				$Mascotas[] = $row;
			}
			return $Mascotas;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}


}
?>