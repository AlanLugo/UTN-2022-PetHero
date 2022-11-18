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
        $this->TipoMascotaDAO = \daos\Mascota\TipoMascotaMysqlDAO::getInstance();
        $this->RazaMascotaDAO = \daos\Mascota\RazaMascotaMysqlDAO::getInstance();
        $this->TamañoMascotaDAO = \daos\Mascota\TamañoMascotaMysqlDAO::getInstance();
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
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Mascota');
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
            $obj_existente = $this->buscar_x_id_mascota($obj);
            if($obj_existente != NULL && $obj_existente->getId_Mascota() != $obj->getId_Mascota())
            {
                throw new \Exception("Error ya existe un registro con el mismo nombre.");
                exit();
            }
            
            $sql = "UPDATE " . $this->tabla . " SET nombre = ?, observaciones = ?, imagen = ?, id_tipo_mascota = ?, id_raza_mascota = ?, id_tamaño_mascota = ? WHERE id_mascota = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->bindValue(2,$obj->getObservaciones());
            $query->bindValue(3,$obj->getImagen());
            $query->bindValue(4,$obj->getId_tipo_mascota()->getId_tipo_mascota());
            $query->bindValue(5,$obj->getId_raza_mascota()->getId_raza_mascota());
            $query->bindValue(6,$obj->getId_tamaño_mascota()->getId_tamaño_mascota());
            $query->bindValue(7,$obj->getId_Mascota());
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
            
            if($this->buscar_x_id_mascota($obj) != NULL)
            {
                throw new \Exception("Ya existe un tipo de mascota con la misma descripcion.");
                exit();
            }
            
            $sql = "INSERT INTO " . $this->tabla . " (nombre,observaciones,imagen,id_tipo_mascota,id_raza_mascota,id_tamaño_mascota,id_dueño) VALUES (?,?,?,?,?,?,?)";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getNombre());
            $query->bindValue(2,$obj->getObservaciones());
            $query->bindValue(3,$obj->getImagen());
            $query->bindValue(4,$obj->getId_tipo_mascota()->getId_tipo_mascota());
            $query->bindValue(5,$obj->getId_raza_mascota()->getId_raza_mascota());
            $query->bindValue(6,$obj->getId_tamaño_mascota()->getId_tamaño_mascota());
            $query->bindValue(7,$obj->getId_Dueño()->getId_Dueño());
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

            $sql = "SELECT * from ".$this->tabla. " Order by nombre";
            $query = $this->dbh->prepare($sql);
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Mascota');
            $Mascotas = NULL;
            while ($row = $query->fetch()) {
                $row->setId_tipo_mascota($this->TipoMascotaDAO->leer(new \modelos\Mascota\Tipo_Mascota($row->getId_tipo_mascota())));
                $row->setId_raza_mascota($this->RazaMascotaDAO->leer(new \modelos\Mascota\Raza_Mascota($row->getId_raza_mascota())));
                $row->setId_tamaño_mascota($this->TamañoMascotaDAO->leer(new \modelos\Mascota\Tamaño_Mascota($row->getId_tamaño_mascota())));
                $Mascotas[] = $row;
            }
            return $Mascotas;
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
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Mascota');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print  "Error!: " . $e->getMessage();

        }
    }

    public function buscar_x_id_mascota($obj)
    {
        try {

            $sql = "SELECT * from ".$this->tabla." WHERE id_mascota = ? order by id_mascota";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_mascota());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Mascota');
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
                $row->setId_tipo_mascota($this->TipoMascotaDAO->leer(new \modelos\Mascota\Tipo_Mascota($row->getId_tipo_mascota())));
                $row->setId_raza_mascota($this->RazaMascotaDAO->leer(new \modelos\Mascota\Raza_Mascota($row->getId_raza_mascota())));
                $row->setId_tamaño_mascota($this->TamañoMascotaDAO->leer(new \modelos\Mascota\Tamaño_Mascota($row->getId_tamaño_mascota())));			
				$Mascotas[] = $row;
			}
			return $Mascotas;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function listar_x_dueño_tamaño_raza($id_dueño, $tamaño, $raza)
	{
		try {
			$sql = "SELECT id_mascota, nombre, observaciones, imagen, id_tipo_mascota, id_raza_mascota, id_tamaño_mascota, id_dueño FROM ".$this->tabla." WHERE id_dueño = ? AND tamaño = ? AND raza = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$id_dueño);
            //insertar tipo / raza / tamaño
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

    public function listar_tipo_mascota_dueño_x_carga_existente($obj)
    {
        try {
            $sql = "SELECT tipos_mascota.id_tipo_mascota, tipos_mascota.nombre FROM tipos_mascota INNER JOIN mascotas on mascotas.id_tipo_mascota = tipos_mascota.id_tipo_mascota AND mascotas.id_dueño = ? group by tipos_mascota.id_tipo_mascota, tipos_mascota.nombre";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getId_dueño());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Mascota\Tipo_Mascota');
			$Mascotas = NULL;
			while ($row = $query->fetch()) {				
				$Mascotas[] = $row;
			}
            print_r($Mascotas);
			return $Mascotas;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
    }

}
?>